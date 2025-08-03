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
            <p style="font-size:18px; font-weight: bold; mts-5;">Expenditure</p>
            <p class="mts-5" style="font-size: 12px; font-style: italic;">Report printed as on <span style="font-weight:bold"><?php echo date("F j, Y"); ?></span></p>
        </div>
        
        <br>
       
        <br>
        <table class="items" width="100%" style="font-size: 14px; border-collapse: collapse;" cellpadding="8">
            <thead>
                <tr>
                    <th>Sl</th>
                    <th>Invoice No</th>
                    <th>Expenditure Type</th>
                    <th>Expenditure Date</th>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <!-- ITEMS HERE -->
                @php
                    $sum = 0;
                @endphp
                @forelse ($info as $inf)
                @php 
                    $desc =  \App\Http\Controllers\Admin\ExpenditureController::getDesc($inf->trns_id);
                    $sum = $sum + $inf->Exp;
                    $date = new DateTimeImmutable($inf->trns_date);
                    $pdate = $date->format('F j, Y');
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $inf->trns_id }}</td>
                    <td>{{ $inf->account_name }}</td>
                    <td>{{ $pdate }}</td>
                    <td><?php if($desc){echo $desc;}else{echo $inf->description;}?></td> 
                    <td>{{ $inf->Exp }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: right; font-weight:bold">Total</td>
                    <td style="text-align: right; font-weight:bold">
                    </td>
                </tr> 
                @endforelse
                
              
            
            </tbody>
            
        </table>
        <br>
        @php 
            $inword =  \App\Http\Controllers\Admin\AccountsReportController::convertNumberToWord($sum)
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
                            <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px; text-align:right;">{{ $sum }}</td>
                        </tr>
                        
                    </table>
                </td>
            </tr>
        </table>
        <br>
        
    </body>
    </html>
    
    