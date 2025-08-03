@extends('dashboard.admin.layouts.admin-layout')
@section('title', 'Purchase Products')
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
                        <h3 class="card-title">Add a user</h3>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('admin.purchaseProducts') }}" method="post" id="add-product-form"
    class="addpdtform" autocomplete="off">
    @csrf
    <input type="hidden" name="taxes" value="0" id="taxes">
    <input type="hidden" name="total_tax" value="0" id="total_tax">
    <input type="hidden" name="tax_value_percent" value="0" id="tax_value_percent">

    <div class="row">
        <div class="col-md-6">
            {{-- Left Column --}}
            <div class="form-group row">
                <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Invoice No</label>
                <div class="col-sm-9">
                    <input type="text" name="invoice_no" class="form-control form-control-sm"
                        readonly value="{{ $inv }}" id="colFormLabelSm">
                    <span class="text-danger error-text invoice_no_error"></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Supplier Name</label>
                <div class="col-sm-9">
                    <select class="form-control form-control-sm select2bs4" required name="supplier_id"
                        style="width: 100%;" id="supplier_selected">
                        <option value="">--Select Supplier--</option>
                        @forelse ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                        @empty
                        @endforelse
                    </select>
                    <span class="text-danger error-text supplier_id_error"></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Product Name</label>
                <div class="col-sm-9">
                    <select name="product_id" class="form-control select2bs4" required id="product_id">
                        <option value="">--Select a Product--</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->product_title }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger error-text product_id_error"></span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-6 col-form-label col-form-label-sm">Stock</label>
                        <div class="col-sm-6">
                            <input type="text" name="stock" disabled class="form-control form-control-sm" id="colFormLabelSm">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Unit</label>
                        <div class="col-sm-8">
                            <input type="text" name="unit" disabled class="form-control form-control-sm" id="colFormLabelSm">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-5 col-form-label col-form-label-sm">Barcode</label>
                        <div class="col-sm-7">
                            <input type="text" name="barcode" class="form-control form-control-sm" value="">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            {{-- Right Column --}}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-6 col-form-label col-form-label-sm">Quantity</label>
                        <div class="col-sm-6">
                            <input type="text" name="quantity" class="form-control form-control-sm" required value=""
                                id="quantity">
                            <span class="text-danger error-text quantity_error"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-6 col-form-label col-form-label-sm">Buy Price</label>
                        <div class="col-sm-6">
                            <input type="text" name="buy_price" class="form-control form-control-sm" required
                                id="buy_price">
                            <span class="text-danger error-text buy_price_error"></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-5 col-form-label col-form-label-sm">Sale Price</label>
                        <div class="col-sm-7">
                            <input type="text" name="sell_price" class="form-control form-control-sm" required
                                id="colFormLabelSm">
                            <span class="text-danger error-text sell_price_error"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-6 col-form-label col-form-label-sm">Purchase Date</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control form-control-sm datepicker" name="purchase_date">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-6 col-form-label col-form-label-sm">Grand Total</label>
                        <div class="col-sm-6">
                            <input type="text" name="net_cost" class="form-control form-control-sm" readonly
                                id="net_cost" value="">
                            <span class="text-danger error-text net_cost_error"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Save Button --}}
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

            <div class="card " id="cards">
                <div class="card-body">
                    <div id="table-responsive">
                    </div>
                </div>
            </div>

            <div class="card " id="cards">
                <div class="card-body">
                    <form action="{{ route('admin.purchaseProducts1') }}" method="post" id="purchase-product-form"
                        class="addpdtform1" autocomplete="off">
                        @csrf
                        <div id="table-responsive1">
                        </div>
                    </form>
                </div>
            </div>

        </div><!-- /.container-fluid -->

    </div>
    <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->
    <!-- Modal -->





@endsection

@push('adminjs')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    @include('dashboard.admin.adminjs.searchpdttopurchase')
    <script>
        $('body').on('focus', ".datepicker", function() {
            $(this).datepicker();
        });

        $('.datepicker').datepicker().on('changeDate', function() {
            $(this).datepicker('hide');
        });
    </script>
@endpush
