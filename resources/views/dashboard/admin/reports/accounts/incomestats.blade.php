   
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
            <p style="font-size:18px; font-weight: bold; mts-5;">{{ $msgs }}</p>
            <p class="mts-5" style="font-size: 12px; font-style: italic;">Report printed as on <span style="font-weight:bold"><?php echo date("F j, Y"); ?></span></p>
        </div>
        
        <br>
       
        <br>
        <table class="items" width="100%" style="font-size: 14px; border-collapse: collapse;" cellpadding="8">
            <thead>
                <tr>
                    <th>Account Name</th>
                    <th>Description</th>
                    <th>Tk</th>
                    <th>Tk</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="font-weight:bold;">Revenues</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                @php
                    $revsum = 0;
                @endphp
                @foreach ($incomestats as $inf)
                
                    @if ($inf->account_head == 'Revenue')
                    @php
                        $revsum = $revsum + $inf->balance;
                    @endphp
                    <tr>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;{{ $inf->account_name }}</td>
                        <td>{{ $inf->description }}</td>
                        <td style="text-align: right;">{{ $inf->balance }}</td>
                        <td></td>
                    </tr>
                    @endif
                @endforeach
                <tr>
                    <td colspan="2" style="text-align: right; font-weight:bold;">Total Revenues</td>
                    <td></td>
                    <td style="text-align: right; font-weight:bold;">{{ $revsum }}</td>
                </tr>
                <tr>
                    <td><br></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                
                <tr>
                    <td style="font-weight:bold;">Expenses and Loss</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                @php
                    $expsum = 0;
                @endphp
                @foreach ($incomestats as $inf)
                
                    @if ($inf->account_head == 'Expenses')
                    @php
                        $expsum = $expsum + $inf->balance;
                    @endphp
                    <tr>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;{{ $inf->account_name }}</td>
                        <td>{{ $inf->description }}</td>
                        <td style="text-align: right;">{{ $inf->balance }}</td>
                        <td></td>
                    </tr>
                    @endif
                @endforeach
                <tr>
                    <td colspan="2" style="text-align: right; font-weight:bold;">Total Expenses and Loss</td>
                    <td></td>
                    <td style="text-align: right; font-weight:bold;">({{ $expsum }})</td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: right; font-weight:bold;">Net Income</td>
                    <td></td>
                    <td style="text-align: right; font-weight:bold;">{{ $revsum - $expsum }}</td>
                </tr>

                
            
            </tbody>
            
        </table>
        
    </body>
    </html>
    