@extends('dashboard.admin.layouts.admin-layout')
@section('title', 'Stock Damage')
@push('admincss')
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


        <div class="card card-success" id="cards">
          <div class="card-header">
            <h3 class="card-title">Stock Damage</h3>

          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <form action="{{ route('admin.addstockdamage') }}" method="post" id="add-stockdamage-form" class="addpdtform" autocomplete="off">
              @csrf
              
              
            <div class="row">
              
                <div class="col-md-6">
                    
                  <div class="form-group row">
                    <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Date</label>
                    <div class="col-sm-9">
                      <input type="text" name="damage_date" class="form-control form-control-sm datepicker"  value="<?=date('m/d/Y');?>" >
                      <input type="hidden" name="pdtstock_id" value="">
                      <span class="text-danger error-text invoice_no_error"></span>
                    </div>
                  </div>  
                  
                  <div class="form-group row">
                      <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Invoice No</label>
                      <div class="col-sm-9">
                        <input type="text" name="invoice_no" class="form-control form-control-sm inv" readonly value="{{ $inv }}" >
                        <input type="hidden" name="pdtstock_id" value="">
                        <span class="text-danger error-text invoice_no_error"></span>
                      </div>
                    </div>


                    <div class="form-group row ">
                      <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Product Name</label>
                      <div class="col-sm-9 dropdown">
                        <input list="products" class="form-control form-control-sm" name="search" id="search" required autofocus>
                        <datalist id="products">
                          <span class="print"></span>
                        </datalist>
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
                                <input type="number" name="quantity" step="0.01" class="form-control form-control-sm" required value="" id="quantity">
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

        <div class="card " id="carts">
          <div class="card-body">
            <div id="table-responsive">
            </div>
          </div>
        </div>

        <div class="card " id="payments">
          <div class="card-body">
            <form action="{{ route('admin.stockDamageAction') }}" method="post" id="purchase-product-form" class="addpdtform1" autocomplete="off">
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
      
              <div class="modal fade modal-fullscreen modalsale" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header bg-info">
                      <h5 class="modal-title" id="modalTitle"></h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        <div id="printThis" class="printme">
                        <div id="abc"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <span class="hello"><input type="button" class="btn btn-success" value="Print" onclick="printDiv()"></span>
                      
                      <span class="addprint"></span>
                    </div>
                  </div>
                </div>
              </div>

@endsection

