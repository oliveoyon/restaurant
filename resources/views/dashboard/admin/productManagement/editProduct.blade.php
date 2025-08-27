@extends('dashboard.admin.layouts.admin-layout')
@section('title', 'Edit Product Prices')

@push('admincss')
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
@endpush

@section('content')
<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">
            <div class="card mt-3">
                <div class="card-header bg-info">Edit Product Prices</div>
                <div class="card-body">

                    {{-- Category & Product --}}
                    <div class="row">
                        <div class="col-md-6">
                            <label>Category:</label>
                            <select name="category_id" id="category_id" class="form-control" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Product:</label>
                            <select name="product_id" id="product_id" class="form-control" required>
                                <option value="">Select Product</option>
                            </select>
                        </div>
                    </div>

                    {{-- Batch stock table --}}
                    <form action="{{ route('admin.update.product.prices') }}" method="POST">
                        @csrf
                        <div id="batch-stock-table" class="mt-4"></div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('adminjs')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
$(document).ready(function() {
    // Load products by category
    $('#category_id').on('change', function() {
        let categoryId = $(this).val();
        $('#product_id').html('<option value="">Loading...</option>');

        $.post("{{ route('admin.get.products.by.category') }}", {
            category_id: categoryId,
            _token: '{{ csrf_token() }}'
        }, function(products) {
            let options = '<option value="">Select Product</option>';
            $.each(products, function(_, product) {
                options += `<option value="${product.id}">${product.product_title}</option>`;
            });
            $('#product_id').html(options);
        });
    });

    // Load batch stock + units + categories
    $('#product_id').on('change', function() {
        let productId = $(this).val();
        $('#batch-stock-table').html('<p>Loading stock...</p>');

        $.post("{{ route('admin.get.product.batch.stock') }}", {
            product_id: productId,
            _token: '{{ csrf_token() }}'
        }, function(res) {
            let stocks = res.stocks;
            let units = res.units;
            let product = res.product;
            let categories = @json($categories);

            // Case 1: No stock → show product-only form
            if(stocks.length === 0) {
                let unitOptions = '';
                $.each(units, function(_, unit) {
                    let selected = (unit.id == product.unit_id) ? 'selected' : '';
                    unitOptions += `<option value="${unit.id}" ${selected}>${unit.unit_name}</option>`;
                });

                let categoryOptions = '';
                $.each(categories, function(_, cat) {
                    let selected = (cat.id == product.category_id) ? 'selected' : '';
                    categoryOptions += `<option value="${cat.id}" ${selected}>${cat.category_name}</option>`;
                });

                let form = `<h5>Edit Product Info</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th>Product Title</th>
                            <td><input type="text" name="product_titles[${product.id}]" class="form-control" value="${product.product_title}" required></td>
                        </tr>
                        <tr>
                            <th>Unit</th>
                            <td><select name="units[${product.id}]" class="form-control">${unitOptions}</select></td>
                        </tr>
                        <tr>
                            <th>Category</th>
                            <td><select name="categories[${product.id}]" class="form-control">${categoryOptions}</select></td>
                        </tr>
                    </table>
                    <button type="submit" class="btn btn-primary">Update</button>`;

                $('#batch-stock-table').html(form);
                return;
            }

            // Case 2: Stock exists → show batch stock table
            let table = `<table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product Title</th>
                    <th>Batch No</th>
                    <th>Purchase Date</th>
                    <th>Quantity</th>
                    <th>Unit</th>
                    <th>Category</th>
                    <th>Buy Price</th>
                    <th>Sell Price</th>
                </tr>
            </thead><tbody>`;

            $.each(stocks, function(_, stock) {
                let date = stock.purchase_date ? new Date(stock.purchase_date) : new Date();
                let formattedDate = date.toLocaleDateString('en-GB', { day:'numeric', month:'long', year:'numeric' });

                let unitOptions = '';
                $.each(units, function(_, unit) {
                    let selected = (unit.id == stock.unit_id) ? 'selected' : '';
                    unitOptions += `<option value="${unit.id}" ${selected}>${unit.unit_name}</option>`;
                });

                let categoryOptions = '';
                $.each(categories, function(_, cat) {
                    let selected = (cat.id == stock.category_id) ? 'selected' : '';
                    categoryOptions += `<option value="${cat.id}" ${selected}>${cat.category_name}</option>`;
                });

                table += `<tr>
                    <td><input type="text" name="product_titles[${stock.id}]" class="form-control" value="${stock.product_title}" required></td>
                    <td>${stock.batch_no ?? '-'}</td>
                    <td>${formattedDate}</td>
                    <td>${stock.quantity}</td>
                    <td><select name="units[${stock.id}]" class="form-control">${unitOptions}</select></td>
                    <td><select name="categories[${stock.id}]" class="form-control">${categoryOptions}</select></td>
                    <td>${stock.buy_price}</td>
                    <td><input type="number" name="sell_prices[${stock.id}]" class="form-control" value="${stock.sell_price}" required></td>
                </tr>`;
            });

            table += `</tbody></table>
                      <button type="submit" class="btn btn-primary">Update</button>`;
            $('#batch-stock-table').html(table);
        });
    });

    @if(session('success'))
        toastr.success("{{ session('success') }}");
    @endif
});
</script>
@endpush
