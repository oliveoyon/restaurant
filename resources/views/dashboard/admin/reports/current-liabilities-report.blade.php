@extends('dashboard.admin.layouts.admin-layout')

@section('title', __('Current Liabilities Report'))

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <h1>{{ __('Current Liabilities Report') }}</h1>
            <p><strong>Period:</strong> {{ $fromDate->format('j F Y') }} — {{ $toDate->format('j F Y') }}</p>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Account Type</th>
                        <th class="text-right">Debit</th>
                        <th class="text-right">Credit</th>
                        <th class="text-right">Net Balance</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $row)
                        <tr>
                            <td>{{ $row->category }}</td>
                            <td>{{ $row->account_type }}</td>
                            <td class="text-right">{{ number_format($row->debit, 2) }}</td>
                            <td class="text-right">{{ number_format($row->credit, 2) }}</td>
                            <td class="text-right" style="color: {{ $row->net_balance >= 0 ? 'red' : 'green' }}">
                                {{ number_format(abs($row->net_balance), 2) }}
                                ({{ $row->net_balance >= 0 ? 'Payable' : 'Receivable' }})
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            

            <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Back</a>
        </div>
    </section>
</div>
@endsection
