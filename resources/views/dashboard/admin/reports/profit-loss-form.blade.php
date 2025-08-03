@extends('dashboard.admin.layouts.admin-layout')

@section('title', __('Profit & Loss Report'))

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <h1 class="m-0 mb-4 text-center">{{ __('Generate Profit & Loss Report') }}</h1>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.profitloss.generate') }}" method="POST" class="mx-auto" style="max-width: 500px;">
                @csrf

                <div class="d-flex gap-3 mb-3">
                    <div class="form-group flex-fill">
                        <label for="from_date" class="form-label">{{ __('From Date') }}</label>
                        <input type="date" id="from_date" name="from_date" class="form-control" required value="{{ old('from_date') }}">
                    </div>

                    <div class="form-group flex-fill">
                        <label for="to_date" class="form-label">{{ __('To Date') }}</label>
                        <input type="date" id="to_date" name="to_date" class="form-control" required value="{{ old('to_date') }}">
                    </div>
                </div>

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary px-5">{{ __('Generate Report') }}</button>
                </div>
            </form>

            @if ($errors->any())
                <div class="alert alert-danger mt-4 mx-auto" style="max-width: 500px;">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </section>
</div>
@endsection
