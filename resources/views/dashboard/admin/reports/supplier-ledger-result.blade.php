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
                        <h4>Supplier Ledger for: {{ $supplier->supplier_name }}</h4>
                        <p>Period: {{ $from->format('j F Y') }} &mdash; {{ $to->format('j F Y') }}</p>

                        <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Invoice</th>
                                <th>Description</th>
                                <th class="text-right">Debit (Dr)</th>
                                <th class="text-right">Credit (Cr)</th>
                                <th class="text-right">Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($entries as $entry)
                                <tr @if($entry['type'] === 'Opening Balance') style="font-weight: bold; background-color: #f0f0f0;" @endif>
                                    <td>{{ $entry['date'] ? \Carbon\Carbon::parse($entry['date'])->format('Y-m-d') : '---' }}</td>
                                    <td>{{ $entry['type'] }}</td>
                                    <td>{{ $entry['invoice'] ?? '---' }}</td>
                                    <td>{{ $entry['description'] }}</td>
                                    <td class="text-right">{{ isset($entry['debit']) && $entry['debit'] !== null ? number_format($entry['debit'], 2) : '' }}</td>
                                    <td class="text-right">{{ isset($entry['credit']) && $entry['credit'] !== null ? number_format($entry['credit'], 2) : '' }}</td>
                                    <td class="text-right">{{ number_format($entry['balance'], 2) }}</td>
                                </tr>
                            @endforeach

                            @if($entries->isEmpty())
                                <tr>
                                    <td colspan="7" class="text-center">No transactions found for this period.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
