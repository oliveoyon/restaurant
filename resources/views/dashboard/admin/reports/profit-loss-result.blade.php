@extends('dashboard.admin.layouts.admin-layout')
@section('title', __('Supplier Ledger'))

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <br>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-info card-outline">
                <div class="card-body table-responsive">
                    <h2>Profit & Loss Report</h2>
                    <strong>Period:</strong> {{ $fromDate->format('j F Y') }} &mdash; {{ $toDate->format('j F Y') }}

                    <table class="table table-bordered table-striped mt-3" style="min-width:600px;">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Account Type</th>
                                <th class="text-right">Amount (৳)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $lastCategory = null;
                            @endphp

                            @foreach ($reportData as $row)
                                <tr>
                                    <td style="font-weight: bold;">
                                        @if ($row->category !== $lastCategory)
                                            {{ $row->category }}
                                            @php $lastCategory = $row->category; @endphp
                                        @endif
                                    </td>
                                    <td style="padding-left: 15px;">{{ $row->account_type }}</td>
                                    <td class="text-right">{{ number_format($row->amount, 2) }}</td>
                                </tr>
                            @endforeach

                            <tr>
                                <th colspan="2" class="text-right">Total Revenue</th>
                                <th class="text-right text-success">{{ number_format($totalRevenue, 2) }}</th>
                            </tr>
                            <tr>
                                <th colspan="2" class="text-right">Total Expenses</th>
                                <th class="text-right text-danger">{{ number_format($totalExpenses, 2) }}</th>
                            </tr>
                            <tr>
                                <th colspan="2" class="text-right">Net Profit / Loss</th>
                                <th class="text-right" style="color: {{ $netProfitLoss >= 0 ? 'green' : 'red' }};">
                                    {{ number_format($netProfitLoss, 2) }}
                                </th>
                            </tr>
                        </tbody>
                    </table>

                    <a href="{{ route('admin.profitloss.form') }}" class="btn btn-secondary mt-3">Back</a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
