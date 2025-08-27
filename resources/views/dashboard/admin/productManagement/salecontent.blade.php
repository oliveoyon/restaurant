@extends('dashboard.admin.layouts.admin-layout')
@section('title', 'POS Sale')

@push('admincss')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="dist/css/custom.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@section('content')

    <style>
        #search-results {
            position: absolute;
            z-index: 1;
            width: auto;
            max-height: 200px;
            overflow-y: auto;
            margin: 0;
            padding: 0;
            list-style: none;
            background-color: #fff;
            border-top: none;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
        }

        #search-results li {
            padding: 10px;
            cursor: pointer;
        }

        #search-results li:hover,
        #search-results li.active {
            background-color: #62dd96;
            color: white;
        }

        input[type="text"],
        input[type="number"] {
            height: 30px;
            padding: 4px 8px;
            font-size: 14px;
        }

        .table td,
        .table th {
            padding: 0.5rem;
            font-size: 14px;
        }

        .input::placeholder {
            color: gray !important;
            font-weight: bold;
            opacity: 1;
        }

        input[readonly] {
            background-color: white !important;
            ;
        }

        .pdt-single {
            cursor: pointer;
            text-align: center;
            border: 1px solid #62dd96;
            padding-left: 5px;
            padding-right: 5px;
            padding-top: 5px;
        }

        .pdt-single:hover {
            cursor: pointer;
            text-align: center;

        }

        .pdt-single p {
            color: rgb(80, 78, 78);
            font-weight: bold;
        }

        .pdt-single p:hover {
            color: rgb(3, 3, 3);
        }

        .pdtactive {
            border: 3px solid #0bcf5d;
            padding-left: 3px;
            padding-right: 3px;
            padding-top: 3px;
            background: #f9f9f9
        }
    </style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ __('language.product_location') }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('language.home') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('language.product_location') }}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-success " id="cards">
                            <div class="card-header">
                                <h3 class="card-title">Add to Cart</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <input type="text" id="customer_phone" class="form-control"
                                        placeholder="Enter customer phone">
                                </div>

                                <div id="new_customer_fields" style="display:none;">
                                    <div class="form-group">
                                        <input type="text" id="customer_name" class="form-control"
                                            placeholder="Enter customer name">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" id="customer_email" class="form-control form-control-sm"
                                            placeholder="Enter customer email">
                                    </div>
                                    {{-- <button type="button" id="save_customer" class="btn btn-primary btn-sm">Save
                                        Customer</button> --}}
                                </div>

                                <div class="form-group">
                                    <select name="customer_id" id="customer_selected" class="form-control form-control-sm">
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->parent_id }}"
                                                {{ $customer->is_walkin ? 'selected' : '' }}>
                                                {{ $customer->customer_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="sale_date" id="sale_date" class="form-control"
                                        value="{{ date('Y-m-d') }}" required autocomplete="off" />
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control input" style="border:3px solid coral"
                                        id="search-input" placeholder="Product Name / Barcode" autofocus>
                                    <ul class="list-group col-md-12" id="search-results"></ul>
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control" id="product-name" placeholder="Product name"
                                        readonly>
                                    <input type="hidden" id="product-id">
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <input type="number" class="form-control" id="product-qty"
                                                placeholder="Enter quantity">
                                        </div>
                                        <div class="col">
                                            <input type="number" class="form-control" id="product-price"
                                                placeholder="Price">
                                        </div>
                                    </div>
                                </div>
                                <button type="button" id="save_customer" class="btn btn-primary" onclick="addToCart()">Add to Cart</button>
                            </div>
                        </div>
                        {{-- cart table --}}
                        <div class="card " id="cards">

                            <div class="card-body table-responsive">
                                <table id="cart-table" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Cart items will be added dynamically here -->
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3" class="text-right"><strong>Subtotal:</strong></td>
                                            <td colspan="2"><span id="cart-subtotal">0.00</span></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-right"><strong>Discount:</strong></td>
                                            <td colspan="2">
                                                <input type="number" class="form-control" id="cart-discount"
                                                    placeholder="0" value="" style="max-width: 100px;" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-right"><strong>Paid:</strong></td>
                                            <td colspan="2">
                                                <input type="number" class="form-control" id="cart-paid"
                                                    placeholder="0" value="" style="max-width: 100px;" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-right"><strong>Grand Total:</strong></td>
                                            <td colspan="2"><span id="cart-grand-total">0.00</span></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-right"><strong>Due:</strong></td>
                                            <td colspan="2"><span id="cart-due">0.00</span></td>
                                        </tr>
                                        <tr id="cheque-row" style="display: none;">
                                            <td colspan="3" class="text-right"><strong>Cheque Details:</strong></td>
                                            <td colspan="2">
                                                <input type="text" class="form-control" id="chequenumber"
                                                    placeholder="Cheque No" style="max-width: 100px;" value="">
                                                {{-- <input type="text" class="form-control" name="cheque_date" id="cheque-date" placeholder="Cheque Date" style="max-width: 100px;"> --}}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td colspan="3" class="text-right"><strong>Received in:</strong></td>
                                            <td colspan="2">
                                                <select id="payment-method" class="form-control form-control-sm">
                                                    @foreach ($accounts as $account)
                                                        <option value="{{ $account->id }}">{{ $account->account_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>

                                <form action="{{ route('admin.save') }}" method="post" id="sale-product-form"
                                    autocomplete="off">
                                    @csrf
                                    <input type="hidden" name="cart_items" id="cart_items" value="">
                                    <input type="hidden" id="discount-input" name="discount" value="">
                                    <input type="hidden" id="paid-input" name="paid" value="">
                                    <input type="hidden" id="customer_ids" name="customer_ids" value="">
                                    <input type="hidden" id="chequenumber1" name="chequedetail1" value="">
                                    <input type="hidden" id="payment-method1" name="credit" value="">
                                    <input type="hidden" id="sale_date1" name="sale_date" value="">
                                    <div class="mt-4">
                                        <button type="button" class="btn btn-danger" onclick="clearCart()">Clear
                                            Cart</button>
                                        <button type="submit" class="btn btn-primary"
                                            onclick="submitCart()">Save</button>
                                    </div>




                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card card-success " id="cards">
                            <div class="card-header">
                                <h3 class="card-title">Product List</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @forelse ($pdts as $pdt)
                                        <div class="col-md-2">
                                            <div class="pdt-single " data-id="{{ $pdt->id }}"
                                                data-name="{{ $pdt->product_title }}"
                                                data-price="{{ $pdt->sell_price }}">
                                                <img class="img-thumbnail" style="height:100px;width:100px"
                                                    src="{{ $pdt->stckpdt_image ? 'storage/images/products/' . $pdt->stckpdt_image : 'https://placehold.jp/100x100.png' }}"
                                                    alt="">
                                                <h5>{{ $pdt->product_title }}</h5>
                                                <p>Tk. {{ $pdt->sell_price }} <br><small style="font-weight:bold"> Qty.
                                                        {{ $pdt->quantity . ' ' . $pdt->unit_name }}</small></p>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-md-12">
                                            <h2>No Data Found</h2>
                                        </div>
                                    @endforelse


                                </div>


                            </div>
                        </div>

                    </div>
                </div>

                <!-- Modal -->

                <div class="modal fade" id="addcustomers" tabindex="-1" aria-labelledby="addCustomerLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-success">
                                <h5 class="modal-title" id="addCustomerLabel">{{ __('language.add_customsser') }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('admin.addCustomerinSales') }}" method="post"
                                    id="add-customer-form" autocomplete="off">
                                    @csrf
                                    <div class="form-group">
                                        <label for="">{{ __('language.customer_name') }}</label>
                                        <input type="text" class="form-control" name="customer_name"
                                            placeholder="{{ __('language.add_customer') }}">
                                        <span class="text-danger error-text customer_name_error"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{ __('language.customer_address') }}</label>
                                        <input type="text" class="form-control" name="customer_address"
                                            placeholder="{{ __('language.customer_address') }}">
                                        <span class="text-danger error-text customer_address_error"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{ __('language.customer_phone') }}</label>
                                        <input type="text" class="form-control" name="customer_phone"
                                            placeholder="{{ __('language.customer_phone') }}">
                                        <span class="text-danger error-text customer_phone_error"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{ __('language.customer_email') }}</label>
                                        <input type="email" class="form-control" name="customer_email"
                                            placeholder="{{ __('language.customer_email') }}">
                                        <span class="text-danger error-text scustomer_email_error"></span>
                                    </div>


                                    <div class="form-group">
                                        <button type="submit"
                                            class="btn btn-block btn-success">{{ __('language.save') }}</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="modal fade modal-fullscreen modalsale" id="exampleModal" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <span class="hello"><input type="button" class="btn btn-success" value="Print"
                                        onclick="printDiv()"></span>

                                <span class="addprint"></span>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>





    </div>




