<script>
    toastr.options.preventDuplicates = true;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(function() {
        var isSubmitting = false; // Flag to prevent double submission

        function handleFormSubmit(formSelector, loaderSelector, successCallback) {
            $(formSelector).on('submit', function(e) {
                e.preventDefault();
                if (isSubmitting) return; // Prevent double submit
                isSubmitting = true;

                var form = this;
                var loader = $(loaderSelector);

                loader.show(); // Show loader

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
                                $(form).find('span.' + prefix + '_error').text(val[
                                    0]);
                            });
                        } else {
                            successCallback(data);
                        }
                        loader.hide(); // Hide loader
                        isSubmitting = false; // Reset flag
                    },
                    error: function() {
                        loader.hide(); // Hide loader
                        isSubmitting = false; // Reset flag
                        toastr.error('An error occurred. Please try again.');
                    }
                });
            });
        }

        handleFormSubmit('#add-manufacturer-forms', '#manufacturer-loader', function(data) {
            $("#manufacturer_selected").find('option').remove().end().append(data.manufactureritem);
            $('#manufacturer').modal('hide');
            $('#manufacturer').find('form')[0].reset();
            toastr.success(data.msg);
        });

        handleFormSubmit('#add-category-forms', '#category-loader', function(data) {
            $("#category_selected").find('option').remove().end().append(data.categoryitem);
            $('#categories').modal('hide');
            $('#categories').find('form')[0].reset();
            toastr.success(data.msg);
        });

        handleFormSubmit('#add-brand-forms', '#brand-loader', function(data) {
            $("#brand_selected").find('option').remove().end().append(data.branditem);
            $('#brands').modal('hide');
            $('#brands').find('form')[0].reset();
            toastr.success(data.msg);
        });

        handleFormSubmit('#add-unit-forms', '#unit-loader', function(data) {
            $("#unit_selected").find('option').remove().end().append(data.unititem);
            $('#units').modal('hide');
            $('#units').find('form')[0].reset();
            toastr.success(data.msg);
        });

        handleFormSubmit('#add-shelf-forms', '#shelf-loader', function(data) {
            $("#shelf_selected").find('option').remove().end().append(data.shelfitem);
            $('#shelfs').modal('hide');
            $('#shelfs').find('form')[0].reset();
            toastr.success(data.msg);
        });

        handleFormSubmit('#add-product-form', '#product-loader', function(data) {
            if (data.code == 1) {
                toastr.success('Product added successfully');
                setTimeout(function() {
                    location.reload();
                }, 1000); // wait 1 second before refreshing
            }
        });


        handleFormSubmit('#add-productstock-forms', '#productstock-loader', function(data) {
            $('#add-productstock-forms')[0].reset();
            $('.select2bs4').val(null).trigger("change");
            toastr.success(data.msg);
            location.href = "{{ URL::to('admin/add-product/') }}";
        });

        // Reset input file and handle image preview
        $('input[type="file"]').on('change', function() {
            var img_path = $(this)[0].value;
            var img_holder = $('.img-holder');
            var extension = img_path.substring(img_path.lastIndexOf('.') + 1).toLowerCase();
            if (extension == 'jpeg' || extension == 'jpg' || extension == 'png') {
                if (typeof(FileReader) != 'undefined') {
                    img_holder.empty();
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('<img/>', {
                            'src': e.target.result,
                            'class': 'img-fluid',
                            'style': 'max-width:70px;margin-bottom:10px;'
                        }).appendTo(img_holder);
                    }
                    img_holder.show();
                    reader.readAsDataURL($(this)[0].files[0]);
                } else {
                    $(img_holder).html('This browser does not support FileReader');
                }
            } else {
                $(img_holder).empty();
            }
        });
    });
</script>


<script>
    function addRow() {
        const div = document.createElement('div');

        div.className = 'row border border-success mt-10';

        div.innerHTML = `
                    <div class="col-md-2">
                <div class="form-group">
                  <label for="">Serial No</label>
                  <input type="text" class="form-control" name="serial_no[]" placeholder="Enter Barcode">
                  <span class="text-danger error-text barcode_error"></span>
                </div>
              </div>

          <div class="col-md-2">
            <div class="form-group">
              <label for="">Bar Code</label>
              <input type="text" class="form-control" name="barcode[]" placeholder="Enter Barcode">
              <span class="text-danger error-text barcode_error"></span>
            </div>
          </div>




          <div class="col-md-2">
            <div class="form-group">
              <label for="">Size</label>
              <input type="text" class="form-control" name="size[]" placeholder="Enter Size">
              <span class="text-danger error-text size_error"></span>
            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
              <label for="">Color</label>
              <input type="text" class="form-control" name="color[]" placeholder="Enter Color">
              <span class="text-danger error-text color_error"></span>
            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
              <label for="">Buy Price <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="buy_price[]" value="0">
              <span class="text-danger error-text buy_price_error"></span>
            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
              <label for="">Sale Price <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="sell_price[]" value="0">
              <span class="text-danger error-text sell_price_error"></span>
            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
              <label for="">Quantity <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="quantity[]" value="0">
              <span class="text-danger error-text quantity[]_error"></span>
            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
              <label for="">Purchased Date <span class="text-danger">*</span></label>
              <input type="text" class="form-control datepicker" name="purchase_date[]">
              <span class="text-danger error-text purchase_date_error"></span>
            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
              <label for="">Expired Date <span class="text-danger">*</span></label>
              <input type="text" class="form-control datepicker" name="expired_date[]">
              <span class="text-danger error-text expired_date_error"></span>
            </div>
          </div>

                    <input class="btn btn-sm" type="button" value="Remove" onclick="removeRow(this)" />

                    `;

        document.getElementById('content').appendChild(div);
    }

    function removeRow(input) {
        document.getElementById('content').removeChild(input.parentNode);
    }
</script>

<script>
    var datePickerOptions = {
        format: 'yyyy/mm/dd'
    }


    $('body').on('focus', ".datepicker", function() {
        $(this).datepicker();
    });
</script>
