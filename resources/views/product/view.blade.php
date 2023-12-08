@extends('layouts.dashboard')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-success">
                    <h5>View Product Details</h5>
                </div>
                <div class="card-body">
                    <h3>Name: {{ $product->name }}</h3>
                    <p>Details: {!! $product->details !!}</p>
                    <p>price: {{ $product->price }}</p>
                    <div class="my-5">
                       <span>Thumbnail:</span>  <img width="100" src="{{asset('uploads/thumbnail/'.$product->thumbnail_image)}}" alt="">
                    </div>
                    <div class="my-5">
                        <span>Additional Image:</span>  
                        @foreach ($product->images as $image)
                        <img width="100" src="{{asset('uploads/image/'.$image->image)}}" alt="">
                        @endforeach 
                     </div>
                </div>
                <a href="{{route('products.index')}}" class="btn btn-secondary w-10">back</a>
            </div>
        </div>
    </div>
</div>
@endsection