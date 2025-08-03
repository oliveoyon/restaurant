<script>
    toastr.options.preventDuplicates = true;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(function() {
        // ADD Category
        $('#add-category-form').on('submit', function(e) {
            e.preventDefault();
            var form = this;

            // Disable the submit button to prevent double-clicking
            $(form).find('button[type="submit"]').prop('disabled', true);

            // Show the loader overlay
            $('#loader-overlay').show();

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
                        $(form)[0].reset();
                        $('#category-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.msg);
                        $('.img-holder').empty();
                    }
                },
                complete: function() {
                    // Enable the submit button and hide the loader overlay
                    $(form).find('button[type="submit"]').prop('disabled', false);
                    $('#loader-overlay').hide();
                }
            });
        });

        // Reset input file
        $('input[type="file"][name="category_img"]').val('');

        // Image preview
        $('input[type="file"][name="category_img"]').on('change', function() {
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
                            'style': 'max-width:100px;margin-bottom:10px;'
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

        // Initialize the DataTable for categories
        var table = $('#category-table').DataTable({
            processing: true,
            info: true,
            ajax: "{{ route('admin.getCategoriesList') }}",
            "pageLength": 5,
            "aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'category_name', name: 'category_name' },
                { data: 'img', name: 'img' },
                { data: 'status', name: 'status', orderable: false, searchable: false },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ]
        });

        // EDIT Category
        $(document).on('click', '#editCategoryBtn', function() {
            var category_id = $(this).data('id');
            $('.editCategory').find('form')[0].reset();
            $('.editCategory').find('span.error-text').text('');
            $.post("{{ route('admin.getCategoryDetails') }}", { category_id: category_id }, function(data) {
                var categoryModal = $('.editCategory');
                categoryModal.find('input[name="cid"]').val(data.details.id);
                categoryModal.find('input[name="category_name"]').val(data.details.category_name);
                categoryModal.find('select[name="category_status"]').val(data.details.category_status);
                categoryModal.find('.img-holder-update').html('<img src="/storage/images/categories/' + data.details.category_img + '" class="img-fluid" style="max-width:100px;margin-bottom:10px;">');
                categoryModal.find('input[name="category_img_update"]').attr('data-value', '<img src="/storage/images/categories/' + data.details.category_img + '" class="img-fluid" style="max-width:100px;margin-bottom:10px;">');
                categoryModal.find('input[name="category_img_update"]').val('');
                categoryModal.modal('show');
            }, 'json');
        });

        // Image preview for updating category
        $('input[type="file"][name="category_img_update"]').on('change', function() {
            var img_path = $(this)[0].value;
            var img_holder = $('.img-holder-update');
            var currentImagePath = $(this).data('value');
            var extension = img_path.substring(img_path.lastIndexOf('.') + 1).toLowerCase();
            if (extension == 'jpeg' || extension == 'jpg' || extension == 'png') {
                if (typeof(FileReader) != 'undefined') {
                    img_holder.empty();
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('<img/>', {
                            'src': e.target.result,
                            'class': 'img-fluid',
                            'style': 'max-width:100px;margin-bottom:10px;'
                        }).appendTo(img_holder);
                    }
                    img_holder.show();
                    reader.readAsDataURL($(this)[0].files[0]);
                } else {
                    img_holder.html('This browser does not support FileReader');
                }
            } else {
                img_holder.html(currentImagePath);
            }
        });

        // Clear input file and reset image preview
        $(document).on('click', '#clearInputFile', function() {
            var form = $(this).closest('form');
            form.find('input[type="file"]').val('');
            form.find('.img-holder-update').html(form.find('input[type="file"]').data('value'));
        });

        // UPDATE Category
        $('#update-category-form').on('submit', function(e) {
            e.preventDefault();
            var form = this;

            // Disable the submit button to prevent double-clicking
            $(form).find('button[type="submit"]').prop('disabled', true);

            // Show the loader overlay
            $('#loader-overlay').show();

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
                        $('#category-table').DataTable().ajax.reload(null, false);
                        $('.editCategory').modal('hide');
                        $('.editCategory').find('form')[0].reset();
                        toastr.success(data.msg);
                    }
                },
                complete: function() {
                    // Enable the submit button and hide the loader overlay
                    $(form).find('button[type="submit"]').prop('disabled', false);
                    $('#loader-overlay').hide();
                }
            });
        });

        // DELETE Category
        $(document).on('click', '#deleteCategoryBtn', function() {
            var category_id = $(this).data('id');
            var url = '<?= route('admin.deleteCategory') ?>';

            Swal.fire({
                title: 'Are you sure?',
                html: 'You want to <b>delete</b> this Category',
                icon: 'warning',
                showCancelButton: true,
                showCloseButton: true,
                cancelButtonText: 'Cancel',
                confirmButtonText: 'Yes, Delete',
                cancelButtonColor: '#d33',
                confirmButtonColor: '#556ee6',
                width: 300,
                allowOutsideClick: false,
                showLoaderOnConfirm: true,
                preConfirm: function() {
                    // Show the loader overlay
                    $('#loader-overlay').show();

                    return $.post(url, { category_id: category_id }, function(data) {
                        if (data.code == 1) {
                            $('#category-table').DataTable().ajax.reload(null, false);
                            toastr.success(data.msg);
                        } else {
                            toastr.error(data.msg);
                        }
                    }, 'json').always(function() {
                        // Hide the loader overlay after the operation is complete
                        $('#loader-overlay').hide();
                    });
                }
            });
        });
    });
</script>
