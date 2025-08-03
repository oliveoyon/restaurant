

<html>
<head>
    <style>
    body {
        font-family: sans-serif;
        font-size: 10pt;
    }

    p {
        margin: 0pt;
    }

    table.items {
        border: 0.1mm solid #000000;
    }

    td {
        vertical-align: top;
    }

    .items td {
        border-left: 0.1mm solid #000000;
        border-right: 0.1mm solid #000000;
        /* border-bottom: 0.1mm solid #000000; */
    }

    table thead td {
        text-align: center;
        border: 0.1mm solid #000000;
    }

    .items td.blanktotal {
        background-color: #EEEEEE;
        border: 0.1mm solid #000000;
        background-color: #FFFFFF;
        border: 0mm none #000000;
        border-top: 0.1mm solid #000000;
        border-right: 0.1mm solid #000000;
    }

    .items td.totals {
        text-align: right;
        border: 0.1mm solid #000000;
    }

    .items td.cost {
        text-align: "."center;
    }
    </style>
</head>

<body>
    <table width="100%" style="font-family: sans-serif;" cellpadding="10">
        <tr>
            <td width="100%" style="padding: 0px; text-align: center;">
              
            </td>
        </tr>
        <tr>
         <td width="100%" style="text-align: center; font-size: 25px; font-weight: bold; padding: 0px;">
           <u>{{ $settings->company_title }}</u> 
         </td>
        </tr>
        
        <tr>
         <td></td>
        </tr>
        <tr>
            <td width="100%" style="text-align: center; font-size: 20px; font-weight: bold; padding: 0px;">
              SALES INVOICE
            </td>
        </tr>
        <tr>
          <td height="10" style="font-size: 0px; line-height: 10px; height: 10px; padding: 0px;">&nbsp;</td>
        </tr>
    </table>
    <table width="100%" style="font-family: sans-serif;" cellpadding="10">
        <tr>
            <td width="49%" style="border: 0.1mm solid #fff;"><strong>Invoice No:</strong> #{{ $sales->invoice_no }}<br><strong>Customer Name: </strong> {{ $customer->customer_name }}<br><br><strong>Telephone:</strong> {{ $customer->customer_phone }}</td>
            <td width="2%">&nbsp;</td>
            <td width="49%" style="border: 0.1mm solid #fff; text-align: right;"><strong>{{ $settings->company_title }}</strong><br>{{ $settings->company_address }}<br><br><strong>Telephone:</strong> {{ $settings->company_phone }}<br></td>
        </tr>
    </table>
    <br>
   
    <br>
    <table class="items" width="100%" style="font-size: 14px; border-collapse: collapse;" cellpadding="8">
        <thead>
            <tr>
                <td width="5%" style="text-align: left;"><strong>Sl</strong></td>
                <td width="55%" style="text-align: left;"><strong>Description</strong></td>
                <td width="10%" style="text-align: left;"><strong>Qty</strong></td>
                <td width="15%" style="text-align: left;"><strong>Rate</strong></td>
                <td width="15%" style="text-align: left;"><strong>Total</strong></td>
				
            </tr>
        </thead>
        <tbody>
            <!-- ITEMS HERE -->
            @foreach ($salepdts as $salepdt)
            <tr>
                <td style="padding: 0px 7px; line-height: 20px;">{{ $loop->iteration }}</td>
                <td style="padding: 0px 7px; line-height: 20px;">{{ $salepdt->product_title }}</td>
                <td style="padding: 0px 7px; line-height: 20px;">{{ $salepdt->quantity }}</td>
                <td style="padding: 0px 7px; line-height: 20px;">{{ $salepdt->rate }}</td>
                <td style="padding: 0px 7px; line-height: 20px;">{{ $salepdt->quantity * $salepdt->rate }}</td>
            </tr>
            @endforeach
            
            
			
        
            
            
        </tbody>
    </table>
    <br>
    @php $milestoneWeight =
       $inword =  \App\Http\Controllers\Admin\AccountsReportController::convertNumberToWord($sales->total)
       
    @endphp
    <table width="100%" style="font-family: sans-serif; font-size: 14px;" >
        <tr>
            <td>
                <table width="75%" align="left" style="font-family: sans-serif; font-size: 14px;" >
                    <tr>
                        <td style="padding: 0px; line-height: 20px;"><span style="font-weight:bold">In Words: </span>{{ ucfirst($inword) }}</td>
                    </tr>
                </table>
                <table width="25%" align="right" style="font-family: sans-serif; font-size: 14px;" >
                    <tr>
                        <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px; text-align:right;"><strong>Total Amount</strong></td>
                        <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px; text-align:right;">{{ $sales->total }}</td>
                    </tr>
                    <tr>
                        <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px; text-align:right;"><strong>Paid</strong></td>
                        <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px; text-align:right;">{{ $sales->paid }}</td>
                    </tr>
                    <tr>
                        <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px; text-align:right;"><strong>Discount</strong></td>
                        <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px; text-align:right;">{{ $sales->discount }}</td>
                    </tr>
                    <tr>
                        <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px; text-align:right;"><strong>Due</strong></td>
                        <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px; text-align:right;">{{ $sales->due }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <br><br><br><br><br>

    <table width="100%" style="font-family: sans-serif; font-size: 14px;" >
        <tr>
            <td width="67%" style="text-align: left">Customer's Sign:</td>
            
            <td width="33%" style="text-align: right">Manager's Sign:</td>              
        </tr>
    </table>

    <?php if($sales->check_pending == 1){ ?>
    <div style="text-align: center; font-weight:bold"><h2>Checque is given by Customer. It subjects to clearing the Cheque</h2></div>
    <?php } ?>
  
</body>
</html>
