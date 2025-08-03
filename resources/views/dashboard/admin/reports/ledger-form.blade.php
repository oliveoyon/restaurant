@extends('dashboard.admin.layouts.admin-layout')
@section('title', __('language.account_ledger'))

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <h1 class="m-0">{{ __('language.account_ledger') }}</h1>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            <form action="{{ route('admin.ledger.view') }}" method="POST">
                @csrf

                <div class="card card-primary card-outline">
                    <div class="card-body row">

                        <div class="form-group col-md-4">
                            <label>{{ __('language.select_account') }}</label>
                            <select name="account_id" class="form-control" required>
                                <option value="">{{ __('language.select_account') }}</option>
                                @foreach ($accounts as $acc)
                                    <option value="{{ $acc->id }}">{{ $acc->account_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-3">
                            <label>{{ __('language.start_date') }}</label>
                            <input type="date" name="start_date" class="form-control" required>
                        </div>

                        <div class="form-group col-md-3">
                            <label>{{ __('language.end_date') }}</label>
                            <input type="date" name="end_date" class="form-control" required>
                        </div>

                        <div class="form-group col-md-2 mt-4">
                            <button type="submit" class="btn btn-primary mt-2 w-100">{{ __('language.view_ledger') }}</button>
                        </div>

                    </div>
                </div>

            </form>
        </div>
    </section>
</div>
@endsection
