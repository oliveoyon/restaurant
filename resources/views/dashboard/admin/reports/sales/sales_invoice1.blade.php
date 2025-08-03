<!doctype html>
<html>
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=yes" />
<title>Table with expandable rows</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">


</head>
<body>

  
<div class="container">
    <p style="font-size: 20px; font-weight: bold; text-decoration:underline; text-align:center;">{{ $settings->company_title }}</p>
    <p class="text-center">{{ $settings->company_address }}</p>
    <p class="text-center text-bold">{{ $datetime }}</p>
      
<table class="table">
    <thead>
        <tr>
            <th>Invoice No</th>
            <th>Customer Name</th>
            <th>Total</th>
            <th>Due</th>
            <th>Discount</th>
            <th>Paid</th>
            <th>Action</th>
        </tr>
    </thead>
    @forelse ($invoices as $inv)
    
    <tr>
        <td style="font-weight: bold">{{ $inv->invoice_no }}</td>
        <td>{{ $inv->customer_name }}</td>
        <td>{{ $inv->total }}</td>
        <td>{{ $inv->due }}</td>
        <td>{{ $inv->discount }}</td>
        <td>{{ $inv->paid }}</td>
        <td>
            <div class="btn-group">
                <button class="btn btn-sm btn-primary" data-id="{{ $inv->invoice_no }}" id="challan">Challan</button>
                <button class="btn btn-sm btn-danger" data-id="{{ $inv->invoice_no }}" id="editBrandBtn">Memo</button>
            </div>
        </td>
    </tr>
    
        
    @empty
        
    @endforelse
    
    
</table>
</div>


</body>
</html>