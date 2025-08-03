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
            <form method="POST" action="{{ route('admin.ledger.supplier.view') }}">
    @csrf
    <div class="row">
        <div class="col-md-4">
            <label>Supplier</label>
            <select name="supplier_id" class="form-control" required>
                <option value="">-- Select Supplier --</option>
                @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label>From Date</label>
            <input type="date" name="from_date" class="form-control" required>
        </div>
        <div class="col-md-3">
            <label>To Date</label>
            <input type="date" name="to_date" class="form-control" required>
        </div>
        <div class="col-md-2">
            <label>&nbsp;</label>
            <button type="submit" class="btn btn-primary btn-block">View Ledger</button>
        </div>
    </div>
</form>

        </div>
    </section>
</div>
@endsection
