@extends('dashboard.admin.layouts.admin-layout')
@section('title', 'Add Product')
@push('admincss')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <link rel="stylesheet" href="/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        /* Suggestions dropdown */
        #suggestions-box {
            border: 1px solid #ddd;
            border-radius: 0 0 6px 6px;
            background: #fff;
            max-height: 200px;
            overflow-y: auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Each suggestion item */
        #suggestions-box .list-group-item {
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            font-size: 14px;
            color: #333;
        }

        /* Hover effect */
        #suggestions-box .list-group-item:hover {
            background: #f8f9fa;
            color: #000;
            font-weight: 500;
        }

        /* No matches item style */
        #suggestions-box .list-group-item:last-child {
            border-bottom: none;
            font-style: italic;
            color: #999;
            cursor: default;
        }
    </style>
@endpush

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Add Product</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Add Product</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->



        <div class="content">
            <div class="container-fluid">


                <div class="card card-success " id="cards">
                    <div class="card-header" data-card-widget="collapse">
                        <h3 class="card-title">Add a user</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('admin.addProducts') }}" method="post" id="add-product-form"
                            class="addpdtform" autocomplete="off">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Bar Code &nbsp;&nbsp;<i class="fas fa-barcode"></i></label>
                                        <input type="text" class="form-control" name="barcode"
                                            placeholder="Enter Barcode">
                                        <span class="text-danger error-text barcode_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Product Manufacturer <span class="text-danger">*</span>
                                            &nbsp;&nbsp;<i class="fas fa-industry"></i><span class="text-success"
                                                data-toggle="modal" data-target="#manufacturer">&nbsp;&nbsp;[<i
                                                    class="fas fa-plus"></i> Add]</span></label>
                                        <select class="form-control select2bs4" name="manufacturer_id" style="width: 100%;"
                                            id="manufacturer_selected">
                                            <option value="">--Select Manufacturer--</option>
                                            @forelse ($manufacturers as $manufacturer)
                                                <option value="{{ $manufacturer->id }}">
                                                    {{ $manufacturer->manufacturer_name }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                        <span class="text-danger error-text manufacturer_id_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Product Category Name <span class="text-danger">*</span>
                                            &nbsp;&nbsp;<i class="fas fa-boxes"></i><span class="text-success"
                                                data-toggle="modal" data-target="#categories">&nbsp;&nbsp;[<i
                                                    class="fas fa-plus"></i> Add]</span></label>
                                        <select class="form-control select2bs4" name="category_id" style="width: 100%;"
                                            id="category_selected">
                                            <option value="">--Select category--</option>
                                            @forelse ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                        <span class="text-danger error-text category_id_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Product Brand Name <span class="text-danger">*</span>
                                            &nbsp;&nbsp;<i class="fas fa-barcode"></i><span class="text-success"
                                                data-toggle="modal" data-target="#brands">&nbsp;&nbsp;[<i
                                                    class="fas fa-plus"></i> Add]</span></label>
                                        <select class="form-control select2bs4" name="brand_id" style="width: 100%;"
                                            id="brand_selected">
                                            <option value="">--Select category--</option>
                                            @forelse ($brands as $brand)
                                                <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                        <span class="text-danger error-text brand_id_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Shelf Name &nbsp;&nbsp;<i class="fas fa-barcode"></i><span
                                                class="text-success" data-toggle="modal"
                                                data-target="#shelfs">&nbsp;&nbsp;[<i class="fas fa-plus"></i>
                                                Add]</span></label>
                                        <select class="form-control select2bs4" name="shelf_id" style="width: 100%;"
                                            id="shelf_selected">
                                            <option value="">--Select category--</option>
                                            @forelse ($shelfs as $shelf)
                                                <option value="{{ $shelf->id }}">{{ $shelf->shelf_name }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                        <span class="text-danger error-text shelf_id_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Product Unit <span class="text-danger">*</span> <span class="text-success"
                                                data-toggle="modal" data-target="#units">&nbsp;&nbsp;[<i
                                                    class="fas fa-plus"></i> Add]</span></label>
                                        <select class="form-control select2bs4" name="unit_id" style="width: 100%;"
                                            id="unit_selected">
                                            <option value="">--Select category--</option>
                                            @forelse ($units as $unit)
                                                <option value="{{ $unit->id }}">{{ $unit->unit_name }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                        <span class="text-danger error-text unit_id_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group position-relative">
                                        <label>Product Name <span class="text-danger">*</span> &nbsp;&nbsp;<i
                                                class="fas fa-barcode"></i></label>
                                        <input type="text" class="form-control" id="product_title"
                                            name="product_title" placeholder="Enter Product Name">
                                        <span class="text-danger error-text product_title_error"></span>
                                        <div id="suggestions-box" class="list-group position-absolute w-100"
                                            style="z-index:1000;"></div>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Product Description &nbsp;&nbsp;<i
                                                class="fas fa-barcode"></i></label>
                                        <textarea name="product_description" class="summernote"></textarea>
                                        <span class="text-danger error-text product_description_error"></span>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Upload Image</label>
                                        <input type="file" name="product_image" class="form-control">
                                        <span class="text-danger error-text product_image_error"></span>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="img-holder"></div>
                                </div>
                                <!-- /.col -->
                            </div>





                            <!-- /.row -->
                            <div class="row">
                                <div class="col-md-3">
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



    <!-- Add Manufacturer -->
    <div class="modal fade" id="manufacturer" tabindex="-1" role="dialog" aria-labelledby="manufacturerLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title" id="addManufacturerLabel">{{ __('language.add_manufacturer') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.addmanufacturerinpdt') }}" method="post" id="add-manufacturer-forms"
                        autocomplete="off">
                        @csrf
                        <div class="form-group">
                            <label for="">{{ __('language.product_manufacturer') }}</label>
                            <input type="text" class="form-control" name="manufacturer_name"
                                placeholder="{{ __('language.add_manufacturer') }}">
                            <span class="text-danger error-text manufacturer_name_error"></span>
                        </div>




                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-success">{{ __('language.save') }}</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <!-- Add Category -->
    <div class="modal fade" id="categories" tabindex="-1" role="dialog" aria-labelledby="categoriesLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title" id="categoriesLabel">{{ __('language.add_category') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.addcategoryinpdt') }}" method="post" id="add-category-forms"
                        autocomplete="off">
                        @csrf
                        <div class="form-group">
                            <label for="">{{ __('language.product_category') }}</label>
                            <input type="text" class="form-control" name="category_name"
                                placeholder="{{ __('language.add_category') }}">
                            <span class="text-danger error-text category_name_error"></span>
                        </div>




                        <div class="form-group">
                            <button type="submits" class="btn btn-block btn-success">{{ __('language.save') }}</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Add Brand -->
    <div class="modal fade" id="brands" tabindex="-1" role="dialog" aria-labelledby="brandsLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title" id="brandsLabel">{{ __('language.add_brand') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.addbrandinpdt') }}" method="post" id="add-brand-forms"
                        autocomplete="off">
                        @csrf
                        <div class="form-group">
                            <label for="">{{ __('language.product_brand') }}</label>
                            <input type="text" class="form-control" name="brand_name"
                                placeholder="{{ __('language.add_brand') }}">
                            <span class="text-danger error-text brand_name_error"></span>
                        </div>




                        <div class="form-group">
                            <button type="submits" class="btn btn-block btn-success">{{ __('language.save') }}</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Add Unit -->
    <div class="modal fade" id="units" tabindex="-1" role="dialog" aria-labelledby="unitsLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title" id="unitsLabel">{{ __('language.add_unit') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.addunitinpdt') }}" method="post" id="add-unit-forms"
                        autocomplete="off">
                        @csrf
                        <div class="form-group">
                            <label for="">{{ __('language.product_unit') }}</label>
                            <input type="text" class="form-control" name="unit_name"
                                placeholder="{{ __('language.add_unit') }}">
                            <span class="text-danger error-text unit_name_error"></span>
                        </div>




                        <div class="form-group">
                            <button type="submits" class="btn btn-block btn-success">{{ __('language.save') }}</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Add Shelf -->
    <div class="modal fade" id="shelfs" tabindex="-1" role="dialog" aria-labelledby="shelfsLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title" id="shelfsLabel">{{ __('language.add_shelf') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.addshelfinpdt') }}" method="post" id="add-shelf-forms"
                        autocomplete="off">
                        @csrf
                        <div class="form-group">
                            <label for="">{{ __('language.product_shelf') }}</label>
                            <input type="text" class="form-control" name="shelf_name"
                                placeholder="{{ __('language.add_shelf') }}">
                            <span class="text-danger error-text shelf_name_error"></span>
                        </div>




                        <div class="form-group">
                            <button type="submits" class="btn btn-block btn-success">{{ __('language.save') }}</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection

@push('adminjs')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.2.0/dist/sweetalert2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
    @include('dashboard.admin.adminjs.addproductjs')
    <script>
        $(function() {
            $('.summernote').summernote();
        })
    </script>
    <script>
        $(document).ready(function() {
            $('#product_title').on('keyup', function() {
                let query = $(this).val();
                if (query.length > 1) {
                    $.ajax({
                        url: "{{ route('admin.products.suggestions') }}",
                        type: "GET",
                        data: {
                            query: query
                        },
                        success: function(data) {
                            let suggestionBox = $('#suggestions-box');
                            suggestionBox.empty();
                            if (data.length > 0) {
                                data.forEach(function(item) {
                                    suggestionBox.append(
                                        '<a href="#" class="list-group-item list-group-item-action suggestion-item">' +
                                        item + '</a>');
                                });
                            } else {
                                suggestionBox.append(
                                    '<span class="list-group-item">No matches found</span>');
                            }
                        }
                    });
                } else {
                    $('#suggestions-box').empty();
                }
            });

            // On suggestion click, set value to input
            $(document).on('click', '.suggestion-item', function(e) {
                e.preventDefault();
                $('#product_title').val($(this).text());
                $('#suggestions-box').empty();
            });
        });
    </script>
@endpush
