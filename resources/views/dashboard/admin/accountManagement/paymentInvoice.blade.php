

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
              SUPPLIER PAYMENT INVOICE
            </td>
        </tr>
        <tr>
          <td height="10" style="font-size: 0px; line-height: 10px; height: 10px; padding: 0px;">&nbsp;</td>
        </tr>
    </table>
    <table width="100%" style="font-family: sans-serif;" cellpadding="10">
        <tr>
            <td width="49%" style="border: 0.1mm solid #fff;"><strong>Invoice No:</strong> #{{ $purchases[0]->invoice_no }}<br><strong>Invoice Date:</strong> #{{ date('F j, Y') }}<br><strong>Supplier Name: </strong> {{ $suppliers->supplier_name }}<br><br><strong>Telephone:</strong> {{ $suppliers->supplier_phone }}</td>
            <td width="2%">&nbsp;</td>
            <td width="49%" style="border: 0.1mm solid #fff; text-align: right;"><strong>{{ $settings->company_title }}</strong><br>{{ $settings->company_address }}<br><br><strong>Telephone:</strong> {{ $settings->company_phone }}<br></td>
        </tr>
    </table>
    <br>
   
    <br>
    <table class="items" width="100%" style="font-size: 14px; border-collapse: collapse;" cellpadding="8">
        <thead>
            <tr>
                <td><strong>Sl</strong></td>
                <td><strong>Description</strong></td>
                <td><strong>Total</strong></td>
                <td><strong>Discount</strong></td>
                <td><strong>Previous Paid</strong></td>
                <td><strong>Today's Paid</strong></td>
				
            </tr>
        </thead>
        <tbody>
            <!-- ITEMS HERE -->
            <tr>
                <td>1</td>
                <td>{{ 'Payment to Supplier for Invoice ' . $purchases[0]->invoice_no }}</td>
                <td>{{ $purchases[0]->total }}</td>
                <td>{{ $purchases[0]->discount }}</td>
                <td>{{ $purchases[0]->paid }}</td>
                <td style="text-align: right; font-weight:bold;">{{ $payment }}</td>
            </tr>
        </tbody>
    </table>
    <br>
    @php $milestoneWeight =
       $inword =  \App\Http\Controllers\Admin\AccountsReportController::convertNumberToWord($payment)
       
    @endphp
    <table width="100%" style="font-family: sans-serif; font-size: 14px;" >
        <tr>
            <td>
                <table width="70%" align="left" style="font-family: sans-serif; font-size: 14px;" >
                    <tr>
                        <td style="padding: 0px; line-height: 20px;"><span style="font-weight:bold">In Words: </span><?=ucwords($inword).' Only';?></td>
                    </tr>
                </table>
                <table width="30%" align="right" style="font-family: sans-serif; font-size: 14px;" >
                    <tr>
                        <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px; text-align:right;"><strong>Total Amount</strong></td>
                        <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px; text-align:right;">{{ $purchases[0]->total }}</td>
                    </tr>
                    <tr>
                        <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px; text-align:right;"><strong>Total Paid</strong></td>
                        <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px; text-align:right;">{{ $purchases[0]->paid + $payment }}</td>
                    </tr>
                    <tr>
                        <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px; text-align:right;"><strong>Discount</strong></td>
                        <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px; text-align:right;">{{ $purchases[0]->discount }}</td>
                    </tr>
                    <tr>
                        <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px; text-align:right;"><strong>Total Due</strong></td>
                        <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px; text-align:right;">{{ $purchases[0]->total - ($purchases[0]->paid + $payment + $purchases[0]->discount) }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <br>
  
</body>
</html>
