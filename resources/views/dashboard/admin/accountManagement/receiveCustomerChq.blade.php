@extends('dashboard.admin.layouts.admin-layout')
@section('title', 'Cheque Clearing')
@push('admincss')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="dist/css/custom.css">
@endpush

@section('content')
    <div class="content-wrapper">

        <style>
            .form-group {
                margin-bottom: 0.5rem;
            }

            .myDiv {
                display: none;
            }
        </style>

        <div class="content">
            <div class="container-fluid">

                <div class="card card-success " id="cards">
                    <div class="card-header">
                        <h3 class="card-title">Clearing Cheque</h3>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('admin.getCusPaymentChq') }}" method="post" id="getCusPayment"
                            class="agetCusPayment" autocomplete="off">
                            @csrf


                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label for="colFormLabelSm"
                                            class="col-sm-3 col-form-label col-form-label-sm">Date</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="payment_date"
                                                class="form-control form-control-sm datepicker grabDate" value="">
                                            <span class="text-danger error-text payment_date_error"></span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="colFormLabelSm"
                                            class="col-sm-3 col-form-label col-form-label-sm">Payment Method</label>
                                        <div class="col-sm-9">
                                            <select name="category" class="form-control category" id="myselection" required>
                                                <option value="">Select Option</option>
                                                <option value="One">Invoice Wise</option>
                                                <option value="Two">Customer Wise</option>
                                            </select>
                                            <span class="text-danger error-text category_error"></span>
                                        </div>
                                    </div>
                                    <div id="showOne" class="myDiv">
                                        <div class="form-group row">
                                            <label for="colFormLabelSm"
                                                class="col-sm-3 col-form-label col-form-label-sm">Invoice No</label>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">PI-</span>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="Invoice Number"
                                                        name="invoice_no">

                                                </div>
                                                <span class="text-danger error-text invoice_no_error"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="showTwo" class="myDiv">
                                        <div class="form-group row">
                                            <label for="colFormLabelSm"
                                                class="col-sm-3 col-form-label col-form-label-sm">Customer Name</label>
                                            <div class="col-sm-9">
                                                <select class="form-control form-control-sm select2bs4" name="customer_id"
                                                    id="customer_id">
                                                    <option value="all">All Customers</option>
                                                    @foreach ($customers as $cus)
                                                        <option value="{{ $cus->id }}">
                                                            {{ $cus->customer_name . ' - ' . $cus->customer_phone }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger error-text customer_id_error"></span>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="form-group row">
                                        <label for="colFormLabelSm"
                                            class="col-sm-3 col-form-label col-form-label-sm"></label>
                                        <div class="col-sm-3">
                                            <button type="submit" class="btn btn-block btn-info">Save</button>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-8">
                                    <span class="lists"></span>
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

    <div class="modal fade editBrand modal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Payment to Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{-- {{ route('admin.updatecategoryDetails'); }} --}}
                <div class="modal-body">
                    <form action="{{ route('admin.updateCustomerPaymentChq') }}" method="post"
                        id="update-cus-payment-form">
                        @csrf
                        <input type="hidden" name="sid">
                        <div class="form-group">
                            <label for="">Total Due</label>
                            <input type="text" class="form-control" name="totaldue" disabled>
                            <span class="text-danger error-text total_error"></span>
                        </div>

                        <div class="form-group">
                            <label for="">Payment</label>
                            <input type="text" class="form-control" name="payment" placeholder="Payment">
                            <span class="text-danger error-text payment_error"></span>
                        </div>


                        <div class="form-group">
                            <label for="">Payment Into</label>
                            <select name="accounts" class="form-control" id="">
                                <option value="">--Select and Account--</option>
                                @foreach ($accounts as $acc)
                                    @if ($acc->account_name == 'Cash')
                                        @php
                                            continue;
                                        @endphp
                                    @endif
                                    <option value="{{ $acc->code }}">{{ $acc->account_name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger error-text accounts_error"></span>
                        </div>


                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-success">{{ __('language.update') }}</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>


    <div class="modal fade modal-fullscreen modal2" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
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



            $('#getCusPayment').on('submit', function(e) {
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
                            // $(form)[0].reset();
                            $(".lists").html(data.html1);
                        }

                    }
                });
            });

            $(document).on('click', '#editBrandBtn', function() {
                var invoice_no = $(this).data('id');
                $('.editBrand').find('form')[0].reset();
                $('.editBrand').find('span.error-text').text('');
                $.post("{{ route('admin.getCustomerPaymentDetailsChq') }}", {
                    invoice_no: invoice_no
                }, function(data) {
                    $('.editBrand').find('input[name="sid"]').val(invoice_no);
                    $('.editBrand').find('input[name="totaldue"]').val(data.details[0].due);
                    $('.editBrand').find('input[name="payment"]').val(data.details[0].due);
                    $('.editBrand').find('input[name="total"]').val(data.details[0].due);
                    $('.editBrand').find('input[name="discount"]').val(data.details[0].discount);
                    $('.editBrand').find('input[name="paid"]').val(data.details[0].paid);

                    $('.editBrand').modal('show');
                }, 'json');
            });

            $('#update-cus-payment-form').on('submit', function(e) {
                e.preventDefault();
                var form = this;
                
                // Create FormData from form
                var formData = new FormData(form);

                // Append extra data
                let paymentDate = $('.datepicker').val(); // grab the date
                formData.append('paidDate', paymentDate); // append to FormData

                $.ajax({
                    url: $(form).attr('action'),
                    method: $(form).attr('method'),
                    data: formData,
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
                            $("#abc").html(data.html2);
                            $('#modalTitle').html(data.msg);
                            $('.modal2').modal('show');
                            $('.modal3').modal('hide');
                            $(".lists").empty()
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
    </script>

    <script>
        $(document).ready(function() {
            $('#myselection').on('change', function() {
                var demovalue = $(this).val();
                $("div.myDiv").hide();
                $("#show" + demovalue).show();
            });
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
@endpush
