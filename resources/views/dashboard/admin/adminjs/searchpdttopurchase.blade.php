<script>
    toastr.options.preventDuplicates = true;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(function() {
        //ADD NEW District
        $(document).on("change", '#product_id', function(e) {
            // $(document).on('change', function(e){
            e.preventDefault();
            let search_string = $('#product_id').val();
            // console.log(search_string);
            $.ajax({
                url: "{{ route('admin.searchResultForPurchase') }}",
                method: 'POST',
                data: {
                    search_string: search_string
                },
                success: function(res) {
                    // $('.product_name').html(res);
                    // $("#manager_selected").find('option').remove().end().append(data.manager);
                    $('.addpdtform').find('input[name="stock"]').val(res.stock);
                    $('.addpdtform').find('input[name="unit"]').val(res.unit);
                }
            })
        })

        $('#add-product-form').on('submit', function(e) {
            e.preventDefault();
            var form = this;
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $(form).find('span.error-text').text('');
                },
                success: function(data) {
                    if (data.code == 0) {
                        $.each(data.error, function(prefix, val) {
                            $(form).find('span.' + prefix + '_error').text(val[0]);
                        });
                    } else {


                        $('.addpdtform').each(function() {
                            // this.reset();
                            $('input[name=quantity').val('');
                            $('select[name=shelf_id').val('');
                            $('input[name=barcode').val('');
                            $('input[name=stock').val('');
                            $('input[name=unit').val('');
                            $('input[name=serial_no').val('');
                            $('input[name=size').val('');
                            $('input[name=color').val('');
                            $('input[name=buy_price').val('');
                            $('input[name=sell_price').val('');
                            $('input[name=quantity').val('');
                            // $('input[name=purchase_date').val('');
                            $('input[name=expired_date').val('');
                            $('select[name=taxes').val(0);
                            $('input[name=total_tax').val('');
                            $('input[name=sub_total').val('');
                            $('input[name=net_cost').val('');
                            $('input[name=tax_value_percent').val('');
                            // $('select[name=supplier_id').select2({disabled:'readonly'});
                        });
                        $('#product_id').val(null).trigger("change");

                        $('#table-responsive').html(data.html);
                        $('#table-responsive1').html(data.html1);
                    }
                }
            });
        });


        //DELETE Version RECORD
        $(document).on('click', '#deletePdtBtn', function () {
    alert('test'); // Just to verify click works

    var cartId = $(this).data('id');
    var url = '<?= route('admin.deletePdtCart') ?>';

    if (confirm('Are you sure you want to delete this item?')) {
        $.post(url, { cartId: cartId }, function (data) {
            console.log(data); // For debugging in console
            if (data.code == 1) {
                $('#table-responsive').html(data.html);
                $('#table-responsive1').html(data.html1);
                toastr.success(data.msg);
            } else {
                toastr.error(data.msg);
            }
        }, 'json').fail(function (xhr) {
            console.error("Error:", xhr.responseText);
        });
    }
});




        $('#purchase-product-form').on('submit', function(e) {
            e.preventDefault();
            var form = this;
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $(form).find('span.error-text').text('');
                },
                success: function(data) {
                    if (data.code == 0) {
                        $.each(data.error, function(prefix, val) {
                            $(form).find('span.' + prefix + '_error').text(val[0]);
                        });
                    } else {
                        toastr.success(data.msg);
                        location.href = "{{ URL::to('admin/product-purchase/') }}";
                    }
                }
            });
        });

    })
</script>

<script>
    $('body').on('focus', ".datepicker", function() {
        $(this).datepicker();
    });

    $('#taxes').change(function() {
        let percent = parseFloat($(this).find(':selected').data('id')) || 0;
        let buy_price = parseFloat($('#buy_price').val()) || 0;
        let quantity = parseFloat($('#quantity').val()) || 0;

        let totalval = buy_price * quantity;
        let percentval = (percent / 100) * totalval;
        let totalcost = totalval + percentval;

        $('#tax_value_percent').val(percent.toFixed(2));
        $('#sub_total').val(totalval.toFixed(2));
        $('#total_tax').val(percentval.toFixed(2));
        $('#net_cost').val(totalcost.toFixed(2));
    });

    $("#buy_price").keyup(function() {
        let percent = parseFloat($("#taxes").find(':selected').data('id')) || 0;
        let buy_price = parseFloat($('#buy_price').val()) || 0;
        let quantity = parseFloat($('#quantity').val()) || 0;

        let totalval = buy_price * quantity;
        let percentval = (percent / 100) * totalval;
        let totalcost = totalval + percentval;

        $('#sub_total').val(totalval.toFixed(2));
        $('#total_tax').val(percentval.toFixed(2));
        $('#net_cost').val(totalcost.toFixed(2));
    });

    $("#quantity").keyup(function() {
        let percent = parseFloat($("#taxes").find(':selected').data('id')) || 0;
        let buy_price = parseFloat($('#buy_price').val()) || 0;
        let quantity = parseFloat($('#quantity').val()) || 0;

        let totalval = buy_price * quantity;
        let percentval = (percent / 100) * totalval;
        let totalcost = totalval + percentval;

        $('#sub_total').val(totalval.toFixed(2));
        $('#total_tax').val(percentval.toFixed(2));
        $('#net_cost').val(totalcost.toFixed(2));
    });

    
</script>
