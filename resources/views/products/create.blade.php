@extends('layouts.app')
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-plus-circle me-2"></i>Add New Product</span>
                    <a href="{{ route('products.index') }}" class="btn btn-sm btn-edit">
                        <i class="fas fa-arrow-left me-1"></i> Back to Products
                    </a>
                </div>
                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            <strong>Please fix the following errors:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="product-form">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="code" class="form-label fw-bold"><i class="fas fa-barcode me-2"></i>Product Code</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                        <input type="text" id="code" name="code" class="form-control @error('code') is-invalid @enderror" value="{{ old('code') }}" placeholder="Enter unique product code" required>
                                    </div>
                                    @error('code')
                                        <div class="text-danger mt-1 small">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-4">
                                    <label for="name" class="form-label fw-bold"><i class="fas fa-tag me-2"></i>Product Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-box"></i></span>
                                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Enter product name" required>
                                    </div>
                                    @error('name')
                                        <div class="text-danger mt-1 small">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label for="quantity" class="form-label fw-bold"><i class="fas fa-cubes me-2"></i>Quantity</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-sort-numeric-up"></i></span>
                                                <input type="number" id="quantity" name="quantity" class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity') }}" min="0" placeholder="0" required>
                                            </div>
                                            @error('quantity')
                                                <div class="text-danger mt-1 small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label for="price" class="form-label fw-bold"><i class="fas fa-dollar-sign me-2"></i>Price</label>
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <input type="number" id="price" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" min="0" step="0.01" placeholder="0.00" required>
                                            </div>
                                            @error('price')
                                                <div class="text-danger mt-1 small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mb-4">
                                    <label for="description" class="form-label fw-bold"><i class="fas fa-align-left me-2"></i>Description</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-file-alt"></i></span>
                                        <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" rows="4" placeholder="Enter product description">{{ old('description') }}</textarea>
                                    </div>
                                    @error('description')
                                        <div class="text-danger mt-1 small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="image" class="form-label fw-bold"><i class="fas fa-image me-2"></i>Product Image</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text"><i class="fas fa-upload"></i></span>
                                        <input type="file" id="image-input" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp">
                                    </div>
                                    <div class="form-text small"><i class="fas fa-info-circle me-1"></i>Allowed formats: JPG, PNG, GIF, WEBP. Max size: 2MB</div>
                                    @error('image')
                                        <div class="text-danger mt-1 small">{{ $message }}</div>
                                    @enderror
                                    
                                    <div class="image-upload-container mt-4 text-center p-3 border rounded" id="image-preview-container">
                                        <div class="upload-placeholder" id="upload-placeholder">
                                            <i class="fas fa-cloud-upload-alt fa-4x text-muted mb-3"></i>
                                            <p class="text-muted">Image preview will appear here</p>
                                        </div>
                                        <img id="image-preview" src="#" alt="Product image preview" class="img-thumbnail" style="max-height: 200px; max-width: 100%; display: none;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-4 pt-3 border-top d-flex justify-content-between">
                            <a href="{{ route('products.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times me-1"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-add">
                                <i class="fas fa-save me-1"></i> Save Product
                            </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Image preview functionality
    document.addEventListener('DOMContentLoaded', function() {
        const imageInput = document.getElementById('image-input');
        const imagePreview = document.getElementById('image-preview');
        const uploadPlaceholder = document.getElementById('upload-placeholder');
        
        imageInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                    uploadPlaceholder.style.display = 'none';
                }
                
                reader.readAsDataURL(this.files[0]);
            } else {
                imagePreview.style.display = 'none';
                uploadPlaceholder.style.display = 'block';
            }
        });
    });
</script>
@endpush