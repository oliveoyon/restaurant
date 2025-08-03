<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin\Account_Types;
use App\Models\Admin\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProfitLossController extends Controller
{
    // Show form to select date range
    public function showForm()
    {
        return view('dashboard.admin.reports.profit-loss-form');
    }

    // Generate Profit & Loss report
    public function generate(Request $request)
    {
        $request->validate([
            'from_date' => 'required|date',
            'to_date' => 'required|date|after_or_equal:from_date',
        ]);

        $fromDate = Carbon::parse($request->from_date)->startOfDay();
        $toDate = Carbon::parse($request->to_date)->endOfDay();

        // Raw SQL to get revenue and expense grouped by category and account type
        $reportData = DB::table('transactions as t')
            ->join('account_types as at', 't.account_head_id', '=', 'at.code')
            ->join('account_heads as ah', 'at.account_head_id', '=', 'ah.id')
            ->select(
                DB::raw('ah.account_head as category'),
                DB::raw('at.account_name as account_type'),
                DB::raw('SUM(CASE WHEN ah.account_head = "Revenue" THEN t.amount ELSE 0 END) as revenue'),
                DB::raw('SUM(CASE WHEN ah.account_head = "Expenses" THEN t.amount ELSE 0 END) as expenses')
            )
            ->whereBetween('t.trns_date', [$fromDate->format('Y-m-d'), $toDate->format('Y-m-d')])
            ->groupBy('ah.account_head', 'at.account_name')
            ->get();

        // Calculate totals and prepare simplified data for the table
        $totalRevenue = 0;
        $totalExpenses = 0;
        $rows = [];

        foreach ($reportData as $row) {
            if ($row->category === 'Revenue') {
                $totalRevenue += $row->revenue;
                $rows[] = (object)[
                    'category' => $row->category,
                    'account_type' => $row->account_type,
                    'amount' => $row->revenue,
                ];
            } elseif ($row->category === 'Expenses') {
                $totalExpenses += $row->expenses;
                $rows[] = (object)[
                    'category' => $row->category,
                    'account_type' => $row->account_type,
                    'amount' => $row->expenses,
                ];
            }
        }

        $netProfitLoss = $totalRevenue - $totalExpenses;

        return view('dashboard.admin.reports.profit-loss-result', [
            'reportData' => $rows,
            'totalRevenue' => $totalRevenue,
            'totalExpenses' => $totalExpenses,
            'netProfitLoss' => $netProfitLoss,
            'fromDate' => $fromDate,
            'toDate' => $toDate,
        ]);
    }

    public function currentAssetsForm()
    {
        return view('dashboard.admin.reports.current-assets-form');
    }

    public function currentAssetsReport(Request $request)
{
    $request->validate([
        'from_date' => 'required|date',
        'to_date' => 'required|date|after_or_equal:from_date',
    ]);

    $fromDate = Carbon::parse($request->from_date)->startOfDay();
    $toDate = Carbon::parse($request->to_date)->endOfDay();

    // Fetch current asset transactions grouped by account type
    $rawData = DB::table('transactions as t')
        ->join('account_types as at', 't.account_head_id', '=', 'at.code')
        ->join('account_heads as ah', 'at.account_head_id', '=', 'ah.id')
        ->select(
            'ah.account_head as category',
            'at.account_name as account_type',
            DB::raw('SUM(CASE WHEN t.direction = 1 THEN t.amount ELSE 0 END) as debit'),
            DB::raw('SUM(CASE WHEN t.direction = -1 THEN t.amount ELSE 0 END) as credit')
        )
        ->whereBetween('t.trns_date', [$fromDate, $toDate])
        ->where('ah.account_head', 'Assets')
        ->groupBy('ah.account_head', 'at.account_name')
        ->orderBy('at.account_name')
        ->get();

    // Calculate net balance = debit - credit for each asset account
    $data = $rawData->map(function ($item) {
        $item->net_balance = ($item->debit ?? 0) - ($item->credit ?? 0);
        return $item;
    });

    return view('dashboard.admin.reports.current-assets-report', compact('data', 'fromDate', 'toDate'));
}


    public function currentLiabilitiesForm()
    {
        return view('dashboard.admin.reports.current-liabilities-form');
    }

    public function currentLiabilitiesReport(Request $request)
{
    $request->validate([
        'from_date' => 'required|date',
        'to_date' => 'required|date|after_or_equal:from_date',
    ]);

    $fromDate = Carbon::parse($request->from_date)->startOfDay();
    $toDate = Carbon::parse($request->to_date)->endOfDay();

    // Get Current Liability transactions grouped by account
    $rawData = DB::table('transactions as t')
        ->join('account_types as at', 't.account_head_id', '=', 'at.code')
        ->join('account_heads as ah', 'at.account_head_id', '=', 'ah.id')
        ->select(
            'ah.account_head as category',
            'at.account_name as account_type',
            DB::raw('SUM(CASE WHEN t.direction = 1 THEN t.amount ELSE 0 END) as debit'),
            DB::raw('SUM(CASE WHEN t.direction = -1 THEN t.amount ELSE 0 END) as credit')
        )
        ->whereBetween('t.trns_date', [$fromDate, $toDate])
        ->where('ah.account_head', 'Liabilities')
        ->groupBy('ah.account_head', 'at.account_name')
        ->orderBy('at.account_name')
        ->get();

    // Calculate net balance for each account
    $data = $rawData->map(function ($item) {
        $item->net_balance = ($item->credit ?? 0) - ($item->debit ?? 0);
        return $item;
    });

    return view('dashboard.admin.reports.current-liabilities-report', compact('data', 'fromDate', 'toDate'));
}




}
