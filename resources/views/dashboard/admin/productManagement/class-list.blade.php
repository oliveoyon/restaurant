@extends('dashboard.admin.layouts.admin-layout')
@section('title',  __('language.class_name'))

@section('content')
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ __('language.class_management') }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('language.home') }}</a></li>
              <li class="breadcrumb-item active">{{ __('language.class_list') }}</li>
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
            <div class="col-md-8">

                  <div class="card card-success card-outline">
                      <div class="card-header">{{ __('language.class_name') }}</div>
                      <div class="card-body table-responsive">
                          <table class="table table-hover table-condensed" id="class-table">
                              <thead>
                                  <th>#</th>
                                  <th>{{ __('language.version_name') }}</th>
                                  <th>{{ __('language.class_name') }}</th>
                                  <th>{{ __('language.class_name_numeric') }}</th>
                                  <th>{{ __('language.status') }}</th>
                                  <th>{{ __('language.action') }} <button class="btn btn-sm btn-danger d-none" id="deleteAllBtn">{{ __('language.deleteall') }}</button></th>
                              </thead>
                              <tbody></tbody>
                          </table>
                      </div>
                  </div>
            </div>
            <div class="col-md-4">
                  <div class="card card-success card-outline">
                      <div class="card-header">{{ __('language.add_class') }}</div>
                      <div class="card-body">
                        <form action="{{ route('admin.addclass') }}" method="post" id="add-class-form" autocomplete="off">
                              @csrf
                              <div class="form-group">
                                <label for="">{{ __('language.version_name') }}</label>
                                <select name="version_id" id="" class="form-control">
                                  <option value="">{{ __('language.select') }}</option>
                                  @foreach ($versions as $version)
                                    <option value="{{ $version->id }}">{{ $version->version_name }}</option>
                                  @endforeach
                                </select>
                                <span class="text-danger error-text version_id_error"></span>
                             </div>
                              <div class="form-group">
                                  <label for="">{{ __('language.class_name') }}</label>
                                  <input type="text" class="form-control" name="class_name" placeholder="Enter Class Name">
                                  <span class="text-danger error-text class_name_error"></span>
                              </div>
                              <div class="form-group">
                                <label for="">{{ __('language.class_name_numeric') }}</label>
                                <input type="text" class="form-control" name="class_numeric" placeholder="Enter Class in Numeric">
                                <span class="text-danger error-text class_numeric_error"></span>
                            </div>
                              
                              <div class="form-group">
                                  <button type="submit" class="btn btn-block btn-success">{{ __('language.save') }}</button>
                              </div>
                          </form>
                      </div>
                  </div>
            </div>
        </div>
        <!-- /.row -->
        @include('dashboard.admin.inc.classModal')
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  
@endsection


@push('adminjs')
  @include('dashboard.admin.adminjs.classjs')
@endpush

