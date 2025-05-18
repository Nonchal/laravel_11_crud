@extends('layouts.app')
@section('content')
<div class="row justify-content-center mt-3">
    <div class="col-md-8">
        @session('success')
        <div class="alert alert-success" role="alert">
            {{ $value }}
        </div>
        @endsession
        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Edit Product
                </div>
                <div class="float-end">
                    <a href="{{ route('products.index') }}" class="btn 
btn-primary btn-sm">&larr; Back</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="mb-3 row">
                        <label for="code" class="col-md-4 col-formlabel text-md-end text-start">Code</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control 
@error('code') is-invalid @enderror" id="code" name="code" value="{{ 
old('code', $product->code) }}">
                            @error('code')
                            <span class="text-danger">{{ $message 
}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-formlabel text-md-end text-start">Name</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control 
@error('name') is-invalid @enderror" id="name" name="name" value="{{ 
old('name', $product->name) }}">
                            @error('name')
                            <span class="text-danger">{{ $message 
}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="quantity" class="col-md-4 colform-label text-md-end text-start">Quantity</label>
                        <div class="col-md-6">
                            <input type="number" class="form-control 
@error('quantity') is-invalid @enderror" id="quantity" name="quantity"
                                value="{{ old('quantity', $product->quantity) }}" min="0">
                            @error('quantity')
                            <span class="text-danger">{{ $message 
}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="price" class="col-md-4 col-formlabel text-md-end text-start">Price</label>
                        <div class="col-md-6">
                            <input type="number" step="0.01"
                                class="form-control @error('price') is-invalid @enderror" id="price"
                                name="price" value="{{ old('price', $product->price) }}" min="0">
                            @error('price')
                            <span class="text-danger">{{ $message 
}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="description" class="col-md-4 colform-label text-md-end text-start">Description</label>
                        <div class="col-md-6">
                            <textarea class="form-control 
@error('description') is-invalid @enderror" id="description"
                                name="description">{{ old('description', $product->description) }}</textarea>
                            @error('description')
                            <span class="text-danger">{{ $message 
}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="image" class="col-md-4 col-form-label text-md-end text-start">Product Image</label>
                        <div class="col-md-6">
                            @if($product->image)
                            <div class="mb-2" id="current-image-container">
                                <p>Current Image:</p>
                                <img src="{{ asset($product->image) }}" alt="Product Image" class="img-thumbnail" style="max-height: 200px;">
                            </div>
                            @endif
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image-input" name="image" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp">
                            <div class="form-text">Allowed formats: JPG, PNG, GIF, WEBP. Max size: 2MB</div>
                            @error('image')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="mt-3" id="image-preview-container" style="display: none;">
                                <p>New Image Preview:</p>
                                <img id="image-preview" src="#" alt="New product image preview" class="img-thumbnail" style="max-height: 200px;">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offsetmd-5 btn btn-primary" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const imageInput = document.getElementById('image-input');
        const imagePreview = document.getElementById('image-preview');
        const previewContainer = document.getElementById('image-preview-container');
        
        imageInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    previewContainer.style.display = 'block';
                }
                
                reader.readAsDataURL(this.files[0]);
            } else {
                previewContainer.style.display = 'none';
            }
        });
    });
</script>
@endpush