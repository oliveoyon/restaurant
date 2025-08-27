@extends('dashboard.admin.layouts.admin-layout')
@section('title', 'Add Product')
@push('admincss')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <link rel="stylesheet" href="/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
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


                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Product Recipes</h3>
                        <a href="{{ route('admin.recipes.create') }}" class="btn btn-primary btn-sm float-right">Add New
                            Recipe</a>
                    </div>
                    <div class="card-body table-responsive p-0" style="max-height: 500px;">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Finished Product</th>
                                    <th>Raw Materials</th>
                                    <th>Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($groupedRecipes as $productId => $recipeItems)
                                    <tr>
                                        <td>{{ $productId }}</td>
                                        <td>{{ $products[$productId]->product_title ?? 'N/A' }}</td>

                                        <td>
                                            {{ $recipeItems->pluck('rawProduct.product_title')->join(', ') }}
                                        </td>

                                        <td>{{ $recipeItems->first()->created_at->format('Y-m-d') }}</td>
                                        <td>
                                            <button class="btn btn-info btn-sm view-recipe-details"
                                                data-product-id="{{ $productId }}">View</button>

                                            <a href="{{ route('admin.recipes.edit', $productId) }}"
                                                class="btn btn-primary btn-sm">Edit</a>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">No recipes found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>



            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- Modal -->
    <div class="modal fade" id="recipeModal" tabindex="-1" aria-labelledby="recipeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Recipe Details</h5>
                    <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"
                        aria-label="Close">&times;</button>
                </div>

                <div class="modal-body" id="recipeModalContent">
                    Loading...
                </div>
            </div>
        </div>
    </div>




@endsection

@push('adminjs')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

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
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.view-recipe-details').forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-product-id');

                    fetch(`/admin/recipes/${productId}`)
                        .then(response => response.text())
                        .then(html => {
                            document.getElementById('recipeModalContent').innerHTML = html;
                            new bootstrap.Modal(document.getElementById('recipeModal')).show();
                        })
                        .catch(error => {
                            console.error('Error loading recipe:', error);
                            document.getElementById('recipeModalContent').innerHTML =
                                '<p class="text-danger">Failed to load recipe details.</p>';
                            new bootstrap.Modal(document.getElementById('recipeModal')).show();
                        });
                });
            });
        });
    </script>
@endpush
