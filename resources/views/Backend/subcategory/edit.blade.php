@extends('Backend.partials.index')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">Create Sub Category</div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('sub-category.update', $subcategory->id) }}" enctype="multipart/form-data" id="subCategoryForm') }}" enctype="multipart/form-data">
                    @csrf

                    {{-- SubCategory Name --}}
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Sub Category Name') }}</label>
                        <div class="col-md-6">
                            <input id="name" type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   name="name" value="{{ old('name', $subcategory->name) }}" required autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    {{-- Parent Category Dropdown --}}
                    <div class="form-group row mt-3">
                        <label for="category_id" class="col-md-4 col-form-label text-md-right">{{ __('Parent Category') }}</label>
                        <div class="col-md-6">
                            <select name="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                                <option value="">-- Select Category --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ (old('category_id', $subcategory->category_id ?? '') == $category->id) ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>


                            @error('category_id')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    {{-- Picture --}}
                    <div class="form-group row mt-3">
                        <label for="picture" class="col-md-4 col-form-label text-md-right">{{ __('Picture') }}</label>
                        <div class="col-md-6">
                            <input id="picture" type="file"
                                   class="form-control @error('picture') is-invalid @enderror"
                                   name="picture">

                            @error('picture')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    {{-- Submit Button --}}
                    <div class="form-group row mt-4 mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Update Sub Category') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
