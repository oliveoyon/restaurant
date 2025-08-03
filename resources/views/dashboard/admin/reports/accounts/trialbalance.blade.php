

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
        <p style="font-size:18px; font-weight: bold; mts-5;">Trial Balance</p>
        <p class="mts-5" style="font-size: 12px; font-style: italic;">Report printed as on <span style="font-weight:bold"><?php echo date("F j, Y"); ?></span></p>
    </div>
    
    <br>
   
    <br>
    <table class="items" width="100%" style="font-size: 14px; border-collapse: collapse;" cellpadding="8">
        <thead>
            <tr>
                <th>Sl</th>
                <th>Particular</th>
                <th>Dr.</th>
                <th>Cr.</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $drs = 0;
                $crs = 0;  
                $drsum = 0;  
                $crsum = 0;  
            ?>
            @foreach ($balancesheet as $bs)
            <?php 
                if($bs->account_type == 'Assets' OR $bs->account_type == 'Expenses')
                {
                    $drs = $drs + $bs->balance;
                }else{
                    $crs = $crs + $bs->balance;
                }
            ?>
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $bs->account_name }}</td>
                <td style='text-align:right;'><?php if($bs->account_type == 'Assets' OR $bs->account_type == 'Expenses'){echo $bs->balance;}else{echo '-';}?></td>
                <td style='text-align:right;'><?php if($bs->account_type == 'Liabilities' OR $bs->account_type == 'Equity' OR $bs->account_type == 'Revenue'){echo $bs->balance;}else{echo '-';}?></td>
            </tr>
            @endforeach
            <tr>
                <td colspan="2" style='font-weight:bold; text-align:right;'>Total</td>
                <td style='font-weight:bold; text-align:right;'>{{ $drs }}</td>
                <td style='font-weight:bold; text-align:right;'>{{ $crs }}</td>
            </tr>
        </tbody>
        
    </table>
    <br>
    
</body>
</html>
