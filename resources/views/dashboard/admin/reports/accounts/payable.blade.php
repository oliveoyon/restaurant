   
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
            <p style="font-size:18px; font-weight: bold; mts-5;">Payable Suppliers List</p>
            <p class="mts-5" style="font-size: 12px; font-style: italic;">Report printed as on <span style="font-weight:bold"><?php echo date("F j, Y"); ?></span></p>
        </div>
        
        <br>
       
        <br>
        <table class="items" width="100%" style="font-size: 14px; border-collapse: collapse;" cellpadding="8">
            <thead>
                <tr>
                    <th>Sl</th>
                    <th>Supplier Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Phone</th>
                    <th>Totals</th>
                    
                </tr>
            </thead>
            <tbody>
                <!-- ITEMS HERE -->
                @forelse ($suppliers as $sup)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $sup->account_name }}</td>
                    <td>{{ $sup->supplier_address }}</td>
                    <td>{{ $sup->supplier_phone }}</td>
                    <td>{{ $sup->supplier_phone }}</td>
                    <td style="text-align: right">{{ ($sup->balance < 0 ? "(".abs($sup->balance).")" : $sup->balance) }}</td>  
                </tr>
                
                @empty
                    
                @endforelse
                
                <tr>
                    <td colspan="5" style="text-align: right; font-weight:bold">Total</td>
                    <td style="text-align: right; font-weight:bold">
                        <?php $sum = array_sum(array_column($suppliers, 'balance')); echo ($sum < 0 ? "(".abs($sum).")" : $sum); ?>
                    </td>
                </tr>
              
            
            </tbody>
            
        </table>
        <br>
        
    </body>
    </html>
    