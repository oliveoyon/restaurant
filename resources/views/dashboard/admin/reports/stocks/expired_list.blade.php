   
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
            <p style="font-size:18px; font-weight: bold; mts-5;">{{ $txt }}</p>
            <p class="mts-5" style="font-size: 12px; font-style: italic;">Report printed as on <span style="font-weight:bold"><?php echo date('F j, Y') ;?></span></p>
        </div>
        
        <br>
       
        <br>
        <table class="items" width="100%" style="font-size: 14px; border-collapse: collapse;" cellpadding="8">
            <thead>
                <tr>
                    <th>Sl</th>
                    <th>Product Name</th>
                    <th>Supplier</th>
                    <th>Manufacturer</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>Barcode</th>
                    <th>Serial</th>
                    <th>Batch</th>
                    <th>Size</th>
                    <th>Color</th>
                    <th>Expired Date</th>
                    <th>Qty</th>
                </tr>
            </thead>
            <tbody>
                <!-- ITEMS HERE -->
               
                @forelse ($products as $pdt)

                <?php
                    $date = new DateTimeImmutable($pdt->expired_date);
                    $date1 = $date->format('F j, Y');
                ?>
               
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pdt->product_title }}</td>
                    <td>{{ $pdt->supplier_name }}</td>
                    <td>{{ $pdt->manufacturer_name }}</td>
                    <td>{{ $pdt->category_name }}</td>
                    <td>{{ $pdt->brand_name }}</td>
                    <td>{{ $pdt->barcode }}</td>
                    <td>{{ $pdt->serial_no }}</td>
                    <td>{{ $pdt->batch_no }}</td>
                    <td>{{ $pdt->size }}</td>
                    <td>{{ $pdt->color }}</td>
                    <td>{{ $date1 }}</td>  
                    <td>{{ $pdt->quantity }}</td>
                </tr>
                
                @empty
                    <tr>
                        <td colspan="12" style="text-align: center">Data not found</td>
                    </tr>
                @endforelse
                
               
              
            
            </tbody>
            
        </table>
        <br>
        
    </body>
    </html>
    