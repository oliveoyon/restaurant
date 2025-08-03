@extends('dashboard.admin.layouts.admin-layout')
@section('title', 'Customer List')
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
            <h1 class="m-0">{{ __('language.customer_management') }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('language.home') }}</a></li>
              <li class="breadcrumb-item active">{{ __('language.customers') }}</li>
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
                          {{ __('language.customers') }}
                        </h3>
                        <div class="card-tools">
                          <ul class="nav nav-pills ml-auto">
                            <li class="nav-item">
                                
                              <button class="btn btn-flat btn-success" data-toggle="modal" data-target="#addcustomers"><i class="fas fa-plus-square mr-1"></i> {{ __('language.add_customer') }}</button>
                            </li>
                          </ul>
                        </div>
                      </div>
                      <div class="card-body table-responsive">
                          <table class="table table-hover table-condensed" id="customer-table">
                              <thead>
                                  <th>#</th>
                                  <th>{{ __('language.customer_name') }}</th>
                                  <th>{{ __('language.customer_address') }}</th>
                                  <th>{{ __('language.customer_phone') }}</th>
                                  <th>{{ __('language.customer_email') }}</th>
                                  <th>{{ __('language.status') }}</th>
                                  <th>{{ __('language.action') }} <button class="btn btn-sm btn-danger d-none" id="deleteAllBtn">{{ __('language.deleteall') }}</button></th>
                              </thead>
                              <tbody></tbody>
                          </table>
                      </div>
                  </div>
            </div>
            
        </div>


        <!-- Modal -->
<div class="modal fade" id="addcustomers" tabindex="-1" aria-labelledby="addCustomerLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h5 class="modal-title" id="addCustomerLabel">{{ __('language.add_suupplier') }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin.addcustomer') }}" method="post" id="add-customer-form" autocomplete="off">
                @csrf
                <div class="form-group">
                    <label for="">{{ __('language.customer_name') }}</label>
                    <input type="text" class="form-control" name="customer_name" placeholder="{{ __('language.add_customer') }}">
                    <span class="text-danger error-text customer_name_error"></span>
                </div>

                <div class="form-group">
                    <label for="">{{ __('language.customer_address') }}</label>
                    <input type="text" class="form-control" name="customer_address" placeholder="{{ __('language.customer_address') }}">
                    <span class="text-danger error-text customer_address_error"></span>
                </div>

                <div class="form-group">
                    <label for="">{{ __('language.customer_phone') }}</label>
                    <input type="text" class="form-control" name="customer_phone" placeholder="{{ __('language.customer_phone') }}">
                    <span class="text-danger error-text customer_phone_error"></span>
                </div>

                <div class="form-group">
                    <label for="">{{ __('language.customer_email') }}</label>
                    <input type="email" class="form-control" name="customer_email" placeholder="{{ __('language.customer_email') }}">
                    <span class="text-danger error-text scustomer_email_error"></span>
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
        

        <div class="modal fade editCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ __('language.edit_customer') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    {{-- {{ route('admin.updatecategoryDetails'); }} --}}
                    <div class="modal-body">
                         <form action="{{ route('admin.updateCustomerDetails'); }}" method="post" id="update-customer-form">
                            @csrf
                             <input type="hidden" name="sid">
                             
                            <div class="form-group">
                                <label for="">{{ __('language.customer_name') }}</label>
                                <input type="text" class="form-control" name="customer_name" placeholder="{{ __('language.customer_name') }}">
                                <span class="text-danger error-text customer_name_error"></span>
                            </div>
            
                            <div class="form-group">
                                <label for="">{{ __('language.customer_address') }}</label>
                                <input type="text" class="form-control" name="customer_address" placeholder="{{ __('language.customer_address') }}">
                                <span class="text-danger error-text customer_address_error"></span>
                            </div>
            
                            <div class="form-group">
                                <label for="">{{ __('language.customer_phone') }}</label>
                                <input type="text" class="form-control" name="customer_phone" placeholder="{{ __('language.customer_phone') }}">
                                <span class="text-danger error-text customer_phone_error"></span>
                            </div>
            
                            <div class="form-group">
                                <label for="">{{ __('language.customer_email') }}</label>
                                <input type="email" class="form-control" name="customer_email" placeholder="{{ __('language.customer_email') }}">
                                <span class="text-danger error-text scustomer_email_error"></span>
                            </div>
                             
                             <div class="form-group">
                                <label for="">{{ __('language.status') }}</label>
                                <select name="customer_status" id="" class="form-control">
                                    <option value="1">{{ __('language.active') }}</option>
                                    <option value="0">{{ __('language.inactive') }}</option>
                                </select>
                                <span class="text-danger error-text unit_status_error"></span>
                            </div>
                             <div class="form-group">
                                 <button type="submit" class="btn btn-block btn-success">{{ __('language.update') }}</button>
                             </div>
                         </form>
                        
          
                    </div>
                </div>
            </div>
        </div>












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
  @include('dashboard.admin.adminjs.customerjs')
@endpush

