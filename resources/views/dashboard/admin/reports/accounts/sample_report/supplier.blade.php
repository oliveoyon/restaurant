

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
            border-bottom: 0.1mm solid #000000;
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
             <td width="100%" style="text-align: center; padding: 0px;">
               <p style="font-size: 25px; font-weight: bold;"><u>{{ $settings->company_title }}</u></p>
               <p style="font-weight: bold;">{{ $settings->company_address }}</p>
             </td>
            </tr>
            
            <tr>
             <td></td>
            </tr>
            <tr>
             <td></td>
            </tr>
            <tr>
                <td width="100%" style="text-align: center; font-size: 20px; font-weight: bold; padding: 0px;">
                  Suppliers List
                </td>
            </tr>
            <tr>
              <td height="10" style="font-size: 0px; line-height: 10px; height: 10px; padding: 0px;">&nbsp;</td>
            </tr>
        </table>
        
       
        <br>
        {{-- <table class="items" width="100%" style="font-size: 14px; border-collapse: collapse;" cellpadding="8">
            <thead>
                <tr>
                    <td style="text-align: left;"><strong>Sl</strong></td>
                    <td style="text-align: left;"><strong>Supplier Name</strong></td>
                    <td style="text-align: left;"><strong>Address</strong></td>
                    <td style="text-align: left;"><strong>Phone</strong></td>
                    <td style="text-align: left;"><strong>Total</strong></td>
                </tr>
            </thead>
            <tbody>
                <!-- ITEMS HERE -->
                @forelse ($suppliers as $sup)
                <tr>
                    <td style="padding: 0px 7px; line-height: 20px;">{{ $loop->iteration }}</td>
                    <td style="padding: 0px 7px; line-height: 20px;">{{ $sup->supplier_name }}</td>
                    <td style="padding: 0px 7px; line-height: 20px;">{{ $sup->supplier_address }}</td>
                    <td style="padding: 0px 7px; line-height: 20px;">{{ $sup->supplier_phone }}</td>
                    <td style="padding: 0px 7px; line-height: 20px;">2,590.00</td>
                </tr>
                @empty
                    
                @endforelse
                
                
                
            </tbody>
        </table> --}}
        <table class="table table-bordered" style="justify-content:center;">
            <thead>
                <tr>
                    <th>Sl</th>
                    <th>Supplier Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>dd</th>
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
                    <td class="text-right">{{ ($sup->balance < 0 ? "(".abs($sup->balance).")" : $sup->balance) }}</td>  
                </tr>
                @empty
                    <p>Nothing Found</p>
                @endforelse
                
                <tr>
                    <td colspan="4" class="text-right text-bold">Total</td>
                    <td class="text-right text-bold">
                        <?php $sum = array_sum(array_column($suppliers, 'balance')); echo ($sum < 0 ? "(".abs($sum).")" : $sum); ?>
                    </td>
                </tr>
                
                
            </tbody>
        </table>
        <br>
        
      <script type="text/javascript">
          window.onload = function() { window.print(); }
     </script>  
    </body>
    </html>
    