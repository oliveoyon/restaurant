@extends('dashboard.admin.layouts.admin-layout')
@section('title',  __('language.subject_name'))

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
              <li class="breadcrumb-item active">{{ __('language.subject_list') }}</li>
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
                      <div class="card-header">{{ __('language.section_name') }}</div>
                      <div class="card-body table-responsive">
                          <table class="table table-hover table-condensed" id="subject-table">
                              <thead>
                                  <th>#</th>
                                  <th>{{ __('language.subject_name') }}</th>
                                  <th>{{ __('language.subject_code') }}</th>
                                  <th>{{ __('language.version_name') }}</th>
                                  <th>{{ __('language.class_name') }}</th>
                                  <th>{{ __('language.academic_year') }}</th>
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
                      <div class="card-header">{{ __('language.add_subject') }}</div>
                      <div class="card-body">
                        <form action="{{ route('admin.addsubject') }}" method="post" id="add-section-form" autocomplete="off">
                              @csrf
                              <div class="form-group">
                                <label for="">{{ __('language.version_name') }}</label>
                                <select name="version_id" id="versions" class="form-control">
                                  <option value="">{{ __('language.select') }}</option>
                                  @foreach ($versions as $version)
                                    <option value="{{ $version->id }}">{{ $version->version_name }}</option>
                                  @endforeach
                                </select>
                                <span class="text-danger error-text version_id_error"></span>
                              </div>
                              {{-- <div class="form-group">
                                <label for="">{{ __('language.class_name') }}</label>
                                <select name="class_id" id="" class="form-control">
                                  <option value="">{{ __('language.select') }}</option>
                                  @foreach ($classes as $class)
                                    <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                                  @endforeach
                                </select>
                                <span class="text-danger error-text class_id_error"></span>
                              </div> --}}

                              <div class="form-group">
                                <label for="class" class="form-label">Class</label>
                                <select class="form-control" name="class_id" id="classes"></select>
                                <span class="text-danger error-text class_id_error"></span>
                              </div>

                              <div class="form-group">
                                <label for="">{{ __('language.subject_name') }}</label>
                                <input type="text" class="form-control" name="subject_name" placeholder="Enter Subject Name">
                                <span class="text-danger error-text subject_name_error"></span>
                            </div>

                            <div class="form-group">
                              <label for="">{{ __('language.subject_code') }}</label>
                              <input type="text" class="form-control" name="subject_code" placeholder="Enter Subject Code">
                              <span class="text-danger error-text subject_code_error"></span>
                            </div>

                              <div class="form-group">
                                <label for="">{{ __('language.academic_year') }}</label>
                                <select name="academic_year" id="" class="form-control">
                                  <option value="">{{ __('language.select') }}</option>
                                  
                                  <?php 
                                    for ($i=date('Y'); $i<date('Y')+5; $i++) { 
                                      echo "<option value='$i'>$i</option>";
                                    }
                                  ?>
                                </select>
                                <span class="text-danger error-text academic_year_error"></span>
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
        @include('dashboard.admin.inc.subjectModal')
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  
@endsection


@push('adminjs')
  @include('dashboard.admin.adminjs.subjectjs')
@endpush

