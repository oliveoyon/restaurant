@extends('dashboard.admin.layouts.admin-layout')
@section('title', 'Barcode Print')
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


        <div class="card " id="cards">
          <div class="card-header bg-success">
            <h3 class="card-title">Print Barcode Label</h3>

          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <form action="{{ route('admin.barAction') }}" method="post" id="add-purchasereturn-form" class="addpdtform" autocomplete="off">
              @csrf
              
              
            <div class="row">
              
                <div class="col-md-6">

                   

                    <div class="form-group row ">
                      <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Product Name</label>
                      <div class="col-sm-9 dropdown">
                        <input list="products" class="form-control form-control-sm" placeholder="Search by product name" name="search" id="search" required autofocus>
                        <datalist id="products">
                          <span class="print"></span>
                        </datalist>
                      </div>
                    </div>

                    <div class="form-group row ">
                        <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Barcode Type</label>
                        <div class="col-sm-9 dropdown">
                            <select name="bar_type" class="form-control form-control-sm">
                                <?php
                                    $bartype = ['C39','C39+','C39E','C39E+','C93','S25','S25+','I25','I25+','C128','C128A','C128B','C128C','EAN2','EAN5','EAN8','EAN13','UPCA','UPCE','MSI','MSI+','POSTNET','PLANET','RMS4CC','KIX','IMB','CODABAR','CODE11','PHARMA','PHARMA2T'];    
                                ?>
                                @foreach ($bartype as $bt)
                                   <option value="{{ $bt }}">{{ $bt }}</option> 
                                @endforeach
                              </select>
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
                                <label for="colFormLabelSm" class="col-sm-6 col-form-label col-form-label-sm">Stock</label>
                                <div class="col-sm-6">
                                  <input type="text" name="stock" disabled class="form-control form-control-sm" id="stock">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Unit</label>
                            <div class="col-sm-9">
                              <input type="text" name="unit"  disabled class="form-control form-control-sm" >
                            </div>
                          </div>
                        </div> 
                        
                      </div>
                  
                  <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="colFormLabelSm" class="col-sm-5 col-form-label col-form-label-sm">Barcode</label>
                            <div class="col-sm-7">
                              <input type="text" name="barcode" readonly class="form-control form-control-sm"  value="">
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

      
      </div><!-- /.container-fluid -->
      
    </div>
    <!-- /.content -->
    
  </div>
 
      
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
                    $('.addpdtform').find('input[name="sell_price"]').val(res.data.sell_price);
                    $('.addpdtform').find('input[name="purchase_date"]').val(res.data.purchase_date);
                    $('.addpdtform').find('input[name="expired_date"]').val(res.data.expired_date);
                    $('.addpdtform').find('input[name="net_cost"]').val(document.getElementById("quantity").value * res.data.sell_price);
                    $('.addpdtform').find('select[name="product_type"]').val(res.data.product_type).change();
                    $('.addpdtform').find('input[name="pdtstock_id"]').val(res.data.id);
                    $('.addpdtform').find('input[name="pid"]').val(res.data.product_id);
                    $('.addpdtform').find('input[name="pi_invoice"]').val(res.data.invoice_no);
                    $('#search').val(res.pdtname);
                    document.getElementById("dropdown-content").style.display = "none";
                }
            });
        })

        


        $('#add-purchasereturn-form').on('submit', function(e){
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
                                
                                $("#abc").html(data.html1);
                                $('.modal').modal('show');
                               

                                
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