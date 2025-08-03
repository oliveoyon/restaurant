@extends('dashboard.admin.layouts.admin-layout')
@section('title', 'Edit Product Sell Price')
@push('admincss')
    <!-- DataTables -->
    <!-- In @stack('admincss') -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>


@endpush

@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mt-3">
                            <div class="card-header bg-info">Edit Product Sell Prices</div>
                            <div class="card-body">
                                <form id="product-selector-form">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Category:</label>
                                            <select name="category_id" id="category_id" class="form-control" required>
                                                <option value="">Select Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->category_name }}
                                                    </option>
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
                                </form>

                                <form action="{{ route('admin.update.sell.prices') }}" method="POST">
                                    @csrf
                                    <div id="batch-stock-table" class="mt-4"></div>
                                </form>
                            </div>
                        </div>
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
            $('#category_id').on('change', function() {
                let categoryId = $(this).val();
                $('#product_id').html('<option value="">Loading...</option>');

                $.post("{{ route('admin.get.products.by.category') }}", {
                    category_id: categoryId,
                    _token: '{{ csrf_token() }}'
                }, function(products) {
                    let options = '<option value="">Select Product</option>';
                    $.each(products, function(index, product) {
                        options +=
                            `<option value="${product.id}">${product.product_title}</option>`;
                    });
                    $('#product_id').html(options);
                });
            });

            $('#product_id').on('change', function() {
                let productId = $(this).val();
                $('#batch-stock-table').html('<p>Loading stock...</p>');

                $.post("{{ route('admin.get.product.batch.stock') }}", {
                    product_id: productId,
                    _token: '{{ csrf_token() }}'
                }, function(stocks) {
                    if (stocks.length === 0) {
                        $('#batch-stock-table').html('<p>No batch stock available.</p>');
                        return;
                    }

                    let table = `<table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Batch No</th>
                            <th>Purchase Date</th>
                            <th>Quantity</th>
                            <th>Buy Price</th>
                            <th>Sell Price</th>
                        </tr>
                    </thead>
                    <tbody>`;

                    $.each(stocks, function(i, stock) {
                        let date = new Date(stock.purchase_date);
                        let formattedDate = date.toLocaleDateString('en-GB', {
                            day: 'numeric',
                            month: 'long',
                            year: 'numeric'
                        });

                        table += `<tr>
                            <td>${stock.batch_no ?? '-'}</td>
                            <td>${formattedDate}</td>
                            <td>${stock.quantity}</td>
                            <td>${stock.buy_price}</td>
                            <td>
                                <input type="number" name="sell_prices[${stock.id}]" class="form-control" value="${stock.sell_price}" required>
                            </td>
                        </tr>`;
                    });


                    table += `</tbody></table>
                          <button type="submit" class="btn btn-primary">Update Sell Prices</button>`;
                    $('#batch-stock-table').html(table);
                });
            });
        });
    </script>
    <script>
    $(function () {
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif
    });
</script>
@endpush
