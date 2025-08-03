@extends('dashboard.admin.layouts.admin-layout')
@section('title', 'Sales Return')
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

    .searchResults {
      position:fixed; 
      background-color: white; 
      z-index: 50;
      
    }

    .inputRow {
      position:relative;
      overflow:auto;
    }

.dropdown {
  position: relative;
  display: inline-block;
}

#dropdown-content {
  display: none;
  position: absolute;
  background-color: #fff;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  padding: 12px 16px;
  z-index: 1;
 
}
  </style>

    <div class="content">
      <div class="container-fluid">


        <div class="card " id="cards">
          <div class="card-header">
            <h3 class="card-title">Add a user</h3>

          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <form action="{{ route('admin.salesReturnAction') }}" method="post" id="add-salereturn-form" class="addpdtform" autocomplete="off">
              @csrf
              
              
            <div class="row">
              
                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Invoice No</label>
                    <div class="col-sm-9">
                      <div class="input-group">
                        <input type="text" name="invoice_no" id="invoice" class="form-control form-control-sm" value="SI-" autofocus>
                        <div class="input-group-append">
                          <span class="input-group-text text-success btn inv"><i class="fas fa-search"></i></span>
                        </div>
                      </div>  
                    </div>
                  </div>

                  <input type="hidden" name="inv" value="{{ $inv }}">

                    <div class="form-group row">
                      <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Customer Name</label>
                      <div class="col-sm-9">
                        <div class="input-group">
                          <select name="customer_id" class="form-control form-control-sm select2bs4" id="customer_selected">
                            <option value="">--Select a Customer--</option>
                            @foreach ($customers as $customer)
                              <option value="{{ $customer->parent_id }}">{{ $customer->customer_name .' ('.$customer->customer_phone.')' }}</option>
                            @endforeach
                          </select>
                          <div class="input-group-append">
                            <span class="input-group-text text-success btn cust"><i class="fas fa-search"></i></span>
                          </div>
                        </div>  
                      </div>
                    </div>

                    <div class="form-group row ">
                      <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Product Name</label>
                      <div class="col-sm-9">
                        <select name="pdtstockid" id="pdtstockid" class="form-control form-control-sm">

                        </select>
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
                                  <input type="text" name="stock" disabled class="form-control form-control-sm" id="stock">
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

                    <div class="row">
                      <div class="col-md-6">
                          <div class="form-group row">
                              <label for="colFormLabelSm" class="col-sm-6 col-form-label col-form-label-sm">Quantity</label>
                              <div class="col-sm-6">
                                <input type="number" name="quantity" step="0.01" class="form-control form-control-sm" required value="1" id="quantity">
                                <span class="text-danger error-text quantity_error"></span>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                            <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Price</label>
                            <div class="col-sm-9">
                              <input type="text" name="sell_price" readonly class="form-control form-control-sm" required  id="buy_price">
                              <span class="text-danger error-text sell_price_error"></span>
                            </div>
                        </div>
                      </div> 
                      
                    </div>

                   
                </div>
                <div class="col-md-6">
                  
                  <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="colFormLabelSm" class="col-sm-5 col-form-label col-form-label-sm">Barcode</label>
                            <div class="col-sm-7">
                              <input type="text" name="barcode" disabled class="form-control form-control-sm"  value="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Serial</label>
                            <div class="col-sm-9">
                              <input type="text" name="serial_no" disabled class="form-control form-control-sm" >
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                          <label for="colFormLabelSm" class="col-sm-5 col-form-label col-form-label-sm">Batch</label>
                          <div class="col-sm-7">
                            <input type="text" name="batch_no" disabled class="form-control form-control-sm" >
                          </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group row">
                          <label for="colFormLabelSm" class="col-sm-6 col-form-label col-form-label-sm">Size</label>
                          <div class="col-sm-6">
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
                            <label for="colFormLabelSm" class="col-sm-6 col-form-label col-form-label-sm">Grand Total</label>
                            <div class="col-sm-6">
                              <input type="text" name="net_cost" disabled class="form-control form-control-sm" readonly id="net_cost" value="">
                              <span class="text-danger error-text net_cost_error"></span>
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
            <form action="{{ route('admin.finalSaleReturn') }}" method="post" id="sales-return-form" class="addpdtform1" autocomplete="off">
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
                  <form action="{{ route('admin.addCustomerinSales') }}" method="post" id="add-customer-form" autocomplete="off">
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
      


@endsection

@push('adminjs')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
  @include('dashboard.admin.adminjs.salesreturnjs')
  <script>
    $('body').on('focus',".datepicker", function(){
        $(this).datepicker();
    });
  
    $('.datepicker').datepicker().on('changeDate', function(){
      $(this).datepicker('hide');
          }); 
  </script>
@endpush