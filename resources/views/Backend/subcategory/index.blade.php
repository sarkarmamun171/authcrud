@extends('Backend.partials.index')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="card-title">Sub Category List</h3>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="{{ route('sub-category.create') }}" class="btn btn-sm btn-success">+ Create Sub Category</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">SL</th>
                            <th scope="col">Category Name</th>
                            <th scope="col">Sub Category Name</th>
                            <th scope="col">Picture</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($subCategories as $key => $subCategory)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $subCategory->category->name }}</td>
                                <td>{{ $subCategory->name }}</td>
                                <td><img src="{{ asset($subCategory->picture) }}" alt="" width="50px"></td>
                                <td>
                                    <a href="{{ route('sub-category.edit', $subCategory->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <a href="{{ route('sub-category.delete', $subCategory->id) }}" class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
