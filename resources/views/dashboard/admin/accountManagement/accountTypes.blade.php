@extends('dashboard.admin.layouts.admin-layout')
@section('title', 'Chart of Accounts')
@push('admincss')
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endpush

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ __('language.account_management') }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('language.home') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('language.account_type') }}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">

                        <div class="card card-success card-outline">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-chalkboard-teacher mr-1"></i>
                                    {{ __('language.account_type') }}
                                </h3>
                                <div class="card-tools">
                                    <ul class="nav nav-pills ml-auto">
                                        <li class="nav-item">

                                            <button class="btn btn-flat btn-success" data-toggle="modal"
                                                data-target="#addaccounttypes"><i class="fas fa-plus-square mr-1"></i>
                                                {{ __('language.add_account_type') }}</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-hover table-condensed" id="accounttype-table">
                                    <thead>
                                        <th>#</th>
                                        <th>{{ __('language.account_head') }}</th>
                                        <th>{{ __('language.account_type') }}</th>
                                        <th>{{ __('language.status') }}</th>
                                        <th>{{ __('language.action') }} <button class="btn btn-sm btn-danger d-none"
                                                id="deleteAllBtn">{{ __('language.deleteall') }}</button></th>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>


                <!-- Modal -->
                <div class="modal fade" id="addaccounttypes" tabindex="-1" aria-labelledby="addUnitLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-success">
                                <h5 class="modal-title" id="addUnitLabel">{{ __('language.add_account_type') }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('admin.addAccountType') }}" method="post" id="add-account-form"
                                    autocomplete="off">
                                    @csrf
                                    <div class="form-group">
                                        <label for="">{{ __('language.account_head') }}</label>
                                        <select name="account_head_id" class="form-control">
                                            <option value="">Select an Account</option>
                                            @foreach ($accheads as $head)
                                                <option value="{{ $head->id }}">{{ $head->account_head }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger error-text account_head_id_error"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{ __('language.account_type') }}</label>
                                        <input type="text" class="form-control" name="account_name"
                                            placeholder="{{ __('language.account_type') }}">
                                        <span class="text-danger error-text account_name_error"></span>
                                    </div>

                                    {{-- ✅ is_money checkbox --}}
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="is_money" value="1"
                                            id="is_money">
                                        <label class="form-check-label" for="is_money">Is Money</label>
                                    </div>

                                    {{-- ✅ is_wallet checkbox --}}
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="is_wallet" value="1"
                                            id="is_wallet">
                                        <label class="form-check-label" for="is_wallet">Is Wallet</label>
                                    </div>

                                    <div class="form-group mt-3">
                                        <button type="submit"
                                            class="btn btn-block btn-success">{{ __('language.save') }}</button>
                                    </div>
                                </form>
                            </div>


                        </div>
                    </div>
                </div>
                <!-- /.row -->
                @include('dashboard.admin.inc.accountTypeModal')
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


@endsection


@push('adminjs')
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.2.0/dist/sweetalert2.min.js"></script>

    <!-- Toastr -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @include('dashboard.admin.adminjs.accounttypejs')
@endpush
