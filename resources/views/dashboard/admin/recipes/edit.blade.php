@extends('dashboard.admin.layouts.admin-layout')
@section('title', 'Edit Recipe')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1 class="m-0">Edit Recipe</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Edit Recipe</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Edit Recipe for {{ $product->product_title }}</h3>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.recipes.update', $product->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        <div id="raw-items">
                            @foreach($recipeItems as $item)
                                <div class="row raw-item mb-2">
                                    <div class="col-md-6">
                                        <label>Raw Material</label>
                                        <select name="raw_product_id[]" class="form-control raw-product" required>
                                            <option value="">-- Select Raw Material --</option>
                                            @foreach($products->where('category_id', 3) as $productRaw)
                                                <option value="{{ $productRaw->id }}" data-unit-id="{{ $productRaw->unit_id }}"
                                                    {{ $productRaw->id == $item->raw_product_id ? 'selected' : '' }}>
                                                    {{ $productRaw->product_title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Quantity</label>
                                        <input type="number" step="any" name="quantity[]" class="form-control" value="{{ $item->quantity }}" required>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Unit</label>
                                        <select name="unit[]" class="form-control unit-select lock-dropdown" readonly required>
                                            <option value="">Select Unit</option>
                                            @foreach($units as $unit)
                                                <option value="{{ $unit->unit_name }}" data-id="{{ $unit->id }}"
                                                    {{ $unit->unit_name == $item->unit ? 'selected' : '' }}>
                                                    {{ $unit->unit_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2 d-flex align-items-end">
                                        <button type="button" class="btn btn-danger remove-item">×</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <button type="button" id="add-item" class="btn btn-info mt-3">Add Raw Material</button>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Update Recipe</button>
                        <a href="{{ route('admin.recipes.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('adminjs')
<script>
    document.addEventListener('DOMContentLoaded', function() {

        // Prevent editing readonly unit
        document.addEventListener('mousedown', e => { if(e.target.classList.contains('lock-dropdown')) e.preventDefault(); });
        document.addEventListener('keydown', e => { if(e.target.classList.contains('lock-dropdown')) e.preventDefault(); });

        // Add new raw material row
        document.getElementById('add-item').addEventListener('click', function() {
            const rawItem = document.querySelector('.raw-item');
            const clone = rawItem.cloneNode(true);
            clone.querySelectorAll('input').forEach(input => input.value = '');
            clone.querySelectorAll('select').forEach(select => select.value = '');
            document.querySelector('#raw-items').appendChild(clone);
        });

        // Remove row
        document.addEventListener('click', function(e) {
            if(e.target.classList.contains('remove-item')){
                const items = document.querySelectorAll('.raw-item');
                if(items.length > 1){
                    e.target.closest('.raw-item').remove();
                }
            }
        });

        // Auto-select unit based on selected raw material
        document.querySelector('#raw-items').addEventListener('change', function(e) {
            if(e.target.classList.contains('raw-product')){
                const rawSelect = e.target;
                const selectedOption = rawSelect.options[rawSelect.selectedIndex];
                const unitId = selectedOption.getAttribute('data-unit-id');
                const row = rawSelect.closest('.raw-item');
                const unitSelect = row.querySelector('.unit-select');

                if(unitId && unitSelect){
                    Array.from(unitSelect.options).forEach(option => {
                        option.selected = option.getAttribute('data-id') == unitId;
                    });
                }
            }
        });
    });
</script>
@endpush
