@extends('dashboard.admin.layouts.admin-layout')
@section('title', 'Purchase Reports')
@push('admincss')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
<link rel="stylesheet" href="/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="dist/css/custom.css">
@endpush

@section('content')
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Report</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
              <li class="breadcrumb-item active">Purchase Report</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    

    <!-- Main content -->
    <div class="content">

        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                <i class="fas fa-edit"></i>
                Purchase Report
                </h3>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3">
                                
                        <ol class="reportlist">
                            <li class="suppliers_list" onclick="divVisibility('Div1');"><a href="javascript: void(0)">Suppliers List</a></li>
                            <li class="payables" onclick="divVisibility('Div2');"><a href="javascript: void(0)">Payable Suppliers</a></li>
                            <li class="" onclick="divVisibility('Div3');"><a href="javascript: void(0)">Payable Suppliers (Date Wise)</a></li>
                            <li class="" onclick="divVisibility('Div4');"><a href="javascript: void(0)">Purchase Report</a></li>
                            <li class="" onclick="divVisibility('Div5');"><a href="javascript: void(0)">Purchase Invoice</a></li>
                            <li class="" onclick="divVisibility('Div6');"><a href="javascript: void(0)">Purchase Return</a></li>
                        </ol>
    
                    </div>

                    <div class="col-sm-9">
                        <div class="main_div">
                            
                            <div class="inner_div">
                            <div id="Div1"></div>
                            <div id="Div2" style="display: none;"></div>
                            <div id="Div3" style="display: none;">
                              <form action="{{ route('admin.datewisepayable') }}" method="post" id="payable-form" autocomplete="off">
                                      @csrf
                                  <div class="row">
                                      <div class="col-md-6">
                                              <div class="form-group">
                                                <label for="exampleInputEmail1">Suppliers Name</label>
                                                <select name="supplier_id" id="" class="form-control form-control-sm">
                                                  <option value="2%">All Suppliers</option>
                                                  @foreach ($suppliers as $suppl)
                                                      <option value="{{ $suppl->parent_id }}">{{ $suppl->supplier_name }}</option>
                                                  @endforeach
                                                </select>
                                              </div>
                                              <div class="form-group">
                                                  <label for="exampleInputEmail1">From Date</label>
                                                  <input type="text" class="form-control form-control-sm datepicker" name="from_date">
                                                  <span class="text-danger error-text from_date_error"></span>
                                                </div>
                                              <div class="form-group">
                                                <label for="exampleInputPassword1">To Date</label>
                                                <input type="text" class="form-control form-control-sm datepicker" name="to_date">
                                                <span class="text-danger error-text to_date_error"></span>
                                              </div>
                                              <button type="submit" class="btn btn-primary">Submit</button>
                                      </div>
                                  </div>
                              </form>
                            
                            </div>
                            <div id="Div4" style="display: none;">
                              <form action="{{ route('admin.datewispurchase') }}" method="post" id="purchase-form" autocomplete="off">
                                @csrf
                                  <div class="row">
                                      <div class="col-md-6">
                                              <div class="form-group">
                                                <label for="exampleInputEmail1">Suppliers Name</label>
                                                <select name="supplier_id" id="" class="form-control form-control-sm">
                                                  <option value="all">All Suppliers</option>
                                                  @foreach ($suppliers as $suppl)
                                                      <option value="{{ $suppl->id }}">{{ $suppl->supplier_name }}</option>
                                                  @endforeach
                                                </select>
                                              </div>
                                              <div class="form-group">
                                                  <label for="exampleInputEmail1">From Date</label>
                                                  <input type="text" class="form-control form-control-sm datepicker" name="from_date">
                                                  <span class="text-danger error-text from_date_error"></span>
                                                </div>
                                              <div class="form-group">
                                                <label for="exampleInputPassword1">To Date</label>
                                                <input type="text" class="form-control form-control-sm datepicker" name="to_date">
                                                <span class="text-danger error-text to_date_error"></span>
                                              </div>
                                              <button type="submit" class="btn btn-primary">Submit</button>
                                      </div>
                                  </div>
                              </form>
                            </div>
                            <div id="Div5" style="display: none;">
                              <form action="{{ route('admin.purchaseinvoice') }}" method="post" id="invoice-form" autocomplete="off">
                                @csrf
                                  <div class="row">
                                      <div class="col-md-6">
                                              <div class="form-group">
                                                <label for="exampleInputEmail1">Suppliers Name</label>
                                                <select name="supplier_id" id="" class="form-control form-control-sm">
                                                  <option value="all">All Suppliers</option>
                                                  @foreach ($suppliers as $suppl)
                                                      <option value="{{ $suppl->id }}">{{ $suppl->supplier_name }}</option>
                                                  @endforeach
                                                </select>
                                              </div>
                                              <div class="form-group">
                                                  <label for="exampleInputEmail1">From Date</label>
                                                  <input type="text" class="form-control form-control-sm datepicker" name="from_date">
                                                  <span class="text-danger error-text from_date_error"></span>
                                                </div>
                                              <div class="form-group">
                                                <label for="exampleInputPassword1">To Date</label>
                                                <input type="text" class="form-control form-control-sm datepicker" name="to_date">
                                                <span class="text-danger error-text to_date_error"></span>
                                              </div>
                                              <button type="submit" class="btn btn-primary">Submit</button>
                                      </div>
                                  </div>
                              </form>
                            </div>

                            <div id="Div6" style="display: none;">
                              <form action="{{ route('admin.purchasereturn') }}" method="post" id="return-form" autocomplete="off">
                                @csrf
                                  <div class="row">
                                      <div class="col-md-6">
                                              <div class="form-group">
                                                <label for="exampleInputEmail1">Suppliers Name</label>
                                                <select name="supplier_id" id="" class="form-control form-control-sm">
                                                  <option value="all">All Suppliers</option>
                                                  @foreach ($suppliers as $suppl)
                                                      <option value="{{ $suppl->id }}">{{ $suppl->supplier_name }}</option>
                                                  @endforeach
                                                </select>
                                              </div>
                                              <div class="form-group">
                                                  <label for="exampleInputEmail1">From Date</label>
                                                  <input type="text" class="form-control form-control-sm datepicker" name="from_date">
                                                  <span class="text-danger error-text from_date_error"></span>
                                                </div>
                                              <div class="form-group">
                                                <label for="exampleInputPassword1">To Date</label>
                                                <input type="text" class="form-control form-control-sm datepicker" name="to_date">
                                                <span class="text-danger error-text to_date_error"></span>
                                              </div>
                                              <button type="submit" class="btn btn-primary">Submit</button>
                                      </div>
                                  </div>
                              </form>
                            </div>

                            </div>
                        </div>
                    </div>
                
                </div>
            
    

      </div><!-- /.container-fluid -->

      
    </div>
  
    <div class="modal fade modal-fullscreen" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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



    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 
  
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
          

            $('.suppliers_list').on('click', function(e){
                e.preventDefault();
                $.ajax({
                    url:"{{ route('admin.suppliersList') }}",
                    method:'GET',
                    success:function(data){
                        $("#abc").html(data.html1);
                        $('#modalTitle').html(data.msg);
                        $(".hello").css("display", "block");
                            $(".addprint").css("display", "none");
                        // $(".addprint").remove(".addprint");
                        $('.modal').modal('show');
                    }
                })
            })

            $('.payables').on('click', function(e){
                e.preventDefault();
                $.ajax({
                    url:"{{ route('admin.payable') }}",
                    method:'GET',
                    success:function(data){
                        $("#abc").html(data.html1);
                        $('#modalTitle').html(data.msg);
                        $(".hello").css("display", "block");
                            $(".addprint").css("display", "none");
                        // $(".addprint").remove(".addprint");
                        $('.modal').modal('show');
                    }
                })
            })

            $('#payable-form').on('submit', function(e){
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
                            $(form)[0].reset();
                            $("#abc").html(data.html1);
                            $(".hello").css("display", "block");
                            $(".addprint").css("display", "none");
                            // $(".addprint").val();
                            $('#modalTitle').html(data.msg);
                            $('.modal').modal('show');
                        }
                            
                    }
                });
            });

            $('#purchase-form').on('submit', function(e){
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
                          $(form)[0].reset();
                            $("#abc").html(data.html1);
                            // $(".addprint").remove().append();
                            $(".hello").css("display", "none");
                            $(".addprint").css("display", "block");
                            $('.addprint').html(data.fname);
                            $('#modalTitle').html(data.msg);
                            $('.modal').modal('show');
                        }
                            
                    }
                });
            });
            
            $('#invoice-form').on('submit', function(e){
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
                            $(form)[0].reset();
                            $("#abc").html(data.html1);
                            $(".hello").css("display", "block");
                            $(".addprint").css("display", "none");
                            $('#modalTitle').html(data.msg);
                            $('.modal').modal('show');
                        }
                            
                    }
                });
            });

            $('#return-form').on('submit', function(e){
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
                            $(form)[0].reset();
                            $("#abc").html(data.html1);
                            // $(".addprint").remove().append();
                            $(".hello").css("display", "none");
                            $(".addprint").css("display", "block");
                            $('.addprint').html(data.fname);
                            $('#modalTitle').html(data.msg);
                            $('.modal').modal('show');
                        }
                            
                    }
                });
            });
            

    
      })
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
  
  <script>
    var divs = ["Div1", "Div2", "Div3", "Div4", "Div5", "Div6"];
    var visibleDivId = null;
    function divVisibility(divId) {
      if(visibleDivId === divId) {
        visibleDivId = null;
      } else {
        visibleDivId = divId;
      }
      hideNonVisibleDivs();
    }
    function hideNonVisibleDivs() {
      var i, divId, div;
      for(i = 0; i < divs.length; i++) {
        divId = divs[i];
        div = document.getElementById(divId);
        if(visibleDivId === divId) {
          div.style.display = "block";
        } else {
          div.style.display = "none";
        }
      }
    }
  </script>

<script>
    var a = document.querySelectorAll(".reportlist a");
    for (var i = 0, length = a.length; i < length; i++) {
      a[i].onclick = function() {
        var b = document.querySelector(".reportlist li.actives");
        if (b) b.classList.remove("actives");
        this.parentNode.classList.add('actives');
      };
    }



  $(document).ready(function() {
    $('#print-pdf-button').click(function(path) {
      var pdfUrl = path;
      //var win = window.open(pdfUrl, '_blank');
      var win = window.open(pdfUrl);
      win.focus();
      win.print();
    });
  });

 


  function myfunctionName(path){

    var pdfUrl = path;
      //var win = window.open(pdfUrl, '_blank');
      var win = window.open(pdfUrl);
      win.focus();
      win.print();

    }
     
</script>

<script>
  $(function() {
      $('.expandChildTable').on('click', function() {
          $(this).toggleClass('selected').closest('tr').next().toggle();
      })
  });
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
