<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Account_Types;
use App\Models\Admin\Transactions;

class LedgerController extends Controller
{
    public function showForm()
    {
        $accounts = Account_Types::orderBy('account_name')->get();
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
            ];
        }

        return view('dashboard.admin.reports.ledger-result', compact(
            'ledger',
            'account',
            'startDate',
            'endDate'
        ));
    }


    
}
