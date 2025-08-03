@extends('dashboard.admin.layouts.admin-layout')
@section('title', 'Dashboard')

@section('content')
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">ড্যাশবোর্ড</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">হোম</a></li>
              <li class="breadcrumb-item active">ড্যাশবোর্ড</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    

    <!-- Main content -->
    <div class="content">
        <div class="card card-primary card-outline">
            <div class="card-header">f
                <h3 class="card-title">
                <i class="fas fa-edit"></i>
                Accounts Report
                </h3>
            </div>
            <div class="card-body">
                <h4>Reports</h4>
                <div class="row">
                    <div class="col-5 col-sm-3">
                        <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill" href="#vert-tabs-home" role="tab" aria-controls="vert-tabs-home" aria-selected="true">Home</a>
                            <a class="nav-link suppliers_list">Suppliers List</a>
                            <a class="nav-link payables">Payable Suppliers</a>
                            <a class="nav-link" id="vert-tabs-profile-tab" data-toggle="pill" href="#vert-tabs-profile" role="tab" aria-controls="vert-tabs-profile" aria-selected="false">Payable</a>
                            <a class="nav-link" id="vert-tabs-messages-tab" data-toggle="pill" href="#vert-tabs-messages" role="tab" aria-controls="vert-tabs-messages" aria-selected="false">Invoice Wise Payable</a>
                            <a class="nav-link" id="vert-tabs-settings-tab" data-toggle="pill" href="#vert-tabs-settings" role="tab" aria-controls="vert-tabs-settings" aria-selected="false">Date Wise Payable</a>
                        </div>
                    </div>
                <div class="col-7 col-sm-9">
                    <div class="tab-content" id="vert-tabs-tabContent">
                        <div class="tab-pane text-left fade show active" id="vert-tabs-home" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
                        You can find some usefull reports in this tab
                        </div>
                        <div class="tab-pane fade" id="vert-tabs-profile" role="tabpanel" aria-labelledby="vert-tabs-profile-tab">
                        Mauris tincidunt mi at erat gravida, eget tristique urna bibendum. Mauris pharetra purus ut ligula tempor, et vulputate metus facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas sollicitudin, nisi a luctus interdum, nisl ligula placerat mi, quis posuere purus ligula eu lectus. Donec nunc tellus, elementum sit amet ultricies at, posuere nec nunc. Nunc euismod pellentesque diam.
                        </div>
                        <div class="tab-pane fade" id="vert-tabs-messages" role="tabpanel" aria-labelledby="vert-tabs-messages-tab">
                        Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna.
                        </div>
                        <div class="tab-pane fade" id="vert-tabs-settings" role="tabpanel" aria-labelledby="vert-tabs-settings-tab">
                                {{-- settings --}}
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
                                {{-- settings end --}}
                        </div>
                    </div>
                </div>
                </div>
            
    

      </div><!-- /.container-fluid -->

      
    </div>
    
    
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Launch demo modal
      </button>
    <div class="modal fade modal-fullscreen" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="print">
                <div id="printThis" class="printme">
                <div id="abc"></div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" onclick="printDiv('printMe')">Save changes</button>
              <button id="btnPrint" type="button" class="btn btn-default">Print</button>
              <input type="button" value="click"
                    onclick="printDiv()">
            </div>
          </div>
        </div>
      </div>



    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

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
  @include('dashboard.admin.adminjs.reports.payable')
@endpush
