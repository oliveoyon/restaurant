<script>
    toastr.options.preventDuplicates = true;
      $.ajaxSetup({
          headers:{
              'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
          }
      });

      $(function(){
          // ADD Manufacturer
$('#add-manufacturer-form').on('submit', function(e) {
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
                $('#manufacturer-table').DataTable().ajax.reload(null, false);
                $('#addmanufacturers').modal('hide');
                $('#addmanufacturers').find('form')[0].reset();
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

// GET ALL Manufacturers
var table = $('#manufacturer-table').DataTable({
    processing: true,
    info: true,
    ajax: "{{ route('admin.getManufacturersList') }}",
    "pageLength": 5,
    "aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'manufacturer_name', name: 'manufacturer_name' },
        { data: 'status', name: 'status', orderable: false, searchable: false },
        { data: 'actions', name: 'actions', orderable: false, searchable: false },
    ]
});

// EDIT Manufacturer
$(document).on('click', '#editManufacturerBtn', function() {
    var manufacturer_id = $(this).data('id');
    $('.editManufacturer').find('form')[0].reset();
    $('.editManufacturer').find('span.error-text').text('');
    $.post("{{ route('admin.getManufacturerDetails') }}", { manufacturer_id: manufacturer_id }, function(data) {
        $('.editManufacturer').find('input[name="uid"]').val(data.details.id);
        $('.editManufacturer').find('input[name="manufacturer_name"]').val(data.details.manufacturer_name);
        $('.editManufacturer').find('select[name="manufacturer_status"]').val(data.details.manufacturer_status);
        $('.editManufacturer').modal('show');
    }, 'json');
});

// UPDATE Manufacturer
$('#update-manufacturer-form').on('submit', function(e) {
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
                $('#manufacturer-table').DataTable().ajax.reload(null, false);
                $('.editManufacturer').modal('hide');
                $('.editManufacturer').find('form')[0].reset();
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

// DELETE Manufacturer
$(document).on('click', '#deleteManufacturerBtn', function() {
    var manufacturer_id = $(this).data('id');
    var url = '<?= route("admin.deleteManufacturer"); ?>';

    Swal.fire({
        title: 'Are you sure?',
        html: 'You want to <b>delete</b> this Manufacturer',
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

            return $.post(url, { manufacturer_id: manufacturer_id }, function(data) {
                if (data.code == 1) {
                    $('#manufacturer-table').DataTable().ajax.reload(null, false);
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



      })
    </script>


