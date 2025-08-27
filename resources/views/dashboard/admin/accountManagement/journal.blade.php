@extends('dashboard.admin.layouts.admin-layout')
@section('title', 'Journal Transactions')
@push('admincss')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <link rel="stylesheet" href="/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="dist/css/custom.css">
@endpush

@section('content')
    <div class="content-wrapper">

        <style>
            .form-group {
                margin-bottom: 0.5rem;
            }
        </style>

        <div class="content">
            <div class="container-fluid">


                <div class="card card-success " id="cards">
                    <div class="card-header">
                        <h3 class="card-title">Journal Transactions</h3>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('admin.journalaction') }}" method="post" id="add-ob-form"
                            class="add-ob-form" autocomplete="off">
                            @csrf


                            <div class="row">
                                <div class="col-md-6">


                                    <div class="form-group row">
                                        <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Debit
                                            Account</label>
                                        <div class="col-sm-9">
                                            <select name="debit_account" class="form-control  form-control-sm select2bs4">
                                                <option value="">--Select a Category--</option>
                                                @foreach ($accheads as $acc)
                                                    <option value="{{ $acc->code }}">
                                                        {{ $acc->account_name . ' - ' . $acc->account_head }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger error-text acc_head_id_error"></span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Credit
                                            Account</label>
                                        <div class="col-sm-9">
                                            <select name="credit_account" class="form-control  form-control-sm select2bs4">
                                                <option value="">--Select a Category--</option>
                                                @foreach ($accheads as $acc)
                                                    <option value="{{ $acc->code }}">
                                                        {{ $acc->account_name . ' - ' . $acc->account_head }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger error-text acc_head_id_error"></span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="colFormLabelSm"
                                            class="col-sm-3 col-form-label col-form-label-sm">Amount</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="amount" class="form-control form-control-sm"
                                                value="">
                                            <span class="text-danger error-text amount_error"></span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="colFormLabelSm"
                                            class="col-sm-3 col-form-label col-form-label-sm">Date</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="trns_date"
                                                class="form-control form-control-sm datepicker" value="">
                                            <span class="text-danger error-text trns_date_error"></span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="colFormLabelSm"
                                            class="col-sm-3 col-form-label col-form-label-sm">Description</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="description" class="form-control form-control-sm"
                                                value="">
                                            <span class="text-danger error-text description_error"></span>
                                        </div>
                                    </div>


                                </div>

                            </div>



                            <!-- /.row -->
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for=""></label>
                                        <button type="submit" class="btn btn-block btn-info">Save</button>
                                    </div>

                                </div>
                            </div>
                        </form>

                    </div>
                    <!-- /.card-body -->

                </div>
                <!-- /.card -->



            </div><!-- /.container-fluid -->

        </div>
        <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->
    <!-- Modal -->

    <div class="modal fade modal-fullscreen modalsale" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="modalTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="printThis" class="printme">
                        <div id="abc"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <span class="hello"><input type="button" class="btn btn-success" value="Print"
                            onclick="printDiv()"></span>

                    <span class="addprint"></span>
                </div>
            </div>
        </div>
    </div>



@endsection

@push('adminjs')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        toastr.options.preventDuplicates = true;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function() {

            $('#add-ob-form').on('submit', function(e) {
                e.preventDefault();
                var form = this;
                var $submit = $(form).find(':submit');

                // Prevent double submission
                if ($submit.prop('disabled')) {
                    return; // exit if already submitting
                }
                $submit.prop('disabled', true);

                // Show loader overlay
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
                            $('.select2bs4').val(null).trigger("change");

                            $("#abc").html(data.html1);
                            $('#modalTitle').html(data.msg);
                            $('.modal').modal('show');
                        }
                    },
                    complete: function() {
                        // Re-enable submit button and hide loader
                        $submit.prop('disabled', false);
                        $('#loader-overlay').hide();
                    }
                });
            });


        })
    </script>



    <script>
        function printDiv() {
            var contents = document.getElementById("printThis").innerHTML;
            var frame1 = document.createElement('iframe');
            frame1.name = "frame1";
            frame1.style.position = "absolute";
            frame1.style.top = "-1000000px";
            document.body.appendChild(frame1);
            var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1
                .contentDocument.document : frame1.contentDocument;
            frameDoc.document.open();
            frameDoc.document.write(contents);
            frameDoc.document.close();
            setTimeout(function() {
                window.frames["frame1"].focus();
                window.frames["frame1"].print();
                document.body.removeChild(frame1);
            }, 500);
            return false;
        }
    </script>

    <script>
        $('body').on('focus', ".datepicker", function() {
            $(this).datepicker();
        });

        $('.datepicker').datepicker().on('changeDate', function() {
            $(this).datepicker('hide');
        });
    </script>
@endpush
