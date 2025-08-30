@extends('dashboard.admin.layouts.admin-layout')
@section('title', __('Supplier Ledger'))

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <h1 class="m-0">{{ __('Supplier Ledger') }}</h1>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <form method="POST" action="{{ route('admin.supplier.ledger.filter') }}" class="mb-4">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <label>Supplier</label>
                            <select name="supplier_id" class="form-control" required>
                                <option value="">Select Supplier</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}"
                                        {{ isset($supplier_id) && $supplier_id == $supplier->id ? 'selected' : '' }}>
                                        {{ $supplier->supplier_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>From Date</label>
                            <input type="date" name="from_date" class="form-control" value="{{ $from_date ?? '' }}"
                                required>
                        </div>
                        <div class="col-md-3">
                            <label>To Date</label>
                            <input type="date" name="to_date" class="form-control" value="{{ $to_date ?? '' }}" required>
                        </div>
                        <div class="col-md-2 mt-4">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </form>

                @if (isset($ledger) && count($ledger) > 0)
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Invoice / ID</th>
                                <th>Description</th>
                                <th>Against Account</th>
                                <th>Debit</th>
                                <th>Credit</th>
                                {{-- <th>Account Code</th> --}}
                                {{-- <th>Supplier</th> --}}
                                <th>Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $runningBalance = 0; @endphp
                            @foreach ($ledger as $row)
                                @php $runningBalance += $row->debit - $row->credit; @endphp
                                <tr>
                                    <td>{{ $row->trns_date }}</td>
                                    <td>{{ $row->trns_id }}</td>
                                    <td>{{ $row->description }}</td>
                                    <td>{{ $row->against_account }}</td>
                                    <td>{{ number_format($row->debit, 2) }}</td>
                                    <td>{{ number_format($row->credit, 2) }}</td>
                                    {{-- <td>{{ $row->account_code }}</td> --}}
                                    {{-- <td>{{ $row->supplier_name }}</td> --}}
                                    <td>{{ number_format($runningBalance, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif



            </div>
        </section>
    </div>
@endsection
