


toastr.options.preventDuplicates = true;
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(function () {
    //ADD NEW District


    $('#add-district-form').on('submit', function (e) {
        e.preventDefault();
        var form = this;
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
                    $(form)[0].reset();
                    //  alert(data.msg);
                    $('#district-table').DataTable().ajax.reload(null, false);
                    toastr.success(data.msg);
                }
            }
        });
    });

    //GET ALL Districts
    var table = $('#district-table').DataTable({
        processing: true,
        info: true,
        ajax: "{{ route('admin.getDistrictsList') }}",
        "pageLength": 5,
        "aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
        columns: [
            //  {data:'id', name:'id'},
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'district_name_bn', name: 'district_name_bn' },
            { data: 'district_name_en', name: 'district_name_en' },
            { data: 'status', name: 'status', orderable: false, searchable: false },
            { data: 'actions', name: 'actions', orderable: false, searchable: false },
        ]
    });

    $(document).on('click', '#editDistrictBtn', function () {
        var district_id = $(this).data('id');
        $('.editDistrict').find('form')[0].reset();
        $('.editDistrict').find('span.error-text').text('');
        $.post("{{ route('admin.getDistrictDetails') }}", { district_id: district_id }, function (data) {
            //  alert(data.details.country_name);
            $('.editDistrict').find('input[name="did"]').val(data.details.id);
            $('.editDistrict').find('input[name="district_name_bn"]').val(data.details.district_name_bn);
            $('.editDistrict').find('input[name="district_name_en"]').val(data.details.district_name_en);
            $('.editDistrict').find('select[name="district_status"]').val(data.details.district_status);
            $('.editDistrict').modal('show');
        }, 'json');
    });

    //UPDATE District DETAILS
    $('#update-district-form').on('submit', function (e) {
        e.preventDefault();
        var form = this;
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
                    $('#district-table').DataTable().ajax.reload(null, false);
                    $('.editDistrict').modal('hide');
                    $('.editDistrict').find('form')[0].reset();
                    toastr.success(data.msg);
                }
            }
        });
    });

    //DELETE District RECORD
    $(document).on('click', '#deleteDistrictBtn', function () {
        var district_id = $(this).data('id');
        var url = '<?= route("admin.deleteDistrict"); ?>';
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this district',
            showCancelButton: true,
            showCloseButton: true,
            cancelButtonText: 'Cancel',
            confirmButtonText: 'Yes, Delete',
            cancelButtonColor: '#d33',
            confirmButtonColor: '#556ee6',
            width: 300,
            allowOutsideClick: false
        }).then(function (result) {
            if (result.value) {
                $.post(url, { district_id: district_id }, function (data) {
                    if (data.code == 1) {
                        $('#district-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.msg);
                    } else {
                        toastr.error(data.msg);
                    }
                }, 'json');
            }
        });
    });


    //Add Court

    $('#add-court-form').on('submit', function (e) {
        e.preventDefault();
        var form = this;
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
                    $(form)[0].reset();
                    //  alert(data.msg);
                    $('#court-table').DataTable().ajax.reload(null, false);
                    toastr.success(data.msg);
                }
            }
        });
    });

    //GET ALL Courts
    var table = $('#court-table').DataTable({
        processing: true,
        info: true,
        ajax: "{{ route('admin.getCourtsList') }}",
        "pageLength": 5,
        "aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
        columns: [
            //  {data:'id', name:'id'},
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'district_id', name: 'district_id', orderable: false, searchable: false },
            { data: 'court_name_bn', name: 'court_name_bn' },
            { data: 'court_name_en', name: 'court_name_en' },
            { data: 'status', name: 'status', orderable: false, searchable: false },
            { data: 'actions', name: 'actions', orderable: false, searchable: false },
        ]
    });

    $(document).on('click', '#editCourtBtn', function () {
        var court_id = $(this).data('id');
        $('.editCourt').find('form')[0].reset();
        $('.editCourt').find('span.error-text').text('');
        $.post("{{ route('admin.getCourtDetails') }}", { court_id: court_id }, function (data) {
            //  alert(data.details.country_name);
            $('.editCourt').find('input[name="cid"]').val(data.details.id);
            //$('.editCourt select').val(data.details.district_id).change();
            $('.editCourt').find('select[name="district_id"]').val(data.details.district_id);
            $('.editCourt').find('input[name="court_name_bn"]').val(data.details.court_name_bn);
            $('.editCourt').find('input[name="court_name_en"]').val(data.details.court_name_en);
            $('.editCourt').find('select[name="court_status"]').val(data.details.court_status);
            $('.editCourt').modal('show');
        }, 'json');
    });


    //UPDATE Court DETAILS
    $('#update-court-form').on('submit', function (e) {
        e.preventDefault();
        var form = this;
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
                    $('#court-table').DataTable().ajax.reload(null, false);
                    $('.editCourt').modal('hide');
                    $('.editCourt').find('form')[0].reset();
                    toastr.success(data.msg);
                }
            }
        });
    });

    //DELETE Courts RECORD
    $(document).on('click', '#deleteCourtBtn', function () {
        var court_id = $(this).data('id');
        var url = '<?= route("admin.deleteCourt"); ?>';
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this court',
            showCancelButton: true,
            showCloseButton: true,
            cancelButtonText: 'Cancel',
            confirmButtonText: 'Yes, Delete',
            cancelButtonColor: '#d33',
            confirmButtonColor: '#556ee6',
            width: 300,
            allowOutsideClick: false
        }).then(function (result) {
            if (result.value) {
                $.post(url, { court_id: court_id }, function (data) {
                    if (data.code == 1) {
                        $('#court-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.msg);
                    } else {
                        toastr.error(data.msg);
                    }
                }, 'json');
            }
        });
    });

})