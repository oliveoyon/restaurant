@extends('dashboard.admin.layouts.admin-layout')
@section('title', 'Opening Balance')
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
            <h3 class="card-title">Opening Balance</h3>

          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <form action="{{ route('admin.obaction') }}" method="post" id="add-ob-form" class="add-ob-form" autocomplete="off">
              @csrf

              
            <div class="row">
                <div class="col-md-6">
                    
                    <div class="form-group row">
                      <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Invoice No</label>
                      <div class="col-sm-9">
                        <input type="text" name="invoice_no" class="form-control form-control-sm" readonly value="{{ $inv }}" >
                        <span class="text-danger error-text invoice_no_error"></span>
                      </div>
                    </div>
                    
                    <div class="form-group row">
                      <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Product Name</label>
                      <div class="col-sm-9">
                        <select name="category" class="form-control  form-control-sm category"  id="category">
                            <option value="">--Select a Category--</option>
                            <option value="customer">Customer</option>
                            <option value="supplier">Supplier</option>
                        </select>
                        <span class="text-danger error-text category_error"></span>
                      </div>
                    </div>

                    <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Accounts Name</label>
                        <div class="col-sm-9">
                          <select class="form-control form-control-sm select2bs4"   name="account_id" id="account_id">
                            <option value="">--Select Accounts Name--</option>
                            
                          </select>
                          <span class="text-danger error-text account_id_error"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Amount</label>
                        <div class="col-sm-9">
                          <input type="text" name="amount" class="form-control form-control-sm" value="" >
                          <span class="text-danger error-text amount_error"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Date</label>
                        <div class="col-sm-9">
                          <input type="text" name="obdate" class="form-control form-control-sm datepicker" value="" >
                          <span class="text-danger error-text obdate_error"></span>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Description</label>
                        <div class="col-sm-9">
                          <input type="text" name="description" class="form-control form-control-sm" value="" >
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

<script>
    toastr.options.preventDuplicates = true;
      $.ajaxSetup({
          headers:{
              'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
          }
      });
    
      $(function(){
        

        $(document).on("change", '#category', function (e) { 
            e.preventDefault();
            let category = $('#category').val();
            $.ajax({
                url:"{{ route('admin.searchAccounts') }}",
                method:'POST',
                data:{category:category},
                success:function(res){
                    $("#account_id").find('option').remove().end().append(res.accounts);
                    // $('.addpdtform').find('input[name="stock"]').val(res.stock);
                    // $('.addpdtform').find('input[name="unit"]').val(res.unit);
                }
            })
        })


        
           
            $('#add-ob-form').on('submit', function(e){
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
                                location.href = "{{URL::to('admin/opening-balance/')}}";

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

  $('.datepicker').datepicker().on('changeDate', function(){
    $(this).datepicker('hide');
        }); 
</script>
@endpush