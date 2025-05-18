@extends('layouts.app')
@section('content')
<div class="row justify-content-center mt-3">
 <div class="col-md-8">
 <div class="card">
 <div class="card-header">
 <div class="float-start">
 Product Information
 </div>
 <div class="float-end">
 <a href="{{ route('products.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
 </div>
 </div>
 <div class="card-body">
 <div class="row">
 <label for="code" class="col-md-4 col-formlabel text-md-end text-start"><strong>Code:</strong></label>
 <div class="col-md-6" style="line-height:35px;">{{ $product->code }}</div>
 </div>
 <div class="row">
 <label for="name" class="col-md-4 col-formlabel text-md-end text-start"><strong>Name:</strong></label>
 <div class="col-md-6" style="line-height:35px;">{{ $product->name }}</div>
 </div>
 <div class="row">
 <label for="quantity" class="col-md-4 colform-label text-md-end text-start"><strong>Quantity:</strong></label>
 <div class="col-md-6" style="line-height:35px;">{{ $product->quantity }}</div>
 </div>
 <div class="row">
 <label for="price" class="col-md-4 col-formlabel text-md-end text-start"><strong>Price:</strong></label>
 <div class="col-md-6" style="line-height:35px;">{{ $product->price }}
 </div>
 </div>
 <div class="row">
 <label for="description" class="col-md-4 colform-label text-md-end textstart"><strong>Description:</strong></label>
 <div class="col-md-6" style="line-height:35px;">{{ $product->description }}</div>
 </div>

 <div class="row mt-3">
 <label for="image" class="col-md-4 colform-label text-md-end textstart"><strong>Image:</strong></label>
 <div class="col-md-6">
     @if($product->image)
     <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="img-fluid img-thumbnail" style="max-height: 300px;">
     @else
     <!-- Sample image for demonstration -->
     <img src="{{ asset('images/products/1747456866_gettyimages-91203729-612x612.jpg') }}" alt="Sample product image" class="img-fluid img-thumbnail" style="max-height: 300px;">
     @endif
 </div>
 </div>
 
 </div>
 </div>
 </div> 
</div>
 
@endsection