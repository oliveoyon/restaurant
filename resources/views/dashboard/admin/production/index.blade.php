@extends('dashboard.admin.layouts.admin-layout')
@section('title', 'Add Product')
@push('admincss')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
<link rel="stylesheet" href="/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.11/dist/sweetalert2.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endpush

@section('content')
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  


    <div class="content">
      <div class="container-fluid">

        <h4 class="mb-3">Production List</h4>

    <a href="{{ route('admin.productions.create') }}" class="btn btn-success mb-3">Add New Production</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Batch No</th>
                <th>Date</th>
                <th>Note</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($productions as $key => $prod)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $prod->product->product_title ?? 'N/A' }}</td>
                    <td>{{ $prod->quantity }}</td>
                    <td>{{ $prod->batch_no ?? '-' }}</td>
                    <td>{{ $prod->production_date ?? '-' }}</td>
                    <td>{{ $prod->note ?? '-' }}</td>
                    <td>
                        <a href="{{ route('admin.productions.show', $prod->id) }}" class="btn btn-sm btn-info">View</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No productions found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
        

        
      
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
         <!-- Modal -->




@endsection

@push('adminjs')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.2.0/dist/sweetalert2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
@include('dashboard.admin.adminjs.addproductjs')
<script>
  $(function () {
    $('.summernote').summernote();
  })
</script>

@endpush
