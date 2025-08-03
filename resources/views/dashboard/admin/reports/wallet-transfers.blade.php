@extends('dashboard.admin.layouts.admin-layout')
@section('title', __('language.wallet_transfer_history'))

@push('admincss')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
@endpush

@section('content')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">
                            <i class="fas fa-exchange-alt mr-1"></i>{{ __('language.wallet_transfer_history') }}
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('language.home') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('language.wallet_transfer_history') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Transfer History Table -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-info card-outline">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">{{ __('language.wallet_transfer_history') }}</h3>
                        <a href="{{ route('admin.wallet-receivables.transfers.create') }}" class="btn btn-success btn-sm">
                            <i class="fas fa-plus"></i> {{ __('language.create_wallet_transfer') }}
                        </a>
                    </div>

                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-hover" id="transfer-table">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('language.wallet_name') }}</th>
                                    <th>{{ __('language.transfer_date') }}</th>
                                    <th>{{ __('language.amount_transferred') }}</th>
                                    <th>{{ __('language.deduction_amount') }}</th>
                                    <th>{{ __('language.percentage') }}</th>
                                    <th>{{ __('language.destination_account') }}</th>
                                    <th>{{ __('language.remarks') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transfers as $index => $t)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $t->wallet_name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($t->transfer_date)->format('d M Y') }}</td>
                                        <td>{{ number_format($t->net_amount, 2) }}</td>
                                        <td>{{ number_format($t->fee_amount, 2) }}</td>
                                        <td>{{ rtrim(rtrim(number_format($t->fee_percentage, 2), '0'), '.') }}%</td>
                                        <td>{{ $t->bank_account }}</td>
                                        <td>{{ $t->remarks }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted">
                                            {{ __('language.no_data_available') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div><!-- /.container-fluid -->
        </section>


    </div>
@endsection

@push('adminjs')
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(function() {
            $('#transfer-table').DataTable({
                paging: true,
                ordering: true,
                info: true,
                lengthChange: false,
                order: [
                    [2, 'desc']
                ], // default sort by date desc
                language: {
                    emptyTable: "{{ __('language.no_data_available') }}"
                }
            });
        });
    </script>
@endpush
