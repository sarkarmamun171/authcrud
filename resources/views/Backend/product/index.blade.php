@extends('Backend.partials.index')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Product List</h3>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <table class="table table-bordered table-hover table-striped align-middle text-center">
                        <thead class="table-dark">
                        <tr>
                            <th>SL</th>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Subcategory</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($products as $key => $product)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category->name ?? 'N/A' }}</td>
                                <td>{{ $product->subcategory->name ?? 'N/A' }}</td>
                                <td>{{ Str::limit($product->description, 30) }}</td>
                                <td>${{ number_format($product->price, 2) }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>
                                    @if($product->status)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    @if($product->image)
                                        <img src="{{ asset($product->image) }}" alt="Product" width="50" height="50" class="rounded">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="{{ route('product.delete', $product->id) }}" class="btn btn-sm btn-danger"
                                       onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-muted">No products found.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                    {{-- Optional: Pagination --}}
                    {{-- {{ $products->links() }} --}}
                </div>
            </div>
        </div>
    </div>
@endsection
