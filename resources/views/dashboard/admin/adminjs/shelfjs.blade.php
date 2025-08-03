<script>
    toastr.options.preventDuplicates = true;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(function () {
        // Show loader
        function showLoader() {
            $('#loader-overlay').show();
        }

        // Hide loader
        function hideLoader() {
            $('#loader-overlay').hide();
        }

        // ADD NEW Shelf
        $('#add-shelf-form').on('submit', function (e) {
            e.preventDefault();
            var form = this;

            // Disable submit button to prevent double-clicks
            $(form).find('button[type="submit"]').prop('disabled', true);
            showLoader();

            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function () {
                    $(form).find('span.error-text').text('');
                },
                success: function (data) {
                    if (data.code == 0) {
                        $.each(data.error, function (prefix, val) {
                            $(form).find('span.' + prefix + '_error').text(val[0]);
                        });
                    } else {
                        $('#shelf-table').DataTable().ajax.reload(null, false);
                        $('#addshelf').modal('hide');
                        $('#addshelf').find('form')[0].reset();
                        toastr.success(data.msg);
                    }
                },
                complete: function () {
                    // Re-enable submit button and hide loader
                    $(form).find('button[type="submit"]').prop('disabled', false);
                    hideLoader();
                }
            });
        });

        // GET ALL Shelves
        var table = $('#shelf-table').DataTable({
            processing: true,
            info: true,
            ajax: "{{ route('admin.getShelfsList') }}",
            "pageLength": 5,
            "aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'shelf_name', name: 'shelf_name' },
                { data: 'status', name: 'status', orderable: false, searchable: false },
                { data: 'actions', name: 'actions', orderable: false, searchable: false },
            ]
        });

        // EDIT Shelf
        $(document).on('click', '#editShelfBtn', function () {
            var shelf_id = $(this).data('id');
            $('.editShelf').find('form')[0].reset();
            $('.editShelf').find('span.error-text').text('');
            $.post("{{ route('admin.getShelfDetails') }}", { shelf_id: shelf_id }, function (data) {
                $('.editShelf').find('input[name="sid"]').val(data.details.id);
                $('.editShelf').find('input[name="shelf_name"]').val(data.details.shelf_name);
                $('.editShelf').find('select[name="shelf_status"]').val(data.details.shelf_status);
                $('.editShelf').modal('show');
            }, 'json');
        });

        // UPDATE Shelf DETAILS
        $('#update-shelf-form').on('submit', function (e) {
            e.preventDefault();
            var form = this;

            // Disable submit button to prevent double-clicks
            $(form).find('button[type="submit"]').prop('disabled', true);
            showLoader();

            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function () {
                    $(form).find('span.error-text').text('');
                },
                success: function (data) {
                    if (data.code == 0) {
                        $.each(data.error, function (prefix, val) {
                            $(form).find('span.' + prefix + '_error').text(val[0]);
                        });
                    } else {
                        $('#shelf-table').DataTable().ajax.reload(null, false);
                        $('.editShelf').modal('hide');
                        $('.editShelf').find('form')[0].reset();
                        toastr.success(data.msg);
                    }
                },
                complete: function () {
                    // Re-enable submit button and hide loader
                    $(form).find('button[type="submit"]').prop('disabled', false);
                    hideLoader();
                }
            });
        });

        // DELETE Shelf RECORD
        $(document).on('click', '#deleteShelfBtn', function () {
            var shelf_id = $(this).data('id');
            var url = '<?= route("admin.deleteShelf"); ?>';

            Swal.fire({
                title: 'Are you sure?',
                html: 'You want to <b>delete</b> this Shelf',
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
                preConfirm: function () {
                    showLoader();
                    return $.post(url, { shelf_id: shelf_id }, function (data) {
                        if (data.code == 1) {
                            $('#shelf-table').DataTable().ajax.reload(null, false);
                            toastr.success(data.msg);
                        } else {
                            toastr.error(data.msg);
                        }
                    }, 'json').always(function () {
                        hideLoader();
                    });
                }
            });
        });

    });
</script>
