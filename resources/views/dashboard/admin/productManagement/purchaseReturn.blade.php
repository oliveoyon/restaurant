@extends('dashboard.admin.layouts.admin-layout')
@section('title', 'Purchase Return')
@push('admincss')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
<link rel="stylesheet" href="/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="dist/css/custom.css">
@endpush

@section('content')
  <div class="content-wrapper">
   
  <style>
    .form-group{margin-bottom: 0.5rem;}   
  </style>

    <div class="content">
      <div class="container-fluid">


        <div class="card card-success " id="cards">
          <div class="card-header">
            <h3 class="card-title">Add a user</h3>

          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <form action="{{ route('admin.purchaseReturnProducts') }}" method="post" id="add-purchasereturn-form" class="addpdtform" autocomplete="off">
              @csrf

              
            <div class="row">
                <div class="col-md-6">
                    
                    <div class="form-group row">
                      <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Invoice No</label>
                      <div class="col-sm-9">
                        <input type="text" name="invoice_no" class="form-control form-control-sm" readonly value="{{ $inv }}" >
                        <input type="hidden" name="pdtstock_id" value="">
                        <span class="text-danger error-text invoice_no_error"></span>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Supplier Name</label>
                      <div class="col-sm-9">
                        <select class="form-control form-control-sm select2bs4" required  name="supplier_id" id="supplier_selected">
                          <option value="">--Select Supplier--</option>
                          @forelse ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                          @empty
                            
                          @endforelse
                        </select>
                        <span class="text-danger error-text supplier_id_error"></span>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Product Name</label>
                      <div class="col-sm-9">
                        <select name="product_id" class="form-control select2bs4 product_id" required id="product_id">
                            <option value="">--Select a Product--</option>
                          
                        </select>
                        <input type="hidden" name="pid">
                        <input type="hidden" name="pi_invoice">
                        <span class="text-danger error-text product_id_error"></span>
                      </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="colFormLabelSm" class="col-sm-6 col-form-label col-form-label-sm">Product Type</label>
                                <div class="col-sm-6">
                                  <select name="product_type" disabled class="form-control form-control-sm product_type">
                                    <option value="">--Select One--</option>
                                    <option value="Purchased">Purchased</option>
                                    <option value="Imported">Imported</option>
                                    <option value="Local Manufactured">Local Manufactured</option>
                                    <option value="Self Manufactured">Self Manufactured</option>
                                    {{-- <option value="Opening Stock">Opening Stock</option> --}}
                                  </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group row">
                                <label for="colFormLabelSm" class="col-sm-5 col-form-label col-form-label-sm">Stock</label>
                                <div class="col-sm-7">
                                  <input type="text" name="stock" disabled class="form-control form-control-sm" >
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group row">
                              <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Unit</label>
                              <div class="col-sm-8">
                                <input type="text" name="unit"  disabled class="form-control form-control-sm" >
                              </div>
                          </div>
                      </div>
                        
                        
                    </div>
                </div>
                <div class="col-md-6">
                  
                  <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="colFormLabelSm" class="col-sm-6 col-form-label col-form-label-sm">Barcode</label>
                            <div class="col-sm-6">
                              <input type="text" name="barcode" disabled class="form-control form-control-sm"  value="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label for="colFormLabelSm" class="col-sm-5 col-form-label col-form-label-sm">Serial</label>
                            <div class="col-sm-7">
                              <input type="text" name="serial_no" disabled class="form-control form-control-sm" >
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group row">
                          <label for="colFormLabelSm" class="col-sm-5 col-form-label col-form-label-sm">Batch</label>
                          <div class="col-sm-7">
                            <input type="text" name="batch_no" disabled class="form-control form-control-sm" >
                          </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="colFormLabelSm" class="col-sm-6 col-form-label col-form-label-sm">Quantity</label>
                            <div class="col-sm-6">
                              <input type="text" name="quantity" class="form-control form-control-sm" required value="" id="quantity">
                              <span class="text-danger error-text quantity_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label for="colFormLabelSm" class="col-sm-5 col-form-label col-form-label-sm">Size</label>
                            <div class="col-sm-7">
                              <input type="text" name="size" disabled class="form-control form-control-sm" >
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group row">
                          <label for="colFormLabelSm" class="col-sm-5 col-form-label col-form-label-sm">Color</label>
                          <div class="col-sm-7">
                            <input type="text" name="color" disabled class="form-control form-control-sm" >
                          </div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="colFormLabelSm" class="col-sm-6 col-form-label col-form-label-sm">Purchase Date</label>
                            <div class="col-sm-6">
                              <input type="text" disabled class="form-control form-control-sm " name="purchase_date">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="colFormLabelSm" class="col-sm-5 col-form-label col-form-label-sm ">Expire Date</label>
                            <div class="col-sm-7">
                              <input type="text" disabled class="form-control form-control-sm "name="expired_date" >
                            </div>
                        </div>
                    </div>
                    
                  </div>

                  <div class="row">
                   
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="colFormLabelSm" class="col-sm-6 col-form-label col-form-label-sm">Buy Price</label>
                            <div class="col-sm-6">
                              <input type="text" name="buy_price" readonly class="form-control form-control-sm" required  id="buy_price">
                              <span class="text-danger error-text buy_price_error"></span>
                            </div>
                        </div>
                    </div> 

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="colFormLabelSm" class="col-sm-6 col-form-label col-form-label-sm">Grand Total</label>
                            <div class="col-sm-6">
                              <input type="text" name="net_cost" disabled class="form-control form-control-sm" readonly id="net_cost" value="">
                              <span class="text-danger error-text net_cost_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                          <label for="colFormLabelSm" class="col-sm-6 col-form-label col-form-label-sm">Return Date</label>
                          <div class="col-sm-6">
                            <input type="text" class="form-control form-control-sm datepicker" value="<?=date('m/d/Y');?>" name="return_date">
                            <span class="text-danger error-text return_date_error"></span>
                          </div>
                      </div>
                    </div>
                        
                    </div>
                 
                  
                  
              </div>
            </div>

            
            
            <!-- /.row -->
            <div class="row">
              <div class="col-md-2">
                  <div class="form-group">
                    <label for=""></label>
                    <button type="submit" class="btn btn-block btn-info">Save</button>
                  </div>
                
              </div>
            </div>
            </form>

          </div>
          <!-- /.card-body -->
          
        </div>
        <!-- /.card -->

        <div class="card " id="cards">
          <div class="card-body">
            <div id="table-responsive">
            </div>
          </div>
        </div>

        <div class="card " id="cards">
          <div class="card-body">
            <form action="{{ route('admin.purchaseReturn1') }}" method="post" id="purchase-product-form" class="addpdtform1" autocomplete="off">
              @csrf
              <div id="table-responsive1">
              </div>
            </form>
          </div>
        </div>
      
      </div><!-- /.container-fluid -->
      
    </div>
    <!-- /.content -->
    
  </div>
  <!-- /.content-wrapper -->
         <!-- Modal -->

      
      


@endsection

@push('adminjs')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
  @include('dashboard.admin.adminjs.purchase_returns')
  <script>
    $('body').on('focus',".datepicker", function(){
        $(this).datepicker();
    });
  
    $('.datepicker').datepicker().on('changeDate', function(){
      $(this).datepicker('hide');
          }); 
  </script>
@endpush