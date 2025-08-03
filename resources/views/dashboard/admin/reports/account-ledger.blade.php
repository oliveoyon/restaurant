@extends('dashboard.admin.layouts.admin-layout')
@section('title', 'Account Ledger')

@push('admincss')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
@endpush

@section('content')
<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <h1>Ledger: {{ $account->account_name }}</h1>
            <p><strong>Date:</strong> {{ $startDate }} to {{ $endDate }}</p>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card card-outline card-success">
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-striped" id="ledger-table">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Transaction ID</th>
                                <th>Description</th>
                                <th class="text-right">Debit (Dr)</th>
                                <th class="text-right">Credit (Cr)</th>
                                <th class="text-right">Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ledger as $index => $row)
                                <tr class="{{ $index === 0 ? 'table-info font-weight-bold' : '' }}">
                                    <td>{{ $index }}</td>
                                    <td>{{ $row['date'] ?? '--' }}</td>
                                    <td>{{ $row['trns_id'] ?? '--' }}</td>
                                    <td>{{ $row['description'] }}</td>
                                    <td class="text-right">{{ $row['debit'] ? number_format($row['debit'], 2) : '' }}</td>
                                    <td class="text-right">{{ $row['credit'] ? number_format($row['credit'], 2) : '' }}</td>
                                    <td class="text-right">{{ number_format($row['balance'], 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>
</div>
@endsection

@push('adminjs')
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(function () {
            $('#ledger-table').DataTable({
                paging      : false,
                ordering    : false,
                info        : false,
                searching   : false
            });
        });
    </script>
@endpush
