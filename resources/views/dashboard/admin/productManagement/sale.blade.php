<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Inventory Management</title>
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <!-- AdminLTE CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/smoothness/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
</head>

<body class="hold-transition sidebar-mini">
  <style>
   #search-results {
  position: absolute;
  z-index: 1;
  width: 100%;
  max-height: 200px;
  overflow-y: auto;
  margin: 0;
  padding: 0;
  list-style: none;
  background-color: #fff;
  border: 1px solid #ccc;
  border-top: none;
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
}

#search-results li {
  padding: 10px;
  cursor: pointer;
}

#search-results li.active {
  background-color: #62dd96;
  color:white;
}


  </style>
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="#">Logout</a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="#" class="brand-link">
        <img src="https://adminlte.io/themes/v3/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
          class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Inventory Management</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
              alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">John Doe</a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-box"></i>
                <p>
                  Products
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Customers
                </p>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <div class="row">
        <div class="col-md-6">
            <div class="form-group">
              <label for="product-name">Product Name</label>
              <input type="text" class="form-control" id="product-name" placeholder="Enter product name">
              <input type="hidden" id="product-id" value="5">
            </div>
            
            {{-- <div class="form-group">
              <label for="product-name">Search</label>
              <input type="text" id="search-input" placeholder="Search...">
              <ul id="search-results"></ul>
            </div> --}}

            <div class="form-group">
              <label for="product-qty">Search</label>
              <input type="text" class="form-control" id="search-input" placeholder="Search...">
              <ul id="search-results"></ul>
            </div>

            <div class="form-group">
              <label for="product-qty">Quantity</label>
              <input type="number" class="form-control" id="product-qty" placeholder="Enter quantity">
            </div>
            <div class="form-group">
              <label for="product-price">Price</label>
              <input type="number" class="form-control" id="product-price" placeholder="Enter price">
            </div>
            <button type="button" class="btn btn-primary" onclick="addToCart()">Add to Cart</button>
          </div>
          <div class="col-md-6">
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
                  <td colspan="2">
                    <button type="button" class="btn btn-danger" onclick="clearCart()">Clear Cart</button>
                  </td>
                  <td colspan="2" class="text-right"><strong>Subtotal:</strong></td>
                  <td><span id="cart-subtotal">0.00</span></td>
                </tr>
                <tr>
                  <td colspan="2"></td>
                  <td colspan="2" class="text-right"><strong>Discount:</strong></td>
                  <td>
                    <input type="number" class="form-control" id="cart-discount" placeholder="Enter discount" value="">
                  </td>
                </tr>
                <tr>
                  <td colspan="2"></td>
                  <td colspan="2" class="text-right"><strong>Paid:</strong></td>
                  <td>
                    <input type="number" class="form-control" id="cart-paid" placeholder="Enter paid amount" value="">
                  </td>
                </tr>
                <tr>
                  <td colspan="2"></td>
                  <td colspan="2" class="text-right"><strong>Grand Total:</strong></td>
                  <td><span id="cart-grand-total">0.00</span></td>
                </tr>
                <tr>
                  <td colspan="2"></td>
                  <td colspan="2" class="text-right"><strong>Due:</strong></td>
                  <td><span id="cart-due">0.00</span></td>
                </tr>
              </tfoot>
            </table>
            <div class="mt-4">
              <button type="button" class="btn btn-danger" onclick="clearCart()">Clear Cart</button>
              <button type="submit" class="btn btn-primary" onclick="submitCart()">Save</button>
            </div>
      
            <form method="POST" action="{{ route('admin.save') }}">
              @csrf
              <input type="hidden" name="cart_items" id="cart_items" value="">
              <input type="hidden" id="discount-input" name="discount" value="">
              <input type="hidden" id="paid-input" name="paid" value="">

            </form>
        </div>
      </div>
    </div>


  </div>


  <script>
    let cartItems = [];

function addToCart() {
  const productName = document.getElementById('product-name').value;
  const productId = document.getElementById('product-id').value;
  const productQty = document.getElementById('product-qty').value;
  const productPrice = document.getElementById('product-price').value;

  if (!productName || !productId || !productQty || !productPrice) {
    alert('Please fill all the fields.');
    return;
  }

  const total = parseFloat(productQty) * parseFloat(productPrice);
  const cartItem = {
    id: parseInt(productId),
    name: productName,
    qty: parseInt(productQty),
    price: parseFloat(productPrice),
    total: total
  };

  cartItems.push(cartItem);
  renderCart();
  clearFields();
  $('#search-input').val('');
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
          <input type="number" class="form-control" value="${item.qty}" onchange="updateCartItem(${index}, this.value)">
        </td>
        <td>${item.price.toFixed(2)}</td>
        <td>${item.total.toFixed(2)}</td>
        <td><button type="button" class="btn btn-danger" onclick="removeCartItem(${index})">Remove</button></td>
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
                    results += '<li data-name="'+value.product_title+'" data-price="74">'+value.product_title+'</li>';
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

        // Set the product name and price input values
        $('#product-name').val(productName);
        $('#product-price').val(productPrice);

        // Clear the search results
        $('#search-results').html('');
        selectedIndex = -1;
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
            }
        }
    });

    $(document).on('click', function(event) {
        if (!$(event.target).closest('#search-results').length) {
            $('#search-results').html('');
            selectedIndex = -1;
        }
    });
});



</script>




</body>

</html>