<script>
    toastr.options.preventDuplicates = true;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(function() {
        // Function to show loader
        function showLoader() {
            console.log('Showing loader...'); // Debugging
            $('#loader').show();
        }

        // Function to hide loader
        function hideLoader() {
            console.log('Hiding loader...'); // Debugging
            $('#loader').hide();
        }

        // Add New Brand
        $('#add-brand-form').on('submit', function(e) {
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
                    console.log('Add Brand AJAX request started, showing loader'); // Debugging
                    $(form).find('span.error-text').text('');
                    showLoader(); // Show loader before sending AJAX request
                },
                success: function(data) {
                    if (data.code == 0) {
                        $.each(data.error, function(prefix, val) {
                            $(form).find('span.' + prefix + '_error').text(val[0]);
                        });
                    } else {
                        $('#brand-table').DataTable().ajax.reload(null, false);
                        $('#addbrands').modal('hide');
                        $('#addbrands').find('form')[0].reset();
                        toastr.success(data.msg);
                    }
                },
                complete: function() {
                    console.log('Add Brand AJAX request completed, hiding loader'); // Debugging
                    hideLoader(); // Hide loader when AJAX request is complete
                }
            });
        });

        // Get All Brands
        var table = $('#brand-table').DataTable({
            processing: true,
            info: true,
            ajax: "{{ route('admin.getBrandsList') }}",
            "pageLength": 15,
            "aLengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'brand_name', name: 'brand_name' },
                // { data: 'brand_address', name: 'brand_address' },
                // { data: 'brand_phone', name: 'brand_phone' },
                // { data: 'brand_email', name: 'brand_email' },
                { data: 'status', name: 'status', orderable: false, searchable: false },
                { data: 'actions', name: 'actions', orderable: false, searchable: false },
            ]
        });

        // Edit Brand
        $(document).on('click', '#editBrandBtn', function() {
            var brand_id = $(this).data('id');
            $('.editBrand').find('form')[0].reset();
            $('.editBrand').find('span.error-text').text('');
            $.ajax({
                url: "{{ route('admin.getBrandDetails') }}",
                method: "POST",
                data: { brand_id: brand_id },
                dataType: 'json',
                beforeSend: function() {
                    console.log('Edit Brand AJAX request started, showing loader'); // Debugging
                    showLoader(); // Show loader
                },
                success: function(data) {
                    $('.editBrand').find('input[name="sid"]').val(data.details.id);
                    $('.editBrand').find('input[name="brand_name"]').val(data.details.brand_name);
                    // $('.editBrand').find('input[name="brand_address"]').val(data.details.brand_address);
                    // $('.editBrand').find('input[name="brand_phone"]').val(data.details.brand_phone);
                    // $('.editBrand').find('input[name="brand_email"]').val(data.details.brand_email);
                    $('.editBrand').find('select[name="brand_status"]').val(data.details.brand_status);
                    $('.editBrand').modal('show');
                },
                complete: function() {
                    console.log('Edit Brand AJAX request completed, hiding loader'); // Debugging
                    hideLoader(); // Hide loader when AJAX request is complete
                }
            });
        });

        // Update Brand Details
        $('#update-brand-form').on('submit', function(e) {
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
                    console.log('Update Brand AJAX request started, showing loader'); // Debugging
                    $(form).find('span.error-text').text('');
                    showLoader(); // Show loader before sending AJAX request
                },
                success: function(data) {
                    if (data.code == 0) {
                        $.each(data.error, function(prefix, val) {
                            $(form).find('span.' + prefix + '_error').text(val[0]);
                        });
                    } else {
                        $('#brand-table').DataTable().ajax.reload(null, false);
                        $('.editBrand').modal('hide');
                        $('.editBrand').find('form')[0].reset();
                        toastr.success(data.msg);
                    }
                },
                complete: function() {
                    console.log('Update Brand AJAX request completed, hiding loader'); // Debugging
                    hideLoader(); // Hide loader when AJAX request is complete
                }
            });
        });

        // Delete Brand
        $(document).on('click', '#deleteBrandBtn', function() {
            var brand_id = $(this).data('id');
            var url = '{{ route("admin.deleteBrand") }}';
            swal.fire({
                title: 'Are you sure?',
                html: 'You want to <b>delete</b> this Brand',
                showCancelButton: true,
                showCloseButton: true,
                cancelButtonText: 'Cancel',
                confirmButtonText: 'Yes, Delete',
                cancelButtonColor: '#d33',
                confirmButtonColor: '#556ee6',
                width: 300,
                allowOutsideClick: false
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: url,
                        method: 'POST',
                        data: { brand_id: brand_id },
                        dataType: 'json',
                        beforeSend: function() {
                            console.log('Delete Brand AJAX request started, showing loader'); // Debugging
                            showLoader(); // Show loader
                        },
                        success: function(data) {
                            if (data.code == 1) {
                                $('#brand-table').DataTable().ajax.reload(null, false);
                                toastr.success(data.msg);
                            } else {
                                toastr.error(data.msg);
                            }
                        },
                        complete: function() {
                            console.log('Delete Brand AJAX request completed, hiding loader'); // Debugging
                            hideLoader(); // Hide loader when AJAX request is complete
                        }
                    });
                }
            });
        });

    });
</script>
