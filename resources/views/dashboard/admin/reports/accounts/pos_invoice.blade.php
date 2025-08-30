<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>POS Invoice</title>
    <style>
        body {
            font-family: monospace;
            font-size: 12px;
            width: 80mm; /* adjust for 58mm if needed */
        }
        .center { text-align: center; }
        .left { text-align: left; }
        .right { text-align: right; }
        hr { border: dashed 1px #000; margin: 5px 0; }
        table { width: 100%; border-collapse: collapse; }
        td { padding: 2px 0; }
    </style>
</head>
<body>
    <div class="center">
        <strong>My Store Name</strong><br>
        123 Main Street<br>
        City, Country<br>
        Phone: 0123456789
    </div>

    <hr>

    <div>
        Invoice No: {{ $invoice_no }}<br>
        Date: {{ $sale_date }}<br>
        Customer: {{ $customer_name ?? 'Walk-in' }}
    </div>

    <hr>

    <table>
        <thead>
            <tr>
                <td class="left">Item</td>
                <td class="center">Qty</td>
                <td class="right">Price</td>
                <td class="right">Total</td>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td class="left">{{ $item['name'] }}</td>
                <td class="center">{{ $item['qty'] }}</td>
                <td class="right">{{ number_format($item['price'], 2) }}</td>
                <td class="right">{{ number_format($item['qty'] * $item['price'], 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <hr>

    <table>
        <tr>
            <td class="left">Subtotal</td>
            <td class="right">{{ number_format($subtotal, 2) }}</td>
        </tr>
        <tr>
            <td class="left">Discount</td>
            <td class="right">{{ number_format($discount, 2) }}</td>
        </tr>
        <tr>
            <td class="left">Paid</td>
            <td class="right">{{ number_format($paid, 2) }}</td>
        </tr>
        <tr>
            <td class="left"><strong>Total Due</strong></td>
            <td class="right"><strong>{{ number_format($due, 2) }}</strong></td>
        </tr>
    </table>

    <hr>

    <div class="center">
        Thank you for shopping!<br>
        Visit Again!
    </div>
</body>
</html>
