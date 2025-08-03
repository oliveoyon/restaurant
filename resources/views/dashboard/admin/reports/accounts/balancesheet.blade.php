

<html>
<head>
    <style>
    body {
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
        border-bottom: 0.1mm solid #000000;
        padding: 0px 7px; line-height: 20px;
    }

    table thead th {
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
    
    .mts-5{padding-top: 5px;}
    
    .head{
        text-align: center;
    }
    </style>
</head>

<body>
    <div class="head">
        <p style="font-size: 25px; font-weight: bold; text-decoration:underline">{{ $settings->company_title }}</p>
        <p class="mts-5">{{ $settings->company_address }}</p>
        <p>{{ $settings->company_phone }}</p> <br>
        <p style="font-size:18px; font-weight: bold; mts-5;">Balance Sheet</p>
        <p class="mts-5" style="font-size: 12px; font-style: italic;">Report printed as on <span style="font-weight:bold"><?php echo date("F j, Y"); ?></span></p>
    </div>
    
    <br>
   
    <br>
    <table class="items" width="100%" style="font-size: 14px; border-collapse: collapse;" cellpadding="8">
        <thead>
            <tr>
                <th width="40%">Assets</th>
                <th width="10%">Taka</th>
                <th width="40%">Liabilities & Stockholder's Equity</th>
                <th width="10%">Taka</th>
                
            </tr>
        </thead>
        <tbody>
            @php
                $total = ($balancesheet[3]->balance + $balancesheet[1]->balance + $balancesheet[4]->balance);
                $grandtotal = $total - $balancesheet[2]->balance;
            @endphp

            <tr> 
                <td style='text-decoration: underline; font-weight:bold;'>
                    <span style='text-decoration: underline;'>{{ $balancesheet[0]->account_head }}</span><br><br><br><br><br><br><br><br><br>
                    <span>Total Assets</span><br><br>
                </td>
                <td style='font-weight:bold; text-align:right;'>
                    <span>{{ $balancesheet[0]->balance }}</span>
                    <br><br><br><br><br><br><br><br><br>
                    <span style="text-decoration-line: overline; text-decoration-style: double;">{{ $balancesheet[0]->balance }}</span><br><br>
                </td>
                <td style='text-decoration: underline; font-weight:bold;'>
                    <span>{{ $balancesheet[3]->account_head }}</span><br>
                    <span>{{ $balancesheet[1]->account_head }}</span><br>
                    <span>{{ $balancesheet[4]->account_head }}</span><br><br><br><br>
                    <span>{{ $balancesheet[2]->account_head }}</span> (-)<br><br><br>
                    <span>Total Liabilities & Stockholder's Equity</span><br><br>
                </td>
                <td style='font-weight:bold; text-align:right;'>
                    <span>{{ $balancesheet[3]->balance }}</span><br>
                    <span>{{ $balancesheet[1]->balance }}</span><br>
                    <span>{{ $balancesheet[4]->balance }}</span><br><br>
                    <span style="text-decoration-line: overline;">{{ $total }}</span><br><br>
                    <span>{{ $balancesheet[2]->balance }}</span><br><br><br>
                    <span style="text-decoration-line: overline; text-decoration-style: double;">{{ $grandtotal }}</span><br><br>
                </td>
                
                
  
            </tr>
            
            
          
		
        </tbody>
        
    </table>
    <br>
    
</body>
</html>
