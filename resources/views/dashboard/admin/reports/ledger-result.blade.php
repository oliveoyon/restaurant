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
                                <th>{{ __('language.debit') }}</th>
                                <th>{{ __('language.credit') }}</th>
                                <th>{{ __('language.balance') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ledger as $entry)
                                <tr>
                                    <td>{{ $entry['date'] ?? '---' }}</td>
                                    <td>{{ $entry['trns_id'] ?? '---' }}</td>
                                    <td>{{ $entry['description'] }}</td>
                                    <td>{{ $entry['debit'] ? number_format($entry['debit'], 2) : '' }}</td>
                                    <td>{{ $entry['credit'] ? number_format($entry['credit'], 2) : '' }}</td>
                                    <td>{{ number_format($entry['balance'], 2) }}</td>
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
