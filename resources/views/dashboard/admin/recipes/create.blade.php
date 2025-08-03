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
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Add Product</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Add Product</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->



        <div class="content">
            <div class="container-fluid">


                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Create Product Recipe</h3>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <form action="{{ route('admin.recipes.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_id">Finished Product</label>
                                        <select name="product_id" id="product_id" class="form-control select2" required>
                                            <option value="">-- Select Product --</option>
                                            @foreach ($products->where('category_id', 2) as $product)
                                                <option value="{{ $product->id }}">{{ $product->product_title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sale_price">Sale Price</label>
                                        <input type="number" name="sale_price" id="sale_price" step="0.01"
                                            class="form-control" placeholder="Enter Sale Price" required>
                                    </div>
                                </div>
                            </div>


                            <hr>

                            <div id="raw-items">
                                <div class="row raw-item mb-2">
                                    <div class="col-md-6">
                                        <label>Raw Material</label>
                                        <select name="raw_product_id[]" class="form-control raw-product" required>
                                            <option value="">-- Select Raw Material --</option>
                                            @foreach ($products->where('category_id', 3) as $product)
                                                <option value="{{ $product->id }}" data-unit-id="{{ $product->unit_id }}">
                                                    {{ $product->product_title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Quantity (e.g., grams)</label>
                                        <input type="number" step="any" name="quantity[]" class="form-control"
                                            required>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="unit">Unit</label>
                                        <select name="unit[]" class="form-control unit-select" required>
                                            <option value="">Select Unit</option>
                                            @foreach ($units as $unit)
                                                <option value="{{ $unit->unit_name }}" data-id="{{ $unit->id }}">
                                                    {{ $unit->unit_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2 d-flex align-items-end">
                                        <button type="button" class="btn btn-danger remove-item">×</button>
                                    </div>
                                </div>
                            </div>

                            <button type="button" id="add-item" class="btn btn-info mt-3">Add Raw Material</button>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">Save Recipe</button>
                            <a href="{{ route('admin.recipes.index') }}" class="btn btn-secondary">Back</a>
                        </div>
                    </form>
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
        $(function() {
            $('.summernote').summernote();
        })
    </script>
    <script>
        document.getElementById('add-item').addEventListener('click', function() {
            const rawItem = document.querySelector('.raw-item');
            const clone = rawItem.cloneNode(true);
            clone.querySelectorAll('input').forEach(input => input.value = '');
            rawItem.parentNode.appendChild(clone);
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-item')) {
                const items = document.querySelectorAll('.raw-item');
                if (items.length > 1) {
                    e.target.closest('.raw-item').remove();
                }
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Delegate event in case there are multiple dynamically added blocks
            document.querySelector('#raw-items').addEventListener('change', function(e) {
                if (e.target.classList.contains('raw-product')) {
                    const rawSelect = e.target;
                    const selectedOption = rawSelect.options[rawSelect.selectedIndex];
                    const unitId = selectedOption.getAttribute('data-unit-id');

                    // Find the unit dropdown in the same row
                    const row = rawSelect.closest('.raw-item');
                    const unitSelect = row.querySelector('.unit-select');

                    if (unitId && unitSelect) {
                        const unitOptions = unitSelect.options;
                        for (let i = 0; i < unitOptions.length; i++) {
                            const option = unitOptions[i];
                            if (option.getAttribute('data-id') == unitId) {
                                option.selected = true;
                                break;
                            }
                        }
                    }
                }
            });
        });
    </script>
@endpush
