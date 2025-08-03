<table class="table table-hover table-condensed">
    @foreach (session('cart') as $p)
    
    <tr>
        <td>{{ $p['quantity'] }}</td>
    </tr>
    
    @endforeach
</table>