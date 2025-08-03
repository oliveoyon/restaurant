@extends('dashboard.admin.layouts.admin-layout')
@section('title', __('language.create_wallet_transfer'))

@push('admincss')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@section('content')
<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <h1 class="m-0 text-dark">{{ __('language.create_wallet_transfer') }}</h1>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.wallet-receivables.transfers.store') }}" method="POST">
                @csrf
                <div class="card card-primary card-outline">
                    <div class="card-body">

                        <div class="row">
                            <!-- Wallet Selection -->
                            <div class="form-group col-md-4">
                                <label for="wallet_id">{{ __('language.select_wallet') }} <span class="text-danger">*</span></label>
                                <select name="wallet_id" id="wallet_id" class="form-control" required>
                                    <option value="">{{ __('language.select_wallet') }}</option>
                                    @foreach ($wallets as $wallet)
                                        <option value="{{ $wallet->id }}" {{ old('wallet_id') == $wallet->id ? 'selected' : '' }}>
                                            {{ $wallet->account_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Transfer Date -->
                            <div class="form-group col-md-4">
                                <label for="transfer_date">{{ __('language.transfer_date') }} <span class="text-danger">*</span></label>
                                <input type="text" name="transfer_date" id="transfer_date" class="form-control"
                                       value="{{ old('transfer_date', date('Y-m-d')) }}" required autocomplete="off" />
                            </div>

                            <!-- Gross Amount -->
                            <div class="form-group col-md-4">
                                <label for="gross_amount">{{ __('language.gross_amount') }} <span class="text-danger">*</span></label>
                                <input type="number" name="gross_amount" id="gross_amount" class="form-control" step="0.01"
                                       value="{{ old('gross_amount') }}" required />
                            </div>

                            <!-- Fee % -->
                            <div class="form-group col-md-4">
                                <label for="fee_percentage">{{ __('language.fee_percentage') }}</label>
                                <input type="number" name="fee_percentage" id="fee_percentage" class="form-control" step="0.01"
                                       value="{{ old('fee_percentage', 0) }}" min="0" max="100" />
                            </div>

                            <!-- Destination Bank -->
                            <div class="form-group col-md-4">
                                <label for="bank_account_id">{{ __('language.select_bank_account') }} <span class="text-danger">*</span></label>
                                <select name="bank_account_id" id="bank_account_id" class="form-control" required>
                                    <option value="">{{ __('language.select_bank_account') }}</option>
                                    @foreach ($bankAccounts as $bank)
                                        <option value="{{ $bank->id }}" {{ old('bank_account_id') == $bank->id ? 'selected' : '' }}>
                                            {{ $bank->account_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Fee Expense Account -->
                            <div class="form-group col-md-4">
                                <label for="fee_account_id">{{ __('language.select_fee_account') }} <span class="text-danger">*</span></label>
                                <select name="fee_account_id" id="fee_account_id" class="form-control" required>
                                    <option value="">{{ __('language.select_fee_account') }}</option>
                                    @foreach ($expenseAccounts as $exp)
                                        <option value="{{ $exp->id }}" {{ old('fee_account_id') == $exp->id ? 'selected' : '' }}>
                                            {{ $exp->account_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Remarks -->
                            <div class="form-group col-md-12">
                                <label for="remarks">{{ __('language.remarks') }}</label>
                                <textarea name="remarks" id="remarks" class="form-control" rows="2">{{ old('remarks') }}</textarea>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-success">{{ __('language.submit') }}</button>
                        <a href="{{ route('admin.wallet-receivables.transfers') }}" class="btn btn-secondary">{{ __('language.cancel') }}</a>
                    </div>
                </div>
            </form>

        </div>
    </section>
</div>
@endsection

@push('adminjs')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#transfer_date", {
            dateFormat: "Y-m-d",
            maxDate: "today",
        });
    </script>
@endpush
