@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        @session('success')
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ $value }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endsession
        
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fas fa-box me-2"></i>Product List</span>
                <a href="{{ route('products.create') }}" class="btn btn-add">
                    <i class="fas fa-plus-circle me-1"></i> Add New Product
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col" width="5%">S#</th>
                                <th scope="col" width="10%">Code</th>
                                <th scope="col" width="20%">Name</th>
                                <th scope="col" width="10%">Quantity</th>
                                <th scope="col" width="10%">Price</th>
                                <th scope="col" width="15%">Image</th>
                                <th scope="col" width="30%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $product->code }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>${{ number_format($product->price, 2) }}</td>
                                    <td class="text-center">
                                        @if($product->image)
                                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="img-thumbnail" style="max-height: 50px;">
                                        @else
                                            <img src="{{ asset('images/products/1747456866_gettyimages-91203729-612x612.jpg') }}" alt="Sample image" class="img-thumbnail" style="max-height: 50px;">
                                        @endif
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-show">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-edit">
                                                <i class="fas fa-pencil-alt"></i> Edit
                                            </a>
                                            <form action="{{ route('products.destroy', $product->id) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-delete" onclick="return confirm('Do you want to delete this product?');">
                                                    <i class="fas fa-trash-alt"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <i class="fas fa-box-open fa-3x text-muted mb-3 d-block"></i>
                                        <span class="text-danger">
                                            <strong>No Products Found!</strong>
                                        </span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
@endsection