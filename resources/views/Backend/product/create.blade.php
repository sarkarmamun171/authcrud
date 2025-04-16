@extends('Backend.partials.index')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5>Create Product</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Product Name --}}
                        <div class="form-group mb-3">
                            <label for="name">Product Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                        </div>

                        {{-- Description --}}
                        <div class="form-group mb-3">
                            <label for="description">Description</label>
                            <textarea name="description" rows="3" class="form-control">{{ old('description') }}</textarea>
                        </div>

                        {{-- Price --}}
                        <div class="form-group mb-3">
                            <label for="price">Price (৳) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price') }}" required>
                        </div>

                        {{-- Discount --}}
                        <div class="form-group mb-3">
                            <label for="discount">Discount (%)</label>
                            <input type="number" name="discount" class="form-control" value="{{ old('discount', 0) }}">
                        </div>

                        {{-- Stock --}}
                        <div class="form-group mb-3">
                            <label for="stock">Stock Quantity <span class="text-danger">*</span></label>
                            <input type="number" name="stock" class="form-control" value="{{ old('stock', 0) }}" required>
                        </div>

                        {{-- Category --}}
                        <div class="form-group mb-3">
                            <label for="category_id">Category <span class="text-danger">*</span></label>
                            <select name="category_id" class="form-control" required>
                                <option value="">-- Select Category --</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Subcategory --}}
                        <div class="form-group mb-3">
                            <label for="subcategory_id">Subcategory</label>
                            <select name="subcategory_id" class="form-control">
                                <option value="">-- Select Subcategory --</option>
                                @foreach ($subcategories as $sub)
                                    <option value="{{ $sub->id }}" {{ old('subcategory_id') == $sub->id ? 'selected' : '' }}>
                                        {{ $sub->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Image --}}
                        <div class="form-group mb-3">
                            <label for="image">Product Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>

                        {{-- Slug --}}
                        <div class="form-group mb-3">
                            <label for="slug">Slug (optional)</label>
                            <input type="text" name="slug" class="form-control" value="{{ old('slug') }}">
                        </div>

                        {{-- Status --}}
                        <div class="form-group mb-3">
                            <label>Status:</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" value="1" checked>
                                <label class="form-check-label">Active</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" value="0">
                                <label class="form-check-label">Inactive</label>
                            </div>
                        </div>

                        {{-- Submit Button --}}
                        <div class="form-group text-end">
                            <button type="submit" class="btn btn-success">Create Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
