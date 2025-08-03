@extends('dashboard.admin.layouts.admin-layout')

@section('title', __('Customer Ledger Result'))

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <h1 class="m-0 font-weight-bold">{{ __('Customer Ledger for') }}: {{ $customer->customer_name }}</h1>
            <p class="text-muted">Period: {{ $from->format('j F Y') }} to {{ $to->format('j F Y') }}</p>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            {{-- Historical Sales (Informational) --}}
            <div class="card card-outline card-info mb-4">
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0">{{ __('Historical Sales (Informational)') }}</h4>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-bordered table-hover table-sm text-sm">
                        <thead class="bg-light text-center" style="font-weight: 600;">
                            <tr>
                                <th style="width: 100px;">Date</th>
                                <th style="width: 120px;">Invoice</th>
                                <th>Description</th>
                                <th style="width: 100px;" class="text-right">Total</th>
                                <th style="width: 100px;" class="text-right">Paid</th>
                                <th style="width: 100px;" class="text-right">Due</th>
                                <th style="width: 100px;" class="text-right">Discount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($historicalSales as $sale)
                                <tr>
                                    <td class="text-center">{{ $sale['date']->format('Y-m-d') }}</td>
                                    <td class="text-center">{{ $sale['invoice'] }}</td>
                                    <td>{{ $sale['description'] }}</td>
                                    <td class="text-right">{{ number_format($sale['total'], 2) }}</td>
                                    <td class="text-right">{{ number_format($sale['paid'], 2) }}</td>
                                    <td class="text-right">{{ number_format($sale['due'], 2) }}</td>
                                    <td class="text-right">{{ number_format($sale['discount'], 2) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-3">No historical sales found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Actual Ledger Entries --}}
            <div class="card card-outline card-primary">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">{{ __('Actual Ledger Entries') }}</h4>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-bordered table-hover table-sm text-sm">
                        <thead class="bg-light text-center" style="font-weight: 600;">
                            <tr>
                                <th style="width: 100px;">Date</th>
                                <th style="width: 120px;">Invoice</th>
                                <th>Description</th>
                                <th style="width: 110px;" class="text-right">Debit (Dr)</th>
                                <th style="width: 110px;" class="text-right">Credit (Cr)</th>
                                <th style="width: 110px;" class="text-right">Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="font-weight-bold bg-secondary text-white">
                                <td colspan="5" class="text-right">Opening Balance</td>
                                <td class="text-right">{{ number_format($openingBalance, 2) }}</td>
                            </tr>
                            @forelse ($ledgerEntries as $entry)
                                <tr>
                                    <td class="text-center">{{ \Carbon\Carbon::parse($entry['date'])->format('Y-m-d') }}</td>
                                    <td class="text-center">{{ $entry['invoice'] }}</td>
                                    <td>{{ $entry['description'] }}</td>
                                    <td class="text-right">{{ number_format($entry['debit'], 2) }}</td>
                                    <td class="text-right">{{ number_format($entry['credit'], 2) }}</td>
                                    <td class="text-right">{{ number_format($entry['balance'], 2) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-3">No ledger entries found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>
</div>
@endsection
