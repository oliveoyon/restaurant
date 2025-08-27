<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Supplier;
use App\Models\Admin\Purchase;
use App\Models\Admin\PurchaseReturns;
use App\Models\Admin\Transactions;
use Carbon\Carbon;
use Illuminate\Support\Str;


class SupplierLedgerController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::orderBy('supplier_name')->get();
        return view('dashboard.admin.reports.supplier-ledger-form', compact('suppliers'));
    }


    public function view(Request $request)
    {
        // validation and fetching supplier as before

        $from = Carbon::parse($request->from_date)->startOfDay();
        $to = Carbon::parse($request->to_date)->endOfDay();

        $supplier = Supplier::findOrFail($request->supplier_id);
        $account_head_id = $supplier->parent_id;

        // Calculate opening balance before $from date
        $openingBalance = Transactions::where('account_head_id', $account_head_id)
            ->whereDate('trns_date', '<', $from->toDateString())
            ->selectRaw('
            COALESCE(SUM(CASE WHEN direction = 1 THEN amount ELSE 0 END), 0) - 
            COALESCE(SUM(CASE WHEN direction = -1 THEN amount ELSE 0 END), 0) as balance
        ')
            ->value('balance');

        // Get transactions in the date range
        $transactions = Transactions::where('account_head_id', $account_head_id)
            ->whereBetween('trns_date', [$from->toDateString(), $to->toDateString()])
            ->orderBy('trns_date')
            ->orderBy('id')
            ->get();

        // Prepare entries collection with opening balance row first
        $entries = collect();

        // Add opening balance row if it exists (non-zero)
        if ($openingBalance != 0) {
            $entries->push([
                'date' => null,
                'type' => 'Opening Balance',
                'invoice' => null,
                'description' => 'Balance before ' . $from->format('j F Y'),
                'debit' => null,
                'credit' => null,
                'balance' => $openingBalance,
            ]);
        }

        // Calculate running balance starting with opening balance
        $running_balance = $openingBalance;

        foreach ($transactions as $tx) {
            $debit = $tx->direction == 1 ? $tx->amount : 0;
            $credit = $tx->direction == -1 ? $tx->amount : 0;

            $running_balance += $debit - $credit;

            $entries->push([
                'date' => $tx->trns_date,
                'type' => $tx->description ? (Str::contains(strtolower($tx->description), 'return') ? 'Purchase Return' : (Str::contains(strtolower($tx->description), 'payment') ? 'Payment' : 'Purchase')) : 'Transaction',
                'invoice' => $tx->trns_id,
                'description' => $tx->description ?? 'N/A',
                'debit' => $debit,
                'credit' => $credit,
                'balance' => $running_balance,
            ]);
        }

        return view('dashboard.admin.reports.supplier-ledger-result', compact('entries', 'supplier', 'from', 'to'));
    }
}
