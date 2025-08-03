
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>
  <base href="{{ \URL::to('/') }}">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.css">
  <link rel="stylesheet" href="dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="dist/css/custom.css">
  {{-- <link href="https://rawgithub.com/indrimuska/jquery-editable-select/master/dist/jquery-editable-select.min.css" rel="stylesheet"> --}}
  
  <style>
    [class*="sidebar-light-"] .nav-sidebar > .nav-item > .nav-treeview {
    background-color: rgb(6 59 229 / 5%);
    }
  </style>
  <style type="text/css">
    .loading {
        z-index: 20;
        position: absolute;
        top: 0;
        left:-5px;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.4);
    }
    .loading-content {
        position: absolute;
        border: 16px solid #f3f3f3;
        border-top: 16px solid #3498db;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        top: 40%;
        left:50%;
        animation: spin 2s linear infinite;
        }
          
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
</style>
</head>
{{-- <body class="hold-transition sidebar-mini"> --}}
  {{-- <body class="sidebar-mini skin-green-light" data-gr-c-s-loaded="true" style="height: auto; min-height: 100%;"> --}}
  <body class="sidebar-mini skin-blue-light text-sm" data-gr-c-s-loaded="true" style="height: auto; min-height: 100%;">
    <section id="loading">
      <div id="loading-content"></div>
  </section>
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('admin.home') }}" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

     
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
        </div>
      </li>
      
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  {{-- <aside class="main-sidebar sidebar-dark-success elevation-4"> --}}
    <aside class="main-sidebar sidebar-light-info elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-bold">IconBangla</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::guard('admin')->user()->name }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      {{-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="অনুসন্ধান করুন" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> --}}

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar text-sm flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          <li class="nav-item">
            <a href="{{ route('admin.home') }}" class="nav-link">
              <i class="fas fa-home nav-icon"></i>
              <p>{{ __('language.dashboard') }}</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                {{ __('language.product_management') }}
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview"> 
              <li class="nav-item">
                <a href="{{ route('admin.manufacturer-list') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('language.manufacturer') }}</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('admin.category-list') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('language.category_management') }}</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="{{ route('admin.unit-list') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('language.product_unit') }}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.shelf-list') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('language.product_location') }}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.brand-list') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('language.brands') }}</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('admin.addProduct') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('language.add_product') }}</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('admin.addProductToStocks') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('language.add_product_stock') }}</p>
                </a>
              </li>
             
              <li class="nav-item">
                <a href="{{ route('admin.stockDamage') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('language.stock_damage') }}</p>
                </a>
              </li>
              
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                {{ __('language.supplier_management') }}
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.supplier-list') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('language.suppliers') }}</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                {{ __('language.customer_management') }}
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.customer-list') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('language.customers') }}</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                {{ __('language.account_management') }}
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.account_type_list') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('language.chart_account') }}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.openingBalance') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('language.opening_balance') }}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.receiveCustomer') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('language.receive_customer') }}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.chequeClearance') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('language.cheque_clearance') }}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.paymentSupplier') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('language.payment_supplier') }}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.expenditure') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('language.expenditure') }}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.journal') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('language.journal_voucher') }}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.contra') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('language.contra_transaction') }}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('language.bill_issue') }}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('language.bill_receive') }}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('language.bank_reconcilation') }}</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                {{ __('language.purchase_management') }}
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.purchaseProduct') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('language.product_purchase') }}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.purchaseReturn') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('language.purchase_return') }}</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                {{ __('language.sales_management') }}
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.sales') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('language.product_sale') }}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.salesReturn') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('language.sales_return') }}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('language.sale_quotation') }}</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                {{ __('language.reports') }}
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.stockReports') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('language.stock_report') }}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.purchaseReports') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('language.purchase_report') }}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.salesReports') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('language.sale_report') }}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.accountsReport') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('language.accounts_report') }}</p>
                </a>
              </li>
            </ul>
          </li>
          {{-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                {{ __('language.academic_fee_setup') }}
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.fee-head-list') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('language.academic_fee_head') }}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.class-list') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('language.academic_fee_group') }}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.section-list') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('language.academic_fee_amount') }}</p>
                </a>
              </li>
            </ul>
          </li> --}}
          
          <li class="nav-item">
            <a href="{{ route('admin.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
              <form action="{{ route('admin.logout') }}" id="logout-form" method="post">@csrf</form>
            </a>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

 @yield('content')

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Developed By: IconBangla
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2023 <a href="">Digital Application for Storre Management</a></strong> All Right Reserved
  </footer>
</div>
<!-- ./wrapper -->



<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/select2/js/select2.full.min.js"></script>
<script src="dist/js/bootstrap-datepicker.min.js"></script> 
<script src="dist/js/bootstrap-timepicker.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script src="{{ asset('datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('datatable/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('toastr/toastr.min.js') }}"></script>

<script src="plugins/chart.js/Chart.min.js"></script>
{{-- <script src="dist/js/demo.js"></script> --}}

<script src="dist/js/pages/dashboard3.js"></script>
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<script src="{{ asset('jquery-editable-select.min.js') }}"></script>


@stack('adminjs')



<script type="text/javascript">
 
// AdminLTe 3.0.x
/** add active class and stay opened when selected */
var url = window.location;

// for sidebar menu entirely but not cover treeview
  $('ul.nav-sidebar a').filter(function() {
    return this.href == url;
  }).addClass('active');

// for treeview
  $('ul.nav-treeview a').filter(function() {
    return this.href == url;
  }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');

  $('.select2bs4').select2({
      theme: 'bootstrap4'
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

<script>
  $(function () {
    // Summernote
    $('.summernote').summernote();
  })
</script>


</body>

<script type="text/javascript">
  
  $(document).ajaxStart(function() {
      $('#loading').addClass('loading');
      $('#loading-content').addClass('loading-content');
  });

  $(document).ajaxStop(function() {
      $('#loading').removeClass('loading');
      $('#loading-content').removeClass('loading-content');
  });
    
</script>

@yield('javascript')
</html>
