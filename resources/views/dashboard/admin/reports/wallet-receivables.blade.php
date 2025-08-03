@extends('dashboard.admin.layouts.admin-layout')
@section('title', __('language.wallet_receivables'))

@push('admincss')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
@endpush

@section('content')
<div class="content-wrapper">

    <!-- Page Title -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 d-flex align-items-center justify-content-between">
                    <h1 class="m-0 text-dark">
                        <i class="fas fa-wallet mr-1"></i>{{ __('language.wallet_receivables') }}
                    </h1>
                    
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('language.home') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('language.wallet_receivables') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Wallet Receivables Table -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-success card-outline">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">
                        {{ __('language.wallet_receivables') }}
                    </h3>
                    <a href="{{ route('admin.wallet-receivables.transfers') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-history"></i> Transferred History
                    </a>
                </div>

                <div class="card-body table-responsive">
                    <table class="table table-bordered table-hover" id="receivable-table">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>{{ __('language.wallet_name') }}</th>
                                <th>{{ __('language.total_sales_received') }}</th>
                                <th>{{ __('language.total_transferred') }}</th>
                                <th>{{ __('language.pending_receivable') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total_received = 0;
                                $total_transferred = 0;
                                $total_pending = 0;
                            @endphp
                            @forelse($receivables as $index => $row)
                                @php
                                    $total_received += $row['total_received'];
                                    $total_transferred += $row['total_transferred'];
                                    $total_pending += $row['pending'];
                                @endphp
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $row['wallet'] }}</td>
                                    <td>{{ number_format($row['total_received'], 2) }}</td>
                                    <td>{{ number_format($row['total_transferred'], 2) }}</td>
                                    <td>
                                        <span class="badge badge-{{ $row['pending'] > 0 ? 'warning' : 'success' }}">
                                            {{ number_format($row['pending'], 2) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">
                                        No Data Available
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                        @if(count($receivables) > 0)
                        <tfoot>
                            <tr class="font-weight-bold">
                                <td colspan="2" class="text-right">In Total.</td>
                                <td>{{ number_format($total_received, 2) }}</td>
                                <td>{{ number_format($total_transferred, 2) }}</td>
                                <td>{{ number_format($total_pending, 2) }}</td>
                            </tr>
                        </tfoot>
                        @endif
                    </table>
                </div> <!-- /.card-body -->
            </div> <!-- /.card -->
        </div> <!-- /.container-fluid -->
    </section>
</div>
@endsection

@push('adminjs')
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(function () {
            $('#receivable-table').DataTable({
                paging: true,
                ordering: true,
                info: true,
                lengthChange: false,
                language: {
                    emptyTable: "{{ __('language.no_data_available') }}"
                },
                footerCallback: function (row, data, start, end, display) {
                    // Optional: if you want to keep footer dynamic with pagination, you can implement here.
                }
            });
        });
    </script>
@endpush
