@extends('dashboard.admin.layouts.admin-layout')
@section('title', 'Dashboard')
@push('admincss')
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
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
              <div class="col-12 col-sm-6 col-md-3" id="totalsale">
                <div class="info-box">
                  <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Today's Sale</span>
                    <span class="info-box-number">
                    {{ $todaysale[0]->totals }}
                    </span>
                  </div>
                </div>
              </div>
              
              <div class="col-12 col-sm-6 col-md-3" id="totalpurchase">
                <div class="info-box mb-3">
                  <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-shopping-basket"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Today's Purchase</span>
                    <span class="info-box-number">{{ $todaypurchase[0]->totals }}</span>
                  </div>
                </div>
              </div>
              
              
              <div class="clearfix hidden-md-up"></div>
                <div class="col-12 col-sm-6 col-md-3" id="receivale">
                  <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-user-friends"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Total Receivable</span>
                      <span class="info-box-number">{{ $receivable[0]->balance }}</span>
                    </div>
                  </div>
              </div>
              
              <div class="col-12 col-sm-6 col-md-3" id="payable">
                <div class="info-box mb-3">
                  <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-luggage-cart"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Total Payable</span>
                    <span class="info-box-number">{{ ($payable[0]->balance < 0 ? "(".abs($payable[0]->balance).")" : $payable[0]->balance) }}</span> 
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="card card-outline card-success">
                  <div class="card-header">
                      <h3 class="card-title" style="color:black; font-weight:bold">Quick Actions</h3> 
                  </div>
                  <div class="card-body">
                      <a class="btn btn-app bg-secondary" href="{{ route('admin.sale') }}" style="color:black"><i class="fas fa-shopping-cart"></i> POS</a>
                      <a class="btn btn-app" href="{{ route('admin.sales') }}" style="color:black"><i class="fas fa-shopping-cart"></i> Sale</a>
                      <a class="btn btn-app" href="{{ route('admin.purchaseProduct') }}" style="color:black;"><i class="fas fa-shopping-basket"></i> Purchase</a>
                      <a class="btn btn-app" href="{{ route('admin.salesReports') }}" style="color:black"><i class="fas fa-luggage-cart"></i> Customers</a>
                      <a class="btn btn-app" href="{{ route('admin.purchaseReports') }}" style="color:black"><i class="fas fa-user-friends"></i> Suppliers</a>
                      <a class="btn btn-app" href="{{ route('admin.accountsReport') }}" style="color:black"><i class="fas fa-money-check-alt"></i> Accounts</a>
                      <a class="btn btn-app" href="{{ route('admin.expenditure') }}" style="color:black"><i class="fas fa-money-check-alt"></i> Expenditure</a>
                      <a class="btn btn-app" href="{{ route('admin.receiveCustomer') }}" style="color:black"><i class="fas fa-hand-holding-usd"></i> Collection</a>
                      <a class="btn btn-app" href="{{ route('admin.paymentSupplier') }}" style="color:black"><i class="fas fa-file-invoice-dollar"></i> Payment</a>
                      <a class="btn btn-app" href="{{ route('admin.salesReports') }}" style="color:black"><i class="fas fa-file-invoice"></i> Sales Memo</a>
                     
                  </div>
                </div>
              </div>
            </div>

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


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

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  
  
@endsection

@push('adminjs')
<!-- Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    toastr.options.preventDuplicates = true;
      $.ajaxSetup({
          headers:{
              'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
          }
      });
    
      $(function(){
          

            $('#totalsale').on('click', function(e){
                e.preventDefault();
                $.ajax({
                    url:"{{ route('admin.todaysale') }}",
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

            
            $('#totalpurchase').on('click', function(e){
                e.preventDefault();
                $.ajax({
                    url:"{{ route('admin.todaypurchase') }}",
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

            $('#receivale').on('click', function(e){
                e.preventDefault();
                $.ajax({
                    url:"{{ route('admin.receivable') }}",
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
            
            $('#payable').on('click', function(e){
                e.preventDefault();
                $.ajax({
                    url:"{{ route('admin.dashpayable') }}",
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

            $(document).on('click','#challan', function(){
                  var invoice_no = $(this).data('id');
                  $.post("{{ route('admin.getChallan') }}",{invoice_no:invoice_no}, function(data){
                  $("#abc").html(data.html1);
                  $('#modalTitle').html(data.msg);
                  $('.modal').modal('show');
                },'json');
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
 

@endpush