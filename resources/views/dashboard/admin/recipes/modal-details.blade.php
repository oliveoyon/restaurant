<h5>Finished Product: {{ $product->product_title }}</h5>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Raw Material</th>
            <th>Quantity Per Unit</th>
            <th>Unit</th>
            <th>Unit Price (৳)</th>
            <th>Item Cost (৳)</th>
        </tr>
    </thead>
    <tbody>
        @foreach($recipeDetails as $row)
            <tr>
                <td>{{ $row['raw_product_title'] }}</td>
                <td>{{ $row['quantity'] }}</td>
                <td>{{ $row['unit'] }}</td>
                <td>{{ number_format($row['avg_price'], 2) }}</td>
                <td>{{ number_format($row['item_cost'], 2) }}</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th colspan="4" class="text-right">Estimated Total Cost (৳)</th>
            <th>{{ number_format($totalCost, 2) }}</th>
        </tr>
    </tfoot>
</table>
