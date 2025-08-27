<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Account_Types;
use App\Models\Admin\Transactions;
use Illuminate\Support\Facades\DB;

class LedgerController extends Controller
{
    public function showForm()
    {
        $accounts = Account_Types::orderBy('account_name')->whereNotIn('acc_type',['customer','supplier'])->get();
        return view('dashboard.admin.reports.ledger-form', compact('accounts'));
    }

    public function ledgerView(Request $request)
    {
        $request->validate([
            'account_id' => 'required|exists:account_types,id',
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',
        ]);

        // Get account info from ID
        $accountId = $request->input('account_id');
        $startDate = $request->input('start_date');
        $endDate   = $request->input('end_date');

        $account = Account_Types::findOrFail($accountId);
        $accountCode = $account->code;  // <-- Use this for transaction lookup

        // Opening balance
        $opening = Transactions::where('account_head_id', $accountCode)
            ->whereDate('trns_date', '<', $startDate)
            ->selectRaw('
            SUM(CASE WHEN direction = 1 THEN amount ELSE 0 END) as total_dr,
            SUM(CASE WHEN direction = -1 THEN amount ELSE 0 END) as total_cr
        ')
            ->first();

        $openingBalance = ($opening->total_dr ?? 0) - ($opening->total_cr ?? 0);

        // Transactions in date range
        $transactions = Transactions::where('account_head_id', $accountCode)
            ->whereBetween('trns_date', [$startDate, $endDate])
            ->orderBy('trns_date')
            ->orderBy('id')
            ->get();

        // Build a map: trns_id => "code - name, code - name, ..."
        $againstMap = collect();
        $trnsIds = $transactions->pluck('trns_id')->unique()->values();

        if ($trnsIds->isNotEmpty()) {
            $againstRows = DB::table('transactions as t')
                ->join('account_types as at', 'at.code', '=', 't.account_head_id')
                ->whereIn('t.trns_id', $trnsIds)
                ->where('t.account_head_id', '!=', $accountCode) // exclude the current ledger account
                ->groupBy('t.trns_id')
                ->select(
                    't.trns_id',
                    DB::raw("GROUP_CONCAT(DISTINCT CONCAT(at.code, ' - ', at.account_name) ORDER BY at.account_name SEPARATOR ', ') as against_accounts")
                )
                ->get();

            $againstMap = $againstRows->pluck('against_accounts', 'trns_id');
        }

        // Build ledger
        $ledger = [];
        $balance = $openingBalance;

        $ledger[] = [
            'date'        => null,
            'trns_id'     => null,
            'description' => 'Opening Balance',
            'debit'       => null,
            'credit'      => null,
            'balance'     => $balance,
            'against'     => null,
        ];

        foreach ($transactions as $tx) {
            $amount = $tx->amount;
            $tx->direction == 1 ? $balance += $amount : $balance -= $amount;

            $ledger[] = [
                'date'        => $tx->trns_date,
                'trns_id'     => $tx->trns_id,
                'description' => $tx->description,
                'debit'       => $tx->direction == 1 ? $amount : null,
                'credit'      => $tx->direction == -1 ? $amount : null,
                'balance'     => $balance,
                'against'     => $againstMap->get($tx->trns_id), // <-- NEW
            ];
        }

        return view('dashboard.admin.reports.ledger-result', compact(
            'ledger',
            'account',
            'startDate',
            'endDate'
        ));
    }

    public function getTransactionDetails($trnsId)
    {
        $details = DB::table('transactions as t')
            ->join('account_types as a', 'a.code', '=', 't.account_head_id')
            ->where('t.trns_id', $trnsId)
            ->select(
                't.trns_date',
                't.trns_id',
                't.description',
                't.amount',
                't.direction',
                'a.account_name'
            )
            ->get()
            ->map(function ($row) {
                // Convert amount into debit/credit based on direction
                if ($row->direction == 1) {
                    $row->debit = $row->amount;
                    $row->credit = 0;
                } else {
                    $row->debit = 0;
                    $row->credit = $row->amount;
                }
                return $row;
            });

        return response()->json($details);
    }

    
}
