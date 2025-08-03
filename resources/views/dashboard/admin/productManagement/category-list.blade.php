@extends('dashboard.admin.layouts.admin-layout')
@section('title',  __('language.category_name'))
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
            <h1 class="m-0">{{ __('language.product_management') }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('language.home') }}</a></li>
              <li class="breadcrumb-item active">{{ __('language.category_list') }}</li>
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
                      <div class="card-header">{{ __('language.category_name') }}</div>
                      <div class="card-body table-responsive">
                          <table class="table table-hover table-condensed" id="category-table">
                              <thead>
                                  <th>#</th>
                                  <th>{{ __('language.category_name') }}</th>
                                  <th>{{ __('language.category_image') }}</th>
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
                      <div class="card-header">{{ __('language.add_category') }}</div>
                      <div class="card-body">
                        <form action="{{ route('admin.addcategory') }}" enctype="multipart/form-data"  files="true" method="post" id="add-category-form" autocomplete="off">
                              @csrf
                              <div class="form-group">
                                  <label for="">{{ __('language.category_name') }}</label>
                                  <input type="text" class="form-control" name="category_name" placeholder="Enter Category Name">
                                  <span class="text-danger error-text category_name_error"></span>
                              </div>

                              <div class="form-group">
                                <label for="">{{ __('language.category_image') }}</label>
                                <input type="file" class="form-control" name="category_img">
                                <span class="text-danger error-text category_img_error"></span>
                              </div>
                              <div class="img-holder"></div>  
                              <div class="form-group">
                                  <button type="submit" class="btn btn-block btn-success">{{ __('language.save') }}</button>
                              </div>
                          </form>
                      </div>
                  </div>
            </div>
        </div>
        <!-- /.row -->
        @include('dashboard.admin.inc.categoryModal')
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
  @include('dashboard.admin.adminjs.categories')
@endpush

