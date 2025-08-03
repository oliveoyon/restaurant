@extends('dashboard.admin.layouts.admin-layout')
@section('title',  __('language.product_location'))

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
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('language.home') }}</a></li>
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
                    <div class="col-md-6">
                        <div class="card card-success " id="cards">
                            <div class="card-header">
                              <h3 class="card-title">Add a user</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <input type="text" class="form-control input" style="border:3px solid coral" id="search-input" placeholder="Product Name / Barcode" autofocus>
                                    <ul class="list-group col-md-12" id="search-results"></ul>
                                </div>
                                
                                <div class="form-group">
                                    <input type="text" class="form-control" id="product-name" placeholder="Product name" readonly>
                                    <input type="hidden" id="product-id">
                                </div>

                                <div class="row">
                                  <div class="col">
                                    <input type="text" class="form-control" placeholder="First name">
                                  </div>
                                  <div class="col">
                                    <input type="text" class="form-control" placeholder="Last name">
                                  </div>
                                </div>
                    
                                <div class="form-group">
                                    <input type="number" class="form-control" id="product-qty" placeholder="Enter quantity">
                                    </div>
                                    <div class="form-group">
                                    <input type="number" class="form-control" id="product-price" placeholder="Price" readonly>
                                </div>
                                <button type="button" class="btn btn-primary" onclick="addToCart()">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-success " id="cards">
                            <div class="card-header">
                              <h3 class="card-title">Add a user</h3>
                            </div>
                            <div class="card-body">
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
                                        
                                        <td colspan="4" class="text-right"><strong>Subtotal:</strong></td>
                                        <td><span id="cart-subtotal">0.00</span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-right"><strong>Discount:</strong></td>
                                        <td>
                                        <input type="number" class="form-control" id="cart-discount" placeholder="0" value="" style="max-width: 100px;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-right"><strong>Paid:</strong></td>
                                        <td>
                                        <input type="number" class="form-control" id="cart-paid" placeholder="0" value="" style="max-width: 100px;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-right"><strong>Grand Total:</strong></td>
                                        <td><span id="cart-grand-total">0.00</span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-right"><strong>Due:</strong></td>
                                        <td><span id="cart-due">0.00</span></td>
                                    </tr>
                                    </tfoot>
                                </table>
                                <form method="POST" action="{{ route('admin.save') }}">
                                <div class="mt-4">
                                    <button type="button" class="btn btn-danger" onclick="clearCart()">Clear Cart</button>
                                    <button type="submit" class="btn btn-primary" onclick="submitCart()">Save</button>
                                </div>
                            
                                
                                    @csrf
                                    <input type="hidden" name="cart_items" id="cart_items" value="">
                                    <input type="hidden" id="discount-input" name="discount" value="">
                                    <input type="hidden" id="paid-input" name="paid" value="">
                    
                                </form>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        
        
       
          
   
    </div>
    
        <!-- /.row -->
        @include('dashboard.admin.inc.shelfModal')
   

  
@endsection


@push('adminjs')
<script>
    let cartItems = [];
    
    function addToCart() {
  const productName = document.getElementById('product-name').value;
  const productId = document.getElementById('product-id').value;
  const productQty = document.getElementById('product-qty').value;
  const productPrice = document.getElementById('product-price').value;

  if (!productName || !productQty || !productPrice) {
    alert('Please fill all the fields.');
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
  $('#cart-paid').val(0);
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
    }
    
    
    function updateGrandTotal() {
      const cartSubtotal = parseFloat(document.getElementById('cart-subtotal').textContent);
      const discount = parseFloat(document.getElementById('cart-discount').value) || 0;
      const paid = parseFloat(document.getElementById('cart-paid').value) || 0;
    
      const grandTotal = cartSubtotal - discount;
      const due = grandTotal - paid;
    
      document.getElementById('cart-grand-total').textContent = grandTotal.toFixed(2);
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
    
    
    function submitCart() {
      const discount = parseFloat(document.getElementById('cart-discount').value);
      const paid = parseFloat(document.getElementById('cart-paid').value);
    
      document.getElementById('discount-input').value = discount;
      document.getElementById('paid-input').value = paid;
    
      const cartItemsInput = document.getElementById('cart_items');
      cartItemsInput.value = JSON.stringify(cartItems);
    
      document.forms[0].submit();
    }
    
      </script>
    
      
    <script>
    
    $(document).ready(function() {
        var selectedIndex = -1;
    
        // Attach event listener to input field
        $('#search-input').on('input', function() {
            var query = $(this).val();
    
            // Send AJAX request to controller with search query
            $.ajax({
                url: '/admin/search',
                type: 'GET',
                data: {query: query},
                success: function(response) {
                    // Display search results
                    var results = '';
    
                    $.each(response, function(index, value) {
                        // Add a data attribute to store the product title and price
                        results += '<li data-id="'+value.id+'"  data-name="'+value.product_title+'" data-price="'+value.sell_price+'">'+value.product_title+'</li>';
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
    
    </script>


    
@endpush

