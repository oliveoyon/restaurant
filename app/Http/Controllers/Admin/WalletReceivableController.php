<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Sale;            // your sales model
use App\Models\WalletTransfer;        // wallet_transfers model
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Account_Types;  // assuming this model exists for account_types
use App\Models\Admin\Transactions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class WalletReceivableController extends Controller
{
    public function index()
    {
        /* ---------------------------------------------------------------
         * 1. Get wallet account names (from account_types where is_wallet = 1)
         * --------------------------------------------------------------- */
        $walletAccounts = Account_Types::where('is_wallet', 1)
            ->pluck('account_name')
            ->map(fn($w) => strtolower(trim($w)))
            ->toArray(); // e.g. ['bkash', 'nagad']

        /* ---------------------------------------------------------------
         * 2. Get sales where trns_type matches wallet names
         * --------------------------------------------------------------- */
        $sales = Sale::select('trns_type as wallet')
            ->whereIn(DB::raw('LOWER(TRIM(trns_type))'), $walletAccounts)
            ->selectRaw('SUM(paid) AS total_received')
            ->groupBy('trns_type')
            ->get()
            ->keyBy(fn($row) => strtolower(trim($row->wallet)));

        /* ---------------------------------------------------------------
         * 3. Get wallet transfer summary grouped by wallet_name
         * --------------------------------------------------------------- */
        $transfers = WalletTransfer::select(DB::raw('LOWER(TRIM(wallet_name)) AS wallet'))
            ->selectRaw('SUM(gross_amount) AS total_transferred')
            ->groupBy(DB::raw('LOWER(TRIM(wallet_name))'))
            ->get()
            ->keyBy('wallet');

        /* ---------------------------------------------------------------
         * 4. Build combined list of wallet keys (from both sales & transfers)
         * --------------------------------------------------------------- */
        $walletKeys = collect($sales->keys())
            ->merge($transfers->keys())
            ->unique()
            ->values();

        /* ---------------------------------------------------------------
         * 5. Prepare the receivable summary
         * --------------------------------------------------------------- */
        $receivables = [];

        foreach ($walletKeys as $wallet) {
            $totalReceived    = (float) ($sales[$wallet]->total_received ?? 0);
            $totalTransferred = (float) ($transfers[$wallet]->total_transferred ?? 0);
            $pending          = $totalReceived - $totalTransferred;

            $receivables[] = [
                'wallet'            => ucfirst($wallet),
                'total_received'    => $totalReceived,
                'total_transferred' => $totalTransferred,
                'pending'           => $pending,
            ];
        }

        return view('dashboard.admin.reports.wallet-receivables', compact('receivables'));
    }


    public function transfers()
    {
        /* Pull all wallet→bank transfers, most‑recent first */
        $transfers = WalletTransfer::select([
            'wallet_name',
            'transfer_date',
            'net_amount',      // amount actually received in bank
            'fee_amount',
            'fee_percentage',
            'bank_account',
            'remarks',
        ])
            ->orderByDesc('transfer_date')
            ->get();
        return view('dashboard.admin.reports.wallet-transfers', compact('transfers'));
    }

    /* -----------------------------------------------------------------
 *  Show the transfer‑create form
 * ----------------------------------------------------------------*/
    public function createTransfer()
    {
        $store_id = Auth::guard('admin')->user()->store_id;

        $wallets        = Account_Types::where(['store_id' => $store_id, 'is_money' => true, 'is_wallet' => true])->get();
        $bankAccounts   = Account_Types::where(['store_id' => $store_id, 'is_money' => true])->get();
        $expenseAccounts = Account_Types::where('account_head_id', 3)->get(); // dropdown

        return view(
            'dashboard.admin.reports.wallet-transfer-create',
            compact('wallets', 'bankAccounts', 'expenseAccounts')
        );
    }

    /* -----------------------------------------------------------------
 *  Store the transfer + 3 accounting rows
 * ----------------------------------------------------------------*/
    public function storeTransfer(Request $request)
    {
        $request->validate([
            'wallet_id'        => 'required',
            'transfer_date'    => 'required|date',
            'gross_amount'     => 'required|numeric|min:0.01',
            'fee_percentage'   => 'nullable|numeric|min:0|max:100',
            'fee_account_id'   => 'required', // NEW
            'bank_account_id'  => 'required',
            'remarks'          => 'nullable|string|max:255',
        ]);

        $wallet       = Account_Types::findOrFail($request->wallet_id);
        $bankAccount  = Account_Types::findOrFail($request->bank_account_id);
        $expenseAcct  = Account_Types::findOrFail($request->fee_account_id);

        $feePct   = $request->fee_percentage ?? 0;
        $feeAmt   = round(($feePct / 100) * $request->gross_amount, 2);
        $netAmt   = $request->gross_amount - $feeAmt;
        $trnCode  = 'WT' . now()->format('YmdHis');   // simple unique batch id

        DB::beginTransaction();
        try {
            /* Wallet transfer header */
            WalletTransfer::create([
                'account_type_id' => $wallet->id,
                'wallet_name'    => $wallet->account_name,
                'transfer_date'  => $request->transfer_date,
                'gross_amount'   => $request->gross_amount,
                'fee_percentage' => $feePct,
                'fee_amount'     => $feeAmt,
                'net_amount'     => $netAmt,
                'bank_account'   => $bankAccount->account_name,
                'remarks'        => $request->remarks,
                'store_id'       => \Auth::guard('admin')->user()->store_id
            ]);

            /* 1. Debit Bank (direction = 1) */
            Transactions::create([
                'trns_id'         => $trnCode,
                'account_head_id' => $bankAccount->code,
                'description'     => "Wallet transfer from {$wallet->account_name}",
                'amount'          => $netAmt,
                'direction'       => 1, // Debit
                'trns_date'       => $request->transfer_date,
                'store_id'       => \Auth::guard('admin')->user()->store_id
            ]);

            /* 2. Debit Expense (direction = 1) if fee > 0 */
            if ($feeAmt > 0) {
                Transactions::create([
                    'trns_id'         => $trnCode,
                    'account_head_id' => $expenseAcct->code,
                    'description'     => "Wallet transfer fee ({$wallet->account_name})",
                    'amount'          => $feeAmt,
                    'direction'       => 1, // Debit
                    'trns_date'       => $request->transfer_date,
                    'store_id'       => \Auth::guard('admin')->user()->store_id
                ]);
            }

            /* 3. Credit Wallet (direction = –1) */
            Transactions::create([
                'trns_id'         => $trnCode,
                'account_head_id' => $wallet->code,
                'description'     => "Wallet transfer credit ({$wallet->account_name})",
                'amount'          => $request->gross_amount,
                'direction'       => -1, // Credit
                'trns_date'       => $request->transfer_date,
                'store_id'       => \Auth::guard('admin')->user()->store_id
            ]);

            DB::commit();
            return redirect()
                ->route('admin.wallet-receivables.transfers')
                ->with('success', 'Wallet transfer recorded.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }
}
