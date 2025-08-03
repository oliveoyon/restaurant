<script>
    toastr.options.preventDuplicates = true;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(function() {
        // ADD Unit
        $('#add-unit-form').on('submit', function(e) {
            e.preventDefault();
            var form = this;

            // Disable the submit button to prevent double-clicking
            $(form).find(':submit').prop('disabled', true);

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
                        $('#unit-table').DataTable().ajax.reload(null, false);
                        $('#addunits').modal('hide');
                        $('#addunits').find('form')[0].reset();
                        toastr.success(data.msg);
                    }
                },
                complete: function() {
                    // Enable the submit button and hide the loader overlay
                    $(form).find(':submit').prop('disabled', false);
                    $('#loader-overlay').hide();
                }
            });
        });

        // GET ALL Units
        var table = $('#unit-table').DataTable({
            processing: true,
            info: true,
            ajax: "{{ route('admin.getUnitsList') }}",
            "pageLength": 5,
            "aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'unit_name', name: 'unit_name' },
                { data: 'status', name: 'status', orderable: false, searchable: false },
                { data: 'actions', name: 'actions', orderable: false, searchable: false },
            ]
        });

        // EDIT Unit
        $(document).on('click', '#editUnitBtn', function() {
            var unit_id = $(this).data('id');
            $('.editUnit').find('form')[0].reset();
            $('.editUnit').find('span.error-text').text('');
            $.post("{{ route('admin.getUnitDetails') }}", { unit_id: unit_id }, function(data) {
                $('.editUnit').find('input[name="uid"]').val(data.details.id);
                $('.editUnit').find('input[name="unit_name"]').val(data.details.unit_name);
                $('.editUnit').find('select[name="unit_status"]').val(data.details.unit_status);
                $('.editUnit').modal('show');
            }, 'json');
        });

        // UPDATE Unit
        $('#update-unit-form').on('submit', function(e) {
            e.preventDefault();
            var form = this;

            // Disable the submit button to prevent double-clicking
            $(form).find(':submit').prop('disabled', true);

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
                        $('#unit-table').DataTable().ajax.reload(null, false);
                        $('.editUnit').modal('hide');
                        $('.editUnit').find('form')[0].reset();
                        toastr.success(data.msg);
                    }
                },
                complete: function() {
                    // Enable the submit button and hide the loader overlay
                    $(form).find(':submit').prop('disabled', false);
                    $('#loader-overlay').hide();
                }
            });
        });

        // DELETE Unit
        $(document).on('click', '#deleteUnitBtn', function() {
            var unit_id = $(this).data('id');
            var url = '<?= route("admin.deleteUnit"); ?>';

            Swal.fire({
                title: 'Are you sure?',
                html: 'You want to <b>delete</b> this Unit',
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

                    return $.post(url, { unit_id: unit_id }, function(data) {
                        if (data.code == 1) {
                            $('#unit-table').DataTable().ajax.reload(null, false);
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
