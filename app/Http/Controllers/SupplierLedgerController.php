<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierLedgerController extends Controller
{
    public function index()
    {
        // Get all active suppliers for dropdown
        $suppliers = DB::table('suppliers')->where('supplier_status', 1)->get();
        return view('dashboard.admin.reports.supplier-ledger-form', compact('suppliers'));
    }

    public function filter(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|integer',
            'from_date'   => 'required|date',
            'to_date'     => 'required|date',
        ]);

        $supplier_id = $request->supplier_id;
        $from_date   = $request->from_date;
        $to_date     = $request->to_date;
$ledger = DB::select("
    SELECT main.trns_date, main.trns_id, main.description, main.debit, main.credit,
        main.against_account,
        main.account_code,
        main.supplier_name
    FROM (
        /* 1) Fully paid purchases (show actual amounts) */
        SELECT 
            p.purchase_date AS trns_date,
            p.invoice_no AS trns_id,
            CONCAT('Purchase (Fully Paid): ', p.description) AS description,
            (p.total) AS debit,
            (p.paid + p.discount) AS credit,
            NULL AS against_account,
            s.parent_id AS account_code,
            s.supplier_name
        FROM purchases p
        INNER JOIN suppliers s ON s.id = p.supplier_id
        WHERE s.id = ?
        AND (p.paid + p.discount) >= p.total
        AND p.purchase_date BETWEEN ? AND ?

        UNION ALL

        /* 2) Transactions (partial payments / credit) */
        SELECT 
            t.trns_date,
            t.trns_id,
            t.description,
            CASE WHEN t.direction = 1 THEN ABS(t.amount) ELSE 0 END AS debit,
            CASE WHEN t.direction = -1 THEN ABS(t.amount) ELSE 0 END AS credit,
            a.account_name AS against_account,
            LPAD(t.account_head_id,6,'0') AS account_code,
            s.supplier_name
        FROM transactions t
        INNER JOIN suppliers s 
            ON s.parent_id = LPAD(t.account_head_id,6,'0')
        LEFT JOIN account_types a
            ON a.code = t.account_head_id
        WHERE s.id = ?
        AND t.trns_date BETWEEN ? AND ?
    ) AS main
    ORDER BY main.trns_date, main.trns_id
", [
    $supplier_id,   // supplier for purchases
    $from_date,     // start date
    $to_date,       // end date
    $supplier_id,   // supplier for transactions
    $from_date,     // start date
    $to_date        // end date
]);




        // Fetch suppliers again for dropdown
        $suppliers = DB::table('suppliers')->where('supplier_status', 1)->get();

        return view('dashboard.admin.reports.supplier-ledger-form', compact('ledger', 'suppliers', 'supplier_id', 'from_date', 'to_date'));
    }
}
