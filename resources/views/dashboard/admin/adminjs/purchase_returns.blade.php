<script>
    toastr.options.preventDuplicates = true;
      $.ajaxSetup({
          headers:{
              'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
          }
      });
    
      $(function(){
          //ADD NEW District
        $(document).on("change", '#product_id', function (e) { 
        // $(document).on('change', function(e){
            e.preventDefault();
            let product_id = $('#product_id').val();
            // console.log(search_string);
            $.ajax({
                url:"{{ route('admin.searchProductsDetails') }}",
                method:'POST',
                data:{product_id:product_id},
                success:function(res){
                    $('.addpdtform').find('input[name="stock"]').val(res.data.quantity);
                    $('.addpdtform').find('input[name="unit"]').val(res.unit);
                    $('.addpdtform').find('input[name="barcode"]').val(res.data.barcode);
                    $('.addpdtform').find('input[name="batch_no"]').val(res.data.batch_no);
                    $('.addpdtform').find('input[name="size"]').val(res.data.size);
                    $('.addpdtform').find('input[name="color"]').val(res.data.color);
                    $('.addpdtform').find('input[name="quantity"]').val(res.data.quantity);
                    $('.addpdtform').find('input[name="buy_price"]').val(res.data.buy_price_with_tax);
                    $('.addpdtform').find('input[name="purchase_date"]').val(res.data.purchase_date);
                    $('.addpdtform').find('input[name="expired_date"]').val(res.data.expired_date);
                    $('.addpdtform').find('input[name="net_cost"]').val(res.grandtotal);
                    $('.addpdtform').find('select[name="product_type"]').val(res.data.product_type).change();
                    $('.addpdtform').find('input[name="pdtstock_id"]').val(res.data.id);
                    $('.addpdtform').find('input[name="pid"]').val(res.data.product_id);
                    $('.addpdtform').find('input[name="pi_invoice"]').val(res.data.invoice_no);
                }
            });

            
        })

        $(document).on("change", '#supplier_selected', function (e) { 
            e.preventDefault();
            let supplier_id = $('#supplier_selected').val();
            $.ajax({
                url:"{{ route('admin.searchProducts') }}",
                method:'POST',
                data:{supplier_id:supplier_id},
                success:function(res){
                    $("#product_id").find('option').remove().end().append(res.products);
                    // $('.addpdtform').find('input[name="stock"]').val(res.stock);
                    // $('.addpdtform').find('input[name="unit"]').val(res.unit);
                }
            })
        })


        $('#add-purchasereturn-form').on('submit', function(e){
                e.preventDefault();
                var form = this;
                $.ajax({
                    url:$(form).attr('action'),
                    method:$(form).attr('method'),
                    data:new FormData(form),
                    processData:false,
                    dataType:'json',
                    contentType:false,
                    beforeSend:function(){
                            $(form).find('span.error-text').text('');
                    },
                    success:function(data){
                            if(data.code == 0){
                                $.each(data.error, function(prefix, val){
                                    $(form).find('span.'+prefix+'_error').text(val[0]);
                                });
                            }else{
                                

                                $( '.addpdtform' ).each(function(){
                                    // this.reset();
                                    $('input[name=quantity').val('');
                                    $('input[name=barcode').val('');
                                    $('input[name=stock').val('');
                                    $('input[name=unit').val('');
                                    $('input[name=serial_no').val('');
                                    $('input[name=size').val('');
                                    $('input[name=color').val('');
                                    $('input[name=buy_price').val('');
                                    $('input[name=sell_price').val('');
                                    $('input[name=quantity').val('');
                                    $('input[name=purchase_date').val('');
                                    $('input[name=expired_date').val('');
                                    $('input[name=net_cost').val('');
                                });
                                $('#product_id').val(null).trigger("change");
                                
                                $('#table-responsive').html(data.html);
                                $('#table-responsive1').html(data.html1);
                               

                                
                            }
                    }
                });
            });


            //DELETE Version RECORD
            $(document).on('click','#deletePdtBtn', function(){
                        var cartId = $(this).data('id');
                        var url = '<?= route("admin.deletePrCart"); ?>';
                        swal.fire({
                             title:'Are you sure?',
                             html:'You want to <b>delete</b> this Brand',
                             showCancelButton:true,
                             showCloseButton:true,
                             cancelButtonText:'Cancel',
                             confirmButtonText:'Yes, Delete',
                             cancelButtonColor:'#d33',
                             confirmButtonColor:'#556ee6',
                             width:300,
                             allowOutsideClick:false
                        }).then(function(result){
                              if(result.value){
                                  $.post(url,{cartId:cartId}, function(data){
                                       if(data.code == 1){
                                        $('#table-responsive').html(data.html);
                                        $('#table-responsive1').html(data.html1);
                                           toastr.success(data.msg);
                                       }else{
                                           toastr.error(data.msg);
                                       }
                                  },'json');
                              }
                        });
                    });



            $('#purchase-product-form').on('submit', function(e){
                e.preventDefault();
                var form = this;
                $.ajax({
                    url:$(form).attr('action'),
                    method:$(form).attr('method'),
                    data:new FormData(form),
                    processData:false,
                    dataType:'json',
                    contentType:false,
                    beforeSend:function(){
                            $(form).find('span.error-text').text('');
                    },
                    success:function(data){
                            if(data.code == 0){
                                $.each(data.error, function(prefix, val){
                                    $(form).find('span.'+prefix+'_error').text(val[0]);
                                });
                            }else{
                                toastr.success(data.msg);
                                location.href = "{{URL::to('admin/purchase-return/')}}";

                            }
                    }
                });
            });
    
      })
    </script>

<script>
    $('body').on('focus',".datepicker", function(){
        $(this).datepicker();
    });




</script>


    
    
    