@push('adminjs')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    toastr.options.preventDuplicates = true;
      $.ajaxSetup({
          headers:{
              'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
          }
      });

      
    
      $(function(){
        //ADD NEW District
      

        $(document).on("keyup", '#search', function (e) { 
            e.preventDefault();
            let search_string = $('#search').val();
            $.ajax({
                url:"{{ route('admin.searchProductsforSale') }}",
                method:'POST',
                data:{search_string:search_string},
                success:function(res){
                    // $("#product_id").find('option').remove().end().append(res.products);
                    $('.print').html(res.products);
                    // $('#browsers').html(res.products);
                    if(res.status == 'a'){
                        document.getElementById("dropdown-content").style.display = "none";
                        $( '.addpdtform' ).each(function(){
                                    // this.reset();
                                    $('input[name=quantity').val('');
                                    $('input[name=barcode').val('');
                                    $('input[name=batch_no').val('');
                                    $('input[name=stock').val('');
                                    $('input[name=unit').val('');
                                    $('input[name=serial_no').val('');
                                    $('input[name=size').val('');
                                    $('input[name=color').val('');
                                    $('input[name=buy_price').val('');
                                    $('input[name=sell_price').val('');
                                    $('input[name=quantity').val('');
                                    $('input[name=purchase_date').val('');
                                    $('input[name=expired_date').val('');
                                    $('input[name=net_cost').val('');
                                });
                    }else{
                        document.getElementById("dropdown-content").style.display = "block";
                    }
                    
                   
                    
                }
            })
        })

      

        $(document).on("change", '#search', function (e) { 
        // $(document).on('change', function(e){
            e.preventDefault();
            var product_id = document.querySelector('#search').value;
            // console.log(search_string);
            $.ajax({
                url:"{{ route('admin.searchProductsDetails2') }}",
                method:'POST',
                data:{product_id:product_id},
                success:function(res){
                    $('.addpdtform').find('input[name="stock"]').val(res.data.quantity);
                    $('.addpdtform').find('input[name="unit"]').val(res.unit);
                    $('.addpdtform').find('input[name="barcode"]').val(res.data.barcode);
                    $('.addpdtform').find('input[name="batch_no"]').val(res.data.batch_no);
                    $('.addpdtform').find('input[name="serial_no"]').val(res.data.serial_no);
                    $('.addpdtform').find('input[name="size"]').val(res.data.size);
                    $('.addpdtform').find('input[name="color"]').val(res.data.color);
                    // $('.addpdtform').find('input[name="quantity"]').val(res.data.quantity);
                    $('.addpdtform').find('input[name="sell_price"]').val(res.data.buy_price_with_tax);
                    $('.addpdtform').find('input[name="purchase_date"]').val(res.data.purchase_date);
                    $('.addpdtform').find('input[name="expired_date"]').val(res.data.expired_date);
                    $('.addpdtform').find('input[name="net_cost"]').val(document.getElementById("quantity").value * res.data.buy_price_with_tax);
                    $('.addpdtform').find('select[name="product_type"]').val(res.data.product_type).change();
                    $('.addpdtform').find('input[name="pdtstock_id"]').val(res.data.id);
                    $('.addpdtform').find('input[name="pid"]').val(res.data.product_id);
                    $('.addpdtform').find('input[name="pi_invoice"]').val(res.data.invoice_no);
                    $('#search').val(res.pdtname);
                    document.getElementById("dropdown-content").style.display = "none";
                }
            });
        })

        $('#add-customer-form').on('submit', function(e){
                e.preventDefault();
                var form = this;
                $.ajax({
                    url:$(form).attr('action'),
                    method:$(form).attr('method'),
                    data:new FormData(form),
                    processData:false,
                    dataType:'json',
                    contentType:false,
                    beforeSend:function(){
                            $(form).find('span.error-text').text('');
                    },
                    success:function(data){
                            if(data.code == 0){
                                $.each(data.error, function(prefix, val){
                                    $(form).find('span.'+prefix+'_error').text(val[0]);
                                });
                            }else{
                            // $('#manufacturer-table').DataTable().ajax.reload(null, false);
                                $("#customer_selected").find('option').remove().end().append(data.unititem);
                                $('#addcustomers').modal('hide');
                                $('#addcustomers').find('form')[0].reset();
                                toastr.success(data.msg);
                            }
                    }
                });
            });


        $('#add-stockdamage-form').on('submit', function(e){
                e.preventDefault();
                var form = this;
                $.ajax({
                    url:$(form).attr('action'),
                    method:$(form).attr('method'),
                    data:new FormData(form),
                    processData:false,
                    dataType:'json',
                    contentType:false,
                    beforeSend:function(){
                            $(form).find('span.error-text').text('');
                    },
                    success:function(data){
                            if(data.code == 0){
                                $.each(data.error, function(prefix, val){
                                    $(form).find('span.'+prefix+'_error').text(val[0]);
                                });
                            }else{
                                

                                $( '.addpdtform' ).each(function(){
                                    // this.reset();
                                    $('input[name=quantity').val('');
                                    $('input[name=barcode').val('');
                                    $('input[name=batch_no').val('');
                                    $('input[name=stock').val('');
                                    $('input[name=unit').val('');
                                    $('input[name=serial_no').val('');
                                    $('input[name=size').val('');
                                    $('input[name=color').val('');
                                    $('input[name=search').val('');
                                    $('input[name=sell_price').val('');
                                    $('input[name=quantity').val(1);
                                    $('input[name=purchase_date').val('');
                                    $('input[name=expired_date').val('');
                                    $('input[name=net_cost').val('');
                                });
                                $('#product_id').val(null).trigger("change");
                                
                                $('#table-responsive').html(data.html);
                                $('#table-responsive1').html(data.html1);
                               

                                
                            }
                    }
                });
            });


            //DELETE Version RECORD
            $(document).on('click','#deletePdtBtn', function(){
                        var cartId = $(this).data('id');
                        var url = '<?= route("admin.deleteDmgCart"); ?>';
                        swal.fire({
                             title:'Are you sure?',
                             html:'You want to <b>delete</b> this Product',
                             showCancelButton:true,
                             showCloseButton:true,
                             cancelButtonText:'Cancel',
                             confirmButtonText:'Yes, Delete',
                             cancelButtonColor:'#d33',
                             confirmButtonColor:'#556ee6',
                             width:300,
                             allowOutsideClick:false
                        }).then(function(result){
                              if(result.value){
                                  $.post(url,{cartId:cartId}, function(data){
                                       if(data.code == 1){
                                        $('#table-responsive').html(data.html);
                                        $('#table-responsive1').html(data.html1);
                                           toastr.success(data.msg);
                                       }else{
                                           toastr.error(data.msg);
                                       }
                                  },'json');
                              }
                        });
                    });



            $('#purchase-product-form').on('submit', function(e){
                e.preventDefault();
                var form = this;
                $.ajax({
                    url:$(form).attr('action'),
                    method:$(form).attr('method'),
                    data:new FormData(form),
                    processData:false,
                    dataType:'json',
                    contentType:false,
                    beforeSend:function(){
                            $(form).find('span.error-text').text('');
                    },
                    success:function(data){
                            if(data.code == 0){
                                $.each(data.error, function(prefix, val){
                                    $(form).find('span.'+prefix+'_error').text(val[0]);
                                });
                            }else{
                                toastr.success(data.msg);
                                $('#table-responsive').remove();
                                $('#table-responsive1').remove();
                                $('#modalTitle').html(data.msg);
                                $("#abc").html(data.html1);
                                $('.inv').val(data.inv);
                                $('.modalsale').modal('show');
                                // location.href = "{{URL::to('admin/sales/')}}";
                            }
                    }
                });
            });
    
      })
    </script>

