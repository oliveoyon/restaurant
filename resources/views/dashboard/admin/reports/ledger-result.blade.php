@extends('dashboard.admin.layouts.admin-layout')
@section('title', __('language.account_ledger'))

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <h1 class="m-0">{{ __('language.account_ledger') }} - {{ $account->account_name }}</h1>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="card card-info card-outline">
                    <div class="card-body table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>{{ __('language.date') }}</th>
                                    <th>{{ __('language.trns_id') }}</th>
                                    <th>{{ __('language.description') }}</th>
                                    <th>Against Account(s)</th>
                                    <th>{{ __('language.debit') }}</th>
                                    <th>{{ __('language.credit') }}</th>
                                    <th>{{ __('language.balance') }}</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ledger as $entry)
                                    <tr>
                                        <td>{{ $entry['date'] ?? '---' }}</td>
                                        <td>
                                            <a href="javascript:void(0);" class="transaction-link"
                                                data-trns-id="{{ $entry['trns_id'] }}">
                                                {{ $entry['trns_id'] ?? '---' }}
                                            </a>
                                        </td>

                                        <td>{{ $entry['description'] ?? '---' }}</td>
                                        <td>{{ $entry['against'] ?? '' }}</td>
                                        <td>{{ $entry['debit'] ? number_format($entry['debit'], 2) : '' }}</td>
                                        <td>{{ $entry['credit'] ? number_format($entry['credit'], 2) : '' }}</td>
                                        <td>{{ number_format($entry['balance'], 2) }}</td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Transaction Details Modal -->
                        <div class="modal fade" id="transactionModal" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Transaction Details</h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Account</th>
                                                    <th>Description</th>
                                                    <th>Debit</th>
                                                    <th>Credit</th>
                                                </tr>
                                            </thead>
                                            <tbody id="transactionDetailsBody">
                                                <!-- Fetched rows will appear here -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('adminjs')
    <script>
        $(document).ready(function() {
            $('.transaction-link').on('click', function() {
                let trnsId = $(this).data('trns-id');

                // Clear old data
                $('#transactionDetailsBody').html('<tr><td colspan="5">Loading...</td></tr>');

                // Fetch details
                $.ajax({
                    url: "{{ route('admin.ledger.transaction.details', ':trns_id') }}".replace(
                        ':trns_id', trnsId),
                    type: 'GET',
                    success: function(data) {
                        let rows = '';
                        if (data.length > 0) {
                            data.forEach(entry => {
                                rows += `
                            <tr>
                                <td>${entry.trns_date}</td>
                                <td>${entry.account_name}</td>
                                <td>${entry.description}</td>
                                <td>${entry.direction == 1 ? entry.debit : ''}</td>
                                <td>${entry.direction == -1 ? entry.credit : ''}</td>
                            </tr>
                        `;
                            });
                        } else {
                            rows = '<tr><td colspan="5">No data found</td></tr>';
                        }
                        $('#transactionDetailsBody').html(rows);
                    },
                    error: function() {
                        $('#transactionDetailsBody').html(
                            '<tr><td colspan="5">Error loading data</td></tr>');
                    }
                });

                // Open modal
                $('#transactionModal').modal('show');
            });
        });
    </script>
@endpush
