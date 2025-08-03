<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Customer;
use App\Models\Admin\Sale;
use App\Models\Admin\Transactions;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CustomerLedgerController extends Controller
{
    public function showForm()
    {
        $customers = Customer::orderBy('customer_name')->get();
        return view('dashboard.admin.reports.customer-ledger-form', compact('customers'));
    }

    public function view(Request $request)
{
    $request->validate([
        'customer_id' => 'required|exists:customers,id',
        'from_date' => 'required|date',
        'to_date' => 'required|date|after_or_equal:from_date',
    ]);

    $customer_id = $request->customer_id;
    $from = Carbon::parse($request->from_date)->startOfDay();
    $to = Carbon::parse($request->to_date)->endOfDay();

    $customer = Customer::findOrFail($customer_id);
    $account_head_id = $customer->parent_id;

    // Calculate opening balance from transactions before 'from_date'
    $opening = Transactions::where('account_head_id', $account_head_id)
        ->whereDate('trns_date', '<', $from)
        ->selectRaw('
            SUM(CASE WHEN direction = 1 THEN amount ELSE 0 END) as total_dr,
            SUM(CASE WHEN direction = -1 THEN amount ELSE 0 END) as total_cr
        ')
        ->first();

    $openingBalance = ($opening->total_dr ?? 0) - ($opening->total_cr ?? 0);

    // Actual ledger entries (transactions) in date range
    $ledgerEntries = Transactions::where('account_head_id', $account_head_id)
        ->whereBetween('trns_date', [$from, $to])
        ->orderBy('trns_date')
        ->orderBy('id')
        ->get()
        ->map(function ($tx) {
            return [
                'date' => $tx->trns_date,
                'invoice' => $tx->trns_id,
                'description' => $tx->description ?? 'Transaction Entry',
                'debit' => $tx->direction == 1 ? $tx->amount : 0,
                'credit' => $tx->direction == -1 ? $tx->amount : 0,
            ];
        });

    // Calculate running balance for ledger entries
    $running_balance = $openingBalance;
    $ledgerEntries = $ledgerEntries->map(function ($entry) use (&$running_balance) {
        $running_balance += $entry['debit'] - $entry['credit'];
        $entry['balance'] = $running_balance;
        return $entry;
    });

    // Historical sales info (informational only, no effect on balance)
    $historicalSales = Sale::where('customer_id', $customer->parent_id)
        ->whereColumn('total', DB::raw('due + paid + discount'))
        ->whereBetween('created_at', [$from, $to])
        ->orderBy('created_at')
        ->get()
        ->map(function ($sale) {
            return [
                'date' => $sale->created_at,
                'invoice' => $sale->invoice_no,
                'description' => $sale->description ?? 'Product Sale',
                'total' => $sale->total,
                'paid' => $sale->paid,
                'due' => $sale->due,
                'discount' => $sale->discount,
            ];
        });

    return view('dashboard.admin.reports.customer-ledger-result', compact(
        'customer',
        'from',
        'to',
        'openingBalance',
        'ledgerEntries',
        'historicalSales'
    ));
}

}
