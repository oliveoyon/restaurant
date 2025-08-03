<table class="table table-hover table-condensed">
    <tr>
        <th>Product Name</th>
        <th>Manufacturer</th>
        <th>Category</th>
        <th>Brand</th>
        <th>Quantity</th>
        <th>Action</th>
    </tr>
    @foreach ($product as $p)
    <tr>
        <td>{{ $p->product_title }}</td>
        <td>{{ $p->manufacturer_name }}</td>
        <td>{{ $p->category_name }}</td>
        <td>{{ $p->brand_name }}</td>
        <td>{{ $p->quantity }}</td>
        <td><a class="btn btn-sm btn-primary" href="{{ route('admin.addtostock', ['id' => $p->product_hash_id]) }}">Add to Stock</a></td>
    </tr>
    
    @endforeach
</table>