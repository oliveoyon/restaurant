<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Barcode Printing Example</title>
  <style>
    .barcode-container {
      text-align: center;
      margin-bottom: 20px;
    }
    .barcode {
      display: inline-block;
      width: 16%;
      margin-right: 2%;
      margin-bottom: 20px;
    }
    .product-name {
      font-size: 12px;
      text-align: center;
    }
    .clear {
      clear: both;
    }
    @media screen and (max-width: 767px) {
      .barcode {
        width: 31%;
        margin-right: 2%;
      }
    }
    @media print {
      .barcode-container {
        display: block;
      }
      .barcode {
        display: inline-block;
        width: 16%;
        margin-right: 15%;
        margin-bottom: 20px;
        text-align: center;
      }
      .clear {
        clear: both;
      }
    }
  </style>
</head>
<body>
  

  <div class="barcode-container">
    
    @for($i = 1; $i <= $quantity; $i++)
			<div class="barcode">
        <?php echo '<img width="150" src="data:image/png;base64,' . DNS1D::getBarcodePNG($barcode, $type) . '" alt="barcode"   />';?>
				<div class="product-name">*{{ $barcode }}*</div>
			</div>
		@endfor
    <div class="clear"></div>
  </div>

</body>
</html>



