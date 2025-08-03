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

        <h4 class="mb-3">Production Details</h4>

    <a href="{{ route('admin.productions.index') }}" class="btn btn-secondary mb-3">Back to List</a>

    <div class="card mb-4">
        <div class="card-header">
            Finished Product Info
        </div>
        <div class="card-body">
            <p><strong>Product:</strong> {{ $production->product->product_title ?? 'N/A' }}</p>
            <p><strong>Quantity Produced:</strong> {{ $production->quantity }}</p>
            <p><strong>Batch No:</strong> {{ $production->batch_no ?? '-' }}</p>
            <p><strong>Production Date:</strong> {{ $production->production_date ?? '-' }}</p>
            <p><strong>Note:</strong> {{ $production->note ?? '-' }}</p>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            Raw Materials Used
        </div>
        <div class="card-body">
            @if($rawMaterials->count())
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Raw Product</th>
                            <th>Quantity</th>
                            <th>Unit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rawMaterials as $item)
                            <tr>
                                <td>{{ $item->rawProduct->product_title ?? 'N/A' }}</td>
                                <td>{{ $item->quantity_used }}</td>
                                <td>{{ $item->unit ?? 'N/A' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">No raw materials recorded.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            @else
                <p>No raw materials linked to this production.</p>
            @endif
        </div>
    </div>

        
      
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
