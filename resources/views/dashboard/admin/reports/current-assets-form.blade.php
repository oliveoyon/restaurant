@extends('dashboard.admin.layouts.admin-layout')

@section('title', __('Current Assets Report'))

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <h1>{{ __('Generate Current Assets Report') }}</h1>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.current-assets.generate') }}" method="POST" class="form-inline">
                @csrf
                <div class="form-group mr-3">
                    <label for="from_date" class="mr-2">{{ __('From Date') }}</label>
                    <input type="date" name="from_date" id="from_date" class="form-control" required>
                </div>
                <div class="form-group mr-3">
                    <label for="to_date" class="mr-2">{{ __('To Date') }}</label>
                    <input type="date" name="to_date" id="to_date" class="form-control" required>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">{{ __('Generate') }}</button>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
