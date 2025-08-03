<table class="table table-hovered table-bordered">
    <thead>
        <tr>
            <th>Sl</th>
            <th>Supplier Name</th>
            <th>Invoice Name</th>
            <th>Total</th>
            <th>Discount</th>
            <th>Paid</th>
            <th>Due</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <!-- ITEMS HERE -->
        @forelse ($paymentLists as $pl)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $pl->supplier_name }}</td>
            <td>{{ $pl->invoice_no }}</td>
            <td>{{ $pl->total }}</td>
            <td>{{ $pl->discount }}</td>
            <td>{{ $pl->paid }}</td>
            <td>{{ $pl->due }}</td>
            <td>
                <div class="btn-group">
                    <span class="btn btn-sm btn-primary" data-id="{{ $pl->invoice_no }}" id="editBrandBtn">Pay Now</span>
                </div>
            </td>
        </tr>
        
        @empty

        <tr>
            <td colspan="8">No Data Found</td>
        </tr>
            
        @endforelse
        
        
      
    
    </tbody>
</table>


