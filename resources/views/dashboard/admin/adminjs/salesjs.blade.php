<script>
    toastr.options.preventDuplicates = true;
      $.ajaxSetup({
          headers:{
              'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
          }
      });

      
    
      $(function(){
          //ADD NEW District
      

        $(document).on("keyup", '#search', function (e) { 
            e.preventDefault();
            let search_string = $('#search').val();
            $.ajax({
                url:"{{ route('admin.searchProductsforSale') }}",
                method:'POST',
                data:{search_string:search_string},
                success:function(res){
                    // $("#product_id").find('option').remove().end().append(res.products);
                    $('.print').html(res.products);
                    // $('#browsers').html(res.products);
                    if(res.status == 'a'){
                        document.getElementById("dropdown-content").style.display = "none";
                        $( '.addpdtform' ).each(function(){
                                    // this.reset();
                                    $('input[name=quantity').val('');
                                    $('input[name=barcode').val('');
                                    $('input[name=batch_no').val('');
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
                    }else{
                        document.getElementById("dropdown-content").style.display = "block";
                    }
                    
                   
                    
                }
            })
        })

        // $(document).on("click", '.rows', function (e) { 
        //     e.preventDefault();
        //     var str = $(this).data('id');
        //     alert(str);
        // })

        // $("[list='browsers']").on("input propertychange", function() {
        //     alert('test');
        //     // window.location = $("#browsers option[value='"+$("[list='browsers']").val()+"']").find("a").attr("href")
        // });

       


        $(document).on("change", '#search', function (e) { 
        // $(document).on('change', function(e){
            e.preventDefault();
            var product_id = document.querySelector('#search').value;
            // console.log(search_string);
            $.ajax({
                url:"{{ route('admin.searchProductsDetails2') }}",
                method:'POST',
                data:{product_id:product_id},
                success:function(res){
                    $('.addpdtform').find('input[name="stock"]').val(res.data.quantity);
                    $('.addpdtform').find('input[name="unit"]').val(res.unit);
                    $('.addpdtform').find('input[name="barcode"]').val(res.data.barcode);
                    $('.addpdtform').find('input[name="batch_no"]').val(res.data.batch_no);
                    $('.addpdtform').find('input[name="serial_no"]').val(res.data.serial_no);
                    $('.addpdtform').find('input[name="size"]').val(res.data.size);
                    $('.addpdtform').find('input[name="color"]').val(res.data.color);
                    // $('.addpdtform').find('input[name="quantity"]').val(res.data.quantity);
                    $('.addpdtform').find('input[name="sell_price"]').val(res.data.sell_price);
                    $('.addpdtform').find('input[name="purchase_date"]').val(res.data.purchase_date);
                    $('.addpdtform').find('input[name="expired_date"]').val(res.data.expired_date);
                    $('.addpdtform').find('input[name="net_cost"]').val(document.getElementById("quantity").value * res.data.sell_price);
                    $('.addpdtform').find('select[name="product_type"]').val(res.data.product_type).change();
                    $('.addpdtform').find('input[name="pdtstock_id"]').val(res.data.id);
                    $('.addpdtform').find('input[name="pid"]').val(res.data.product_id);
                    $('.addpdtform').find('input[name="pi_invoice"]').val(res.data.invoice_no);
                    $('#search').val(res.pdtname);
                    document.getElementById("dropdown-content").style.display = "none";
                }
            });
        })

        $(document).on("change", '.accdetail', function (e) { 
        // alert(document.querySelector('.accdetail').value);
        var test = $(".accdetail option:selected" ).text();
        if(test == 'Bank Cheque'){
            $('input[name="paid"]').val('0');
            $('input[name="paid"]').prop('readonly', true);

            $('input[name="discount"]').val('0');
            $('input[name="discount"]').prop('readonly', true);
        }else{
            $('input[name="paid"]').prop('readonly', false);
            $('input[name="discount"]').prop('readonly', false);
        }
        });

        $('#add-customer-form').on('submit', function(e){
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
                            // $('#manufacturer-table').DataTable().ajax.reload(null, false);
                                $("#customer_selected").find('option').remove().end().append(data.unititem);
                                $('#addcustomers').modal('hide');
                                $('#addcustomers').find('form')[0].reset();
                                toastr.success(data.msg);
                            }
                    }
                });
            });


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
                                    $('input[name=batch_no').val('');
                                    $('input[name=stock').val('');
                                    $('input[name=unit').val('');
                                    $('input[name=serial_no').val('');
                                    $('input[name=size').val('');
                                    $('input[name=color').val('');
                                    $('input[name=search').val('');
                                    $('input[name=sell_price').val('');
                                    $('input[name=quantity').val(1);
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
                        var url = '<?= route("admin.deleteSlCart"); ?>';
                        swal.fire({
                             title:'Are you sure?',
                             html:'You want to <b>delete</b> this Product',
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
                                $('#table-responsive').remove();
                                $('#table-responsive1').remove();
                                $('#modalTitle').html(data.msg);
                                $("#abc").html(data.html1);
                                $('.inv').val(data.inv);
                                $('.modalsale').modal('show');
                                // location.href = "{{URL::to('admin/sales/')}}";
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


    $("#quantity").keyup(function() {
        var quantity = $('#quantity').val();
        var stock = $('#stock').val();
        if(quantity > stock){
            // e.preventDefault();
             $('#quantity').val(stock)
             toastr.error('Stock is not sufficient');
        }
    
    var sell_price = $('#buy_price').val();
    var totalval = Number(sell_price)*Number(quantity);
    $('#net_cost').val(totalval);
    });

    $("#search").keyup(function() {
        if( $('#search').val().length === 0 ) {
            $('input[name=quantity').val('');
                $('input[name=barcode').val('');
                $('input[name=batch_no').val('');
                $('input[name=stock').val('');
                $('input[name=unit').val('');
                $('input[name=serial_no').val('');
                $('input[name=size').val('');
                $('input[name=color').val('');
                $('input[name=search').val('');
                $('input[name=sell_price').val('');
                $('input[name=quantity').val(1);
                $('input[name=purchase_date').val('');
                $('input[name=expired_date').val('');
                $('input[name=net_cost').val('');
        }
        
    });


</script>

<script>



    
    function printDiv() {
            var contents = document.getElementById("printThis").innerHTML;
            var frame1 = document.createElement('iframe');
            frame1.name = "frame1";
            frame1.style.position = "absolute";
            frame1.style.top = "-1000000px";
            document.body.appendChild(frame1);
            var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument;
            frameDoc.document.open();
            frameDoc.document.write(contents);
            frameDoc.document.close();
            setTimeout(function () {
                window.frames["frame1"].focus();
                window.frames["frame1"].print();
                document.body.removeChild(frame1);
            }, 500);
            return false;
        }
        
</script>


    
    
    