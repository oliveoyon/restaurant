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
        <input type="number" class="form-control" id="cart-discount" placeholder="0" value="" style="max-width: 100px;">
        </td>
    </tr>
    <tr>
        <td colspan="3" class="text-right"><strong>Paid:</strong></td>
        <td colspan="2">
        <input type="number" class="form-control" id="cart-paid" placeholder="0" value="" style="max-width: 100px;">
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
    <tr>
      <td colspan="3" class="text-right"><strong>Received in:</strong></td>
      <td colspan="2">
        {{-- <select name="" id="payment-method" class="form-control form-control-sm">
            <option value="1">Cash</option>
            <option value="2">Bank Cheque</option>
        </select> --}}
        <select name="" id="payment-method" class="form-control form-control-sm">
            <option value="1">Cash</option>
            <option value="2">Bank Cheque</option>
        </select>
      </td>
    </tr>
    </tfoot>
</table>