@extends('Backend.partials.index')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Category List</h5>
                    <a href="{{ route('category.create') }}" class="btn btn-sm btn-success">+ Create Category</a>
                </div>

                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-bordered table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Picture</th>
                                <th width="180px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        @if($category->picture)
                                            <img src="{{ asset($category->picture) }}" alt="Category Image" width="50" height="50" style="object-fit: cover;">
                                        @else
                                            <span class="text-muted">No image</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('category.edit', $category->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('category.delete', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                                        </form>

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">No categories found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{-- Pagination (if you're paginating) --}}
                    {{-- {{ $categories->links() }} --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