@endsection


@push('adminjs')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.2.0/dist/sweetalert2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        flatpickr("#sale_date", {
            dateFormat: "Y-m-d",
            maxDate: "today",
        });
    </script>

    <script>
        let cartItems = [];

        function addToCart() {
            const productName = document.getElementById('product-name').value;
            const productId = document.getElementById('product-id').value;
            const productQty = document.getElementById('product-qty').value;
            const productPrice = document.getElementById('product-price').value;

            if (!productName || !productQty || !productPrice) {
                // alert('Please fill all the fields.');
                toastr.error('Please fill all the fields.');
                return;
            }

            const total = parseFloat(productQty) * parseFloat(productPrice);
            const existingCartItemIndex = cartItems.findIndex(item => item.id === parseInt(productId));
            if (existingCartItemIndex !== -1) {
                cartItems[existingCartItemIndex].qty = parseInt(productQty);
                cartItems[existingCartItemIndex].price = parseFloat(productPrice);
                cartItems[existingCartItemIndex].total = parseFloat(productQty) * parseFloat(productPrice);
            } else {
                const cartItem = {
                    id: parseInt(productId),
                    name: productName,
                    qty: parseInt(productQty),
                    price: parseFloat(productPrice),
                    total: total
                };
                cartItems.push(cartItem);
            }

            renderCart();
            clearFields();
            $('#search-input').val('');
            // $('#cart-paid').val(0);
            $('#cart-discount').val(0);
        }


        function renderCart() {
            const cartTableBody = document.querySelector('#cart-table tbody');
            const cartSubtotal = document.querySelector('#cart-subtotal');
            const cartGrandTotal = document.querySelector('#cart-grand-total');
            const cartDiscount = document.querySelector('#cart-discount');
            const cartPaid = document.querySelector('#cart-paid');
            const cartDue = document.querySelector('#cart-due');

            cartTableBody.innerHTML = '';
            let total = 0;
            cartItems.forEach(function(item, index) {
                const row = `
                <tr>
                    <td>${item.name}</td>
                    <td>
                    <input type="number" class="form-control" value="${item.qty}" onchange="updateCartItem(${index}, this.value)"  style="max-width: 80px;">
                    </td>
                    <td>${item.price.toFixed(2)}</td>
                    <td>${item.total.toFixed(2)}</td>
                    <td><button type="button" class="btn btn-sm btn-danger" onclick="removeCartItem(${index})"><i class="fas fa-trash-alt"></i></button></td>
                </tr>
                `;
                cartTableBody.insertAdjacentHTML('beforeend', row);
                total += item.total;
            });

            cartSubtotal.textContent = total.toFixed(2);

            let discount = parseFloat(cartDiscount.value) || 0;
            let paid = parseFloat(cartPaid.value) || 0;
            let grandTotal = total - discount;
            cartGrandTotal.textContent = grandTotal.toFixed(2);

            let due = grandTotal - paid;
            cartDue.textContent = due.toFixed(2);
            $('#cart-paid').val(grandTotal);
        }


        function updateGrandTotal() {
            const cartSubtotal = parseFloat(document.getElementById('cart-subtotal').textContent);
            const discount = parseFloat(document.getElementById('cart-discount').value) || 0;
            const paid = parseFloat(document.getElementById('cart-paid').value) || 0;

            const grandTotal = cartSubtotal - discount;
            const due = grandTotal - paid;

            document.getElementById('cart-grand-total').textContent = grandTotal.toFixed(2);
            document.getElementById('cart-paid').textContent = grandTotal.toFixed(2);
            document.getElementById('cart-due').textContent = due.toFixed(2);
        }


        function removeCartItem(index) {
            cartItems.splice(index, 1);
            renderCart();
        }

        function clearCart() {

            cartItems = [];
            renderCart();
        }

        function clearFields() {
            document.getElementById('product-name').value = '';
            //   document.getElementById('product-id').value = '';
            document.getElementById('product-qty').value = '';
            document.getElementById('product-price').value = '';
        }

        function updateCartItem(index, qty) {
            const item = cartItems[index];
            item.qty = parseInt(qty);
            item.total = parseFloat(qty) * item.price;
            renderCart();
        }

        const cartDiscount = document.querySelector('#cart-discount');
        const cartPaid = document.querySelector('#cart-paid');

        cartDiscount.addEventListener('change', updateGrandTotal);
        cartPaid.addEventListener('change', updateGrandTotal);



        async function submitCart() {
            const discount = parseFloat(document.getElementById('cart-discount').value);
            const paid = parseFloat(document.getElementById('cart-paid').value);
            const customer = document.getElementById('customer_selected').value;
            const chqdetail = document.getElementById('chequenumber').value;
            const acc = document.getElementById('payment-method').value;
            const sale_date = document.getElementById('sale_date').value;

            document.getElementById('discount-input').value = discount;
            document.getElementById('paid-input').value = paid;
            document.getElementById('customer_ids').value = customer;
            document.getElementById('chequenumber1').value = chqdetail;
            document.getElementById('payment-method1').value = acc;
            document.getElementById('sale_date1').value = sale_date;

            const cartItemsInput = document.getElementById('cart_items');

            cartItemsInput.value = JSON.stringify(cartItems);



            // Call the clearcart() function and reset some input fields to 0

            document.getElementById('cart-discount').value = 0;
            document.getElementById('cart-paid').value = 0;
            clearCart();


            const form = document.forms[0];

            const response = await fetch(form.action, {
                method: form.method,
                body: new FormData(form)
            });



            const data = await response.json();
            console.log(data);
        }
    </script>


    <script>
        $(document).ready(function() {
            document.body.classList.add('sidebar-collapse');
            var selectedIndex = -1;

            // Attach event listener to input field
            $('#search-input').on('input', function() {
                var query = $(this).val();

                // Send AJAX request to controller with search query
                $.ajax({
                    url: '/admin/search',
                    type: 'GET',
                    data: {
                        query: query
                    },
                    success: function(response) {
                        // Display search results
                        var results = '';

                        $.each(response, function(index, value) {
                            // Add a data attribute to store the product title and price
                            results += '<li data-id="' + value.id + '"  data-name="' +
                                value.product_title + '" data-price="' + value
                                .sell_price + '">' + value.product_title + ' - ৳' +
                                value.sell_price + '</li>';
                        });

                        $('#search-results').html(results);
                        selectedIndex = -1;
                    }
                });
            });

            // Attach event listeners to search result items
            $(document).on('click', '#search-results li', function() {
                var productName = $(this).data('name');
                var productPrice = $(this).data('price');
                var productId = $(this).data('id');

                // Set the product name and price input values
                $('#product-name').val(productName);
                $('#product-price').val(productPrice);
                $('#product-id').val(productId);

                // Clear the search results
                $('#search-results').html('');
                selectedIndex = -1;
                $('#search-input').val('');
                $('#product-qty').focus();
            });

            $(document).on('click', '.pdt-single', function() {
                var productName = $(this).data('name');
                var productPrice = $(this).data('price');
                var productId = $(this).data('id');

                // Set the product name and price input values
                $('#product-name').val(productName);
                $('#product-price').val(productPrice);
                $('#product-id').val(productId);

                // Clear the search results
                $('#search-results').html('');
                selectedIndex = -1;
                $('#search-input').val('');
                $('#product-qty').focus();
            });

            $(document).on('keydown', function(event) {
                if (event.keyCode === 38) { // Up arrow key
                    event.preventDefault();
                    var listItems = $('#search-results li');
                    if (selectedIndex > 0) {
                        listItems.eq(selectedIndex).removeClass('active');
                        selectedIndex--;
                    } else {
                        listItems.eq(selectedIndex).removeClass('active');
                        selectedIndex = listItems.length - 1;
                    }
                    listItems.eq(selectedIndex).addClass('active');
                } else if (event.keyCode === 40) { // Down arrow key
                    event.preventDefault();
                    var listItems = $('#search-results li');
                    if (selectedIndex < listItems.length - 1) {
                        if (selectedIndex >= 0) {
                            listItems.eq(selectedIndex).removeClass('active');
                        }
                        selectedIndex++;
                    } else {
                        if (selectedIndex >= 0) {
                            listItems.eq(selectedIndex).removeClass('active');
                        }
                        selectedIndex = 0;
                    }
                    listItems.eq(selectedIndex).addClass('active');
                } else if (event.keyCode === 13) { // Enter key
                    event.preventDefault();
                    if (selectedIndex >= 0) {
                        var productName = $('#search-results li.active').data('name');
                        var productPrice = $('#search-results li.active').data('price');

                        // Set the product name and price input values
                        $('#product-name').val(productName);
                        $('#product-price').val(productPrice);

                        // Clear the search results
                        $('#search-results').html('');
                        selectedIndex = -1;
                        $('#search-input').val('');
                        $('#product-qty').focus();
                    }
                }
            });

            $(document).on('click', function(event) {
                if (!$(event.target).closest('#search-results').length) {
                    $('#search-results').html('');
                    selectedIndex = -1;
                    $('#search-input').val('');

                }
            });
        });


        $('#add-customer-form').on('submit', function(e) {
            e.preventDefault();
            var form = this;
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $(form).find('span.error-text').text('');
                },
                success: function(data) {
                    if (data.code == 0) {
                        $.each(data.error, function(prefix, val) {
                            $(form).find('span.' + prefix + '_error').text(val[0]);
                        });
                    } else {
                        // $('#manufacturer-table').DataTable().ajax.reload(null, false);
                        clearCart()
                        $("#customer_selected").find('option').remove().end().append(data.unititem);
                        $('#addcustomers').modal('hide');
                        $('#addcustomers').find('form')[0].reset();
                        toastr.success(data.msg);
                    }
                }
            });
        });


        $(document).ready(function() {
            // Show/hide cheque row based on payment method
            $("#payment-method").change(function() {
                if ($("#payment-method option:selected").text() === "Bank Cheque") {
                    $("#cheque-row").show();
                } else {
                    $("#cheque-row").hide();
                    $("#chequenumber").val("");
                }
            });
        });

        $(function() {
            $('#sale-product-form').on('submit', function(e) {
                e.preventDefault();
                var form = this;
                $.ajax({
                    url: $(form).attr('action'),
                    method: $(form).attr('method'),
                    data: new FormData(form),
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    beforeSend: function() {
                        $(form).find('span.error-text').text('');
                    },
                    success: function(data) {
                        if (data.code == 0) {
                            toastr.error(data.msg);
                        } else {
                            // document.forms[0].submit();
                            toastr.success(data.msg);
                            $('#modalTitle').html(data.msg);
                            $("#abc").html(data.html1);
                            $('.modalsale').modal('show');
                            // location.href = "{{ URL::to('admin/sales/') }}";
                        }
                    }
                });
            });
        });

        function printDiv() {
            var contents = document.getElementById("printThis").innerHTML;
            var frame1 = document.createElement('iframe');
            frame1.name = "frame1";
            frame1.style.position = "absolute";
            frame1.style.top = "-1000000px";
            document.body.appendChild(frame1);
            var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1
                .contentDocument.document : frame1.contentDocument;
            frameDoc.document.open();
            frameDoc.document.write(contents);
            frameDoc.document.close();
            setTimeout(function() {
                window.frames["frame1"].focus();
                window.frames["frame1"].print();
                document.body.removeChild(frame1);
            }, 500);
            return false;
        }
    </script>

    {{-- CSS change for right side products on click --}}

    <script>
        const divs = document.querySelectorAll('.pdt-single');

        divs.forEach((div) => {
            div.addEventListener('click', handleClick);
        });

        let activeDiv = null;

        function handleClick() {
            if (activeDiv) {
                activeDiv.classList.remove('pdtactive');
            }

            this.classList.add('pdtactive');
            activeDiv = this;
        }





        $(function() {
            $('#customer_phone').on('keyup', function() {
                let phone = $(this).val().trim();
                if (phone.length === 0) {
                    $('#new_customer_fields').hide();
                    $('#customer_selected').val('').trigger('change');
                    return;
                }
                $.post('{{ route('admin.customers.checkPhone') }}', {
                    phone: phone,
                    _token: '{{ csrf_token() }}'
                }, function(data) {
                    if (data.exists) {
                        $('#customer_selected').val(data.customer.id).trigger('change');
                        $('#new_customer_fields').hide();
                    } else {
                        $('#customer_selected').val('').trigger('change');
                        $('#new_customer_fields').show();
                    }
                });
            });

            $('#save_customer').click(function() {
                let phone = $('#customer_phone').val().trim();
                let name = $('#customer_name').val().trim();
                let email = $('#customer_email').val().trim();

                // ✅ If name is blank, use phone number as name
                if (!name) {
                    name = phone;
                }

                if (!phone) {
                    alert('Phone is required');
                    return;
                }

                $.post('{{ route('admin.customers.store') }}', {
                    phone: phone,
                    name: name,
                    email: email,
                    _token: '{{ csrf_token() }}'
                }, function(data) {
                    if (data.success) {
                        let option = new Option(data.customer.name, data.customer.id, true, true);
                        $('#customer_selected').append(option).trigger('change');
                        $('#new_customer_fields').hide();
                        $('#customer_name').val('');
                        $('#customer_email').val('');
                    } else {
                        alert('Failed to save customer');
                    }
                }).fail(function(xhr) {
                    // alert('Error saving customer');
                });
            });
        });
    </script>
@endpush
