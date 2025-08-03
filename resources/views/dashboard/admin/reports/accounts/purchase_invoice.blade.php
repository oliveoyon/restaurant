<!doctype html>
<html>
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=yes" />
<title>Table with expandable rows</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

<style>
.expandChildTable:before {
    content: "+";
    display: block;
    cursor: pointer;
	color:red;
	font-size:20px;
	font-weight:bold;
}
.expandChildTable.selected:before {
    content: "-";
	color:green;
	font-size:20px;
	font-weight:bold;
}
.childTableRow {
    display: none;
}
.childTableRow table {
    border: 2px solid #555;
}
</style>
</head>
<body>

  
<div class="container">
    <p style="font-size: 20px; font-weight: bold; text-decoration:underline; text-align:center;">{{ $settings->company_title }}</p>
    <p class="text-center">{{ $settings->company_address }}</p>
    <p class="text-center text-bold">{{ $datetime }}</p>
      
<table class="table">
    <thead>
        <tr>
            <th></th>
            <th>Invoice No</th>
            <th>Supplier Name</th>
            <th>Total</th>
            <th>Due</th>
            <th>Discount</th>
            <th>Paid</th>
        </tr>
    </thead>
    @forelse ($invoices as $inv)
    @php $milestoneWeight =
       $detail =  \App\Http\Controllers\Admin\AccountsReportController::getPurchaseDetail($inv->invoice_no)
    @endphp
    <tr>
        <td><span class="expandChildTable"></span></td>
        <td style="font-weight: bold">{{ $inv->invoice_no }}</td>
        <td>{{ $inv->supplier_name }}</td>
        <td>{{ $inv->total }}</td>
        <td>{{ $inv->due }}</td>
        <td>{{ $inv->discount }}</td>
        <td>{{ $inv->paid }}</td>
    </tr>
    <tr class="childTableRow">
        <td colspan="7">
            <h6>Details for Invoice - {{ $inv->invoice_no }}</h6>
            <table class="table">
                <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Product Name</th>
                        <th>Purchase Date</th>
                        <th>Barcode</th>
                        <th>Serial</th>
                        <th>Batch</th>
                        <th>Qty</th>
                        <th>Buy Price</th>
                        <th>VAT</th>
                        <th>Sale Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $sum = 0;
                    @endphp
                    @forelse ($detail as $det)
                    @php
                        $date = new DateTimeImmutable($det->purchase_date);
                        $pdate = $date->format('F j, Y');
                        $sum += $det->buy_price_with_tax * $det->quantity;
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $det->product_title }}</td>
                        <td>{{ $pdate }}</td>
                        <td>{{ $det->barcode }}</td>
                        <td>{{ $det->serial_no }}</td>
                        <td>{{ $det->batch_no }}</td>
                        <td>{{ $det->quantity }}</td>
                        <td style="text-align: right">{{ $det->buy_price }}</td>
                        <td>{{ $det->tax_value_percent }}</td>
                        <td style="text-align: right">{{ $det->sell_price }}</td>
                        <td style="text-align: right">{{ $det->buy_price_with_tax * $det->quantity }}</td>
                    </tr>   
                    @empty
                        
                    @endforelse
                    
                    <tr>
                        <td colspan="10" style="text-align: right; font-weight:bold">Total</td>
                        <td style="text-align: right; font-weight:bold">
                            <?php echo $sum; ?>
                        </td>
                    </tr>
                    
                </tbody>
            </table>
        </td>
    </tr>
        
    @empty
        
    @endforelse
    
    
</table>
</div>

 
<script src="https://code.jquery.com/jquery.js"></script>
<!-- Latest compiled and minified JavaScript -->

<script>
$(function() {
    $('.expandChildTable').on('click', function() {
        $(this).toggleClass('selected').closest('tr').next().toggle();
    })
});
</script>
</body>
</html>