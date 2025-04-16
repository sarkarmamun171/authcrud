@extends('Backend.partials.index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('category.update',$category->id) }}" enctype="multipart/form-data">
                        @csrf

                        {{-- Category Name --}}
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       name="name" value="{{ old('name',$category->name) }}" required autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        {{-- Category Picture --}}
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
                        <div class="form-group row mb-0 mt-4">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create') }}
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
