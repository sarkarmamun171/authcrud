@extends('Backend.partials.index')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Create Sub Category</h4>
                </div>

                <div class="card-body">

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('sub-category.store') }}" enctype="multipart/form-data">
                        @csrf

                        {{-- Sub Category Name --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Sub Category Name <span class="text-danger">*</span></label>
                            <input id="name" type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   name="name" value="{{ old('name') }}" required autofocus>

                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Parent Category --}}
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Parent Category <span class="text-danger">*</span></label>
                            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                <option value="">-- Select Category --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Picture --}}
                        <div class="mb-3">
                            <label for="picture" class="form-label">Sub Category Image</label>
                            <input id="picture" type="file"
                                   class="form-control @error('picture') is-invalid @enderror"
                                   name="picture" onchange="previewImage(event)">

                            @error('picture')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            {{-- Image Preview --}}
                            <div class="mt-2" id="imagePreview" style="display: none;">
                                <img id="preview" src="#" alt="Preview" class="img-thumbnail" width="120">
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success px-4">
                                <i class="fa fa-plus-circle me-1"></i> Create Sub Category
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Optional: JS for image preview --}}
@push('scripts')
<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function(){
            const preview = document.getElementById('preview');
            preview.src = reader.result;
            document.getElementById('imagePreview').style.display = 'block';
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endpush
@endsection
