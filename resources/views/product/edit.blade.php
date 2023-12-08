@extends('layouts.dashboard')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        @if (session('success'))
            <div class="alert alert-success">{{session('success')}}</div>
        @endif
        <div class="card">
            <div class="card-header bg-primary">Edit Product</div>
            <div class="card-body">
                <form action="{{route('products.update',$product->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" id="name" name="name" placeholder="product Name" value="{{$product->name}}" class="form-control">
                        @error('name')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Product Details</label>
                        <textarea class="form-control" id="summernote" name="details" placeholder="product details">{{$product->details}}</textarea>
                        @error('details')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                   
                    <div class="form-group">
                        <label for="">Price</label>
                        <input type="number" class="form-control" value="{{$product->price}}" name="price" placeholder="product Price">
                        @error('price')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Thumbnail</label>
                                <input type="file" name="thumbnail_image" class="form-control" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                <img width="100" src="{{asset('uploads/thumbnail/'.$product->thumbnail_image)}}" alt="">
                                @error('thumbnail_image')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="form-label">Images</label>
                                    <input type="file" class="form-control" multiple name="image[]">
                                    @foreach ($product->images as $image)
                                    <img width="50" src="{{asset('uploads/image/'.$image->image)}}" alt="">
                                    @endforeach 
                                    @error('image.*')
                                    <strong class="text-danger">{{$message}}</strong>
                                   @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="submit" value="save" class="btn btn-success mt-2">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });
</script>
@endpush