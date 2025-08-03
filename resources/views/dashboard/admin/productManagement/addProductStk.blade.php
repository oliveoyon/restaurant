@extends('dashboard.admin.layouts.admin-layout')
@section('title', 'Add Product to the Stock')
@push('admincss')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.11/dist/sweetalert2.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endpush

@section('content')

<style>
  .mt-10{
    margin-top: 10px;
    padding-top: 10px;
  }
</style>

     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Add Product</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
              <li class="breadcrumb-item active">Add Product</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->

    <div class="content">
      <div class="container-fluid">


        <div class="card card-success " id="cards">
          <div class="card-header" data-card-widget="collapse">
            <h3 class="card-title">Add Products to the Stock</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <form action="{{ route('admin.addProductToStock') }}" method="post" id="add-productstock-forms" class="addpdtform" autocomplete="off">
              @csrf
              <input type="hidden" name="hashId" value="{{ $hashId }}">
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                      <label for="">Batch No</label>
                      <input type="text" class="form-control form-control-sm" name="batch_no" placeholder="Enter Barcode">
                      <span class="text-danger error-text barcode_error"></span>
                    </div>
                </div> 

                <div class="col-md-2">
                  <div class="form-group">
                    <label for="">Product Supplier</label>
                    <select class="form-control form-control-sm select2bs4" name="supplier_id" style="width: 100%;" id="supplier_selected">
                        <option value="">--Select Supplier--</option>
                      @forelse ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                      @empty
                        
                      @endforelse
                    </select>
                    <span class="text-danger error-text supplier_id_error"></span>
                  </div>
                </div>

                <div class="col-md-2">
                  <div class="form-group">
                    <label for="">Shelf Name<span class="text-success" data-toggle="modal" data-target="#shelfs">&nbsp;&nbsp;[<i class="fas fa-plus"></i> Add]</span></label>
                    <select class="form-control form-control-sm select2bs4" name="shelf_id" style="width: 100%;" id="shelf_selected">
                      <option value="">--Select Shelf--</option>
                    @forelse ($shelfs as $shelf)
                      <option value="{{ $shelf->id }}">{{ $shelf->shelf_name }}</option>
                    @empty
                      
                    @endforelse
                  </select>
                    <span class="text-danger error-text shelf_id_error"></span>
                  </div>
                </div>


                <div class="col-md-3">
                  <div class="form-group">
                    <label for="">Upload Image</label>
                    <input type="file" name="stckpdt_image" class="form-control form-control-sm">
                    <span class="text-danger error-text stckpdt_image_error"></span>
                  </div>
                </div>
                
                
                <div class="col-md-3">
                  <div class="img-holder"></div>
                </div>
              
              <!-- /.col -->
            </div>

            <div class="row border border-success" style="padding-top: 10px;">
              <div class="col-md-2">
                <div class="form-group">
                  <label for="">Serial No</label>
                  <input type="text" class="form-control form-control-sm" name="serial_no[]" placeholder="Enter Barcode">
                  <span class="text-danger error-text barcode_error"></span>
                </div>
              </div>

          <div class="col-md-2">
            <div class="form-group">
              <label for="">Bar Code</label>
              <input type="text" class="form-control form-control-sm" name="barcode[]" placeholder="Enter Barcode">
              <span class="text-danger error-text barcode_error"></span>
            </div>
          </div>
          

          

          <div class="col-md-2">
            <div class="form-group">
              <label for="">Size</label>
              <input type="text" class="form-control form-control-sm" name="size[]" placeholder="Enter Size">
              <span class="text-danger error-text size_error"></span>
            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
              <label for="">Color</label>
              <input type="text" class="form-control form-control-sm" name="color[]" placeholder="Enter Color">
              <span class="text-danger error-text color_error"></span>
            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
              <label for="">Buy Price <span class="text-danger">*</span></label>
              <input type="text" class="form-control form-control-sm" name="buy_price[]" value="0">
              <span class="text-danger error-text buy_price_error"></span>
            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
              <label for="">Sale Price <span class="text-danger">*</span></label>
              <input type="text" class="form-control form-control-sm" name="sell_price[]" value="0">
              <span class="text-danger error-text sell_price_error"></span>
            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
              <label for="">Quantity <span class="text-danger">*</span></label>
              <input type="text" class="form-control form-control-sm" name="quantity[]" value="0" required>
              <span class="text-danger error-text quantity[]_error"></span>
            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
              <label for="">Purchased Date <span class="text-danger">*</span></label>
              <input type="text" class="form-control form-control-sm datepicker" name="purchase_date[]">
              <span class="text-danger error-text purchase_date_error"></span>
            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
              <label for="">Expired Date <span class="text-danger">*</span></label>
              <input type="text" class="form-control form-control-sm datepicker" name="expired_date[]">
              <span class="text-danger error-text expired_date_error"></span>
            </div>
          </div>
        </div>

            
                {{-- <p class="text-bold text-primary pt-3">If you need to add individual/group prodcuct specific information like [Serial no, Size, Color, Quantity, Price etc.] Click Advanced option</p> --}}
                {{-- <p>Plese note that, if you click Advanced option, above Serial no, Size, Color, Quantity, Price will not be counted</p> --}}
            <div id="content"></div>
            <br>
            <span style="background:green; color:white; padding: 5px 10px; cursor:pointer" onclick="addRow()">Add More [+]</span>

           
            
            
            <!-- /.row -->
            <div class="row">
              <div class="col-md-3">
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

        
      
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
         <!-- Modal -->



<!-- Add Shelf -->
<div class="modal fade" id="shelfs" tabindex="-1" role="dialog" aria-labelledby="shelfsLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-success">
        <h5 class="modal-title" id="shelfsLabel">{{ __('language.add_shelf') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form action="{{ route('admin.addshelfinpdt') }}" method="post" id="add-shelf-forms" autocomplete="off">
              @csrf
            <div class="form-group">
                <label for="">{{ __('language.product_shelf') }}</label>
                <input type="text" class="form-control form-control-sm" name="shelf_name" placeholder="{{ __('language.add_shelf') }}">
                <span class="text-danger error-text shelf_name_error"></span>
            </div>

              
              <div class="form-group">
                  <button type="submits" class="btn btn-block btn-success">{{ __('language.save') }}</button>
              </div>
          </form>
      </div>
      
    </div>
  </div>
</div>


  
@endsection

@push('adminjs')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.2.0/dist/sweetalert2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  @include('dashboard.admin.adminjs.addproductjs')
  <script>
    $('body').on('focus',".datepicker", function(){
        $(this).datepicker();
    });
  
    $('.datepicker').datepicker().on('changeDate', function(){
      $(this).datepicker('hide');
          }); 
  </script>
@endpush