@extends('dashboard.admin.layouts.admin-layout')

@section('title', 'Add Product')

@push('admincss')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
<link rel="stylesheet" href="/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.11/dist/sweetalert2.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<style>
    #recipePreview {
        background: #f0f8ff;
        border-left: 4px solid #007bff;
        padding: 15px;
        border-radius: 5px;
    }
    #recipePreview h5 {
        font-weight: bold;
        margin-bottom: 10px;
    }
</style>
@endpush

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content pt-4">
        <div class="container-fluid">
            <h4>New Production Entry</h4>
            <form action="{{ route('admin.productions.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="product_id">Finished Product</label>
                            <select name="product_id" id="product_id" class="form-control" required>
                                <option value="">Select Product</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->product_title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="quantity">Quantity to Produce</label>
                            <input type="number" step="0.01" name="quantity" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="batch_no">Batch No (optional)</label>
                            <input type="text" name="batch_no" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="production_date">Production Date</label>
                            <input type="date" name="production_date" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Note</label>
                            <textarea name="note" class="form-control" rows="2"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Recipe Preview Section -->
                <div id="recipePreview" class="my-3"></div>

                <button type="submit" class="btn btn-primary">Record Production</button>
            </form>
        </div><!-- /.container-fluid -->
    </div>
</div>
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
<script>
document.getElementById('product_id').addEventListener('change', function () {
    const productId = this.value;
    const preview = document.getElementById('recipePreview');

    preview.innerHTML = 'Loading recipe...';

    fetch("{{ route('admin.productions.get-recipe') }}", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
        },
        body: JSON.stringify({ product_id: productId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.recipes.length === 0) {
            preview.innerHTML = '<p>No recipe found for this product.</p>';
        } else {
            let html = '<h5>Raw Materials Required:</h5><ul>';
            data.recipes.forEach(r => {
                html += `<li>${r.raw_product.product_title} - ${r.quantity} ${r.unit}</li>`;
            });
            html += '</ul>';
            preview.innerHTML = html;
        }
    });
});
</script>
@endpush