<script>
    $('body').on('focus',".datepicker", function(){
        $(this).datepicker();
    });


    $("#quantity").keyup(function() {
        var quantity = $('#quantity').val();
        var stock = $('#stock').val();
        if(quantity > stock){
            // e.preventDefault();
             $('#quantity').val(stock)
             toastr.error('Stock is not sufficient');
        }
    
    var sell_price = $('#buy_price').val();
    var totalval = Number(sell_price)*Number(quantity);
    $('#net_cost').val(totalval);
    });

    $("#search").keyup(function() {
        if( $('#search').val().length === 0 ) {
            $('input[name=quantity').val('');
                $('input[name=barcode').val('');
                $('input[name=batch_no').val('');
                $('input[name=stock').val('');
                $('input[name=unit').val('');
                $('input[name=serial_no').val('');
                $('input[name=size').val('');
                $('input[name=color').val('');
                $('input[name=search').val('');
                $('input[name=sell_price').val('');
                $('input[name=quantity').val(1);
                $('input[name=purchase_date').val('');
                $('input[name=expired_date').val('');
                $('input[name=net_cost').val('');
        }
        
    });


</script>

<script>



    
    function printDiv() {
            var contents = document.getElementById("printThis").innerHTML;
            var frame1 = document.createElement('iframe');
            frame1.name = "frame1";
            frame1.style.position = "absolute";
            frame1.style.top = "-1000000px";
            document.body.appendChild(frame1);
            var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument;
            frameDoc.document.open();
            frameDoc.document.write(contents);
            frameDoc.document.close();
            setTimeout(function () {
                window.frames["frame1"].focus();
                window.frames["frame1"].print();
                document.body.removeChild(frame1);
            }, 500);
            return false;
        }
        
</script>


@endpush