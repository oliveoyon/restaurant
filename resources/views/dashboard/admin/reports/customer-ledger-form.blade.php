@extends('dashboard.admin.layouts.admin-layout')

@section('title', __('Customer Ledger'))

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <h1 class="m-0">{{ __('Customer Ledger') }}</h1>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.customer.ledger.view') }}" method="POST">
                @csrf
                <div class="card card-primary card-outline">
                    <div class="card-body row">

                        <div class="form-group col-md-4">
                            <label>{{ __('Select Customer') }}</label>
                            <select name="customer_id" class="form-control" required>
                                <option value="">{{ __('Select Customer') }}</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->customer_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-3">
                            <label>{{ __('From Date') }}</label>
                            <input type="date" name="from_date" class="form-control" required>
                        </div>

                        <div class="form-group col-md-3">
                            <label>{{ __('To Date') }}</label>
                            <input type="date" name="to_date" class="form-control" required>
                        </div>

                        <div class="form-group col-md-2 mt-4">
                            <button type="submit" class="btn btn-primary mt-2 w-100">{{ __('View Ledger') }}</button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
