@extends('Backend.partials.index')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Create Category</h4>
                </div>

                <div class="card-body">

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('category.store') }}" enctype="multipart/form-data">
                        @csrf

                        {{-- Category Name --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Category Name <span class="text-danger">*</span></label>
                            <input id="name" type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   name="name" value="{{ old('name') }}" required autofocus>

                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Category Picture --}}
                        <div class="mb-3">
                            <label for="picture" class="form-label">Category Image</label>
                            <input id="picture" type="file"
                                   class="form-control @error('picture') is-invalid @enderror"
                                   name="picture" accept="image/*">

                            @error('picture')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Submit Button --}}
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success px-4">
                                <i class="fa fa-plus-circle me-1"></i> Create
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
