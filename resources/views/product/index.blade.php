@extends('layouts.dashboard')
@section('content')
<div class="row justify-content-center mt-3">
    <div class="col-md-12">
        <div class="card">
            @if (session('success'))
            <div class="alert alert-success">{{session('success')}}</div>
            @endif
            <div class="card-header bg-primary">Employee List</div>
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <th>si</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Thumnail Image</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($products as $key=>$product)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->price}}</td>
                            <td>
                                <img width="50" src="{{asset('uploads/thumbnail/'.$product->thumbnail_image)}}" alt="">
                            </td>
                            <td class="btn-group">
                                <a href="{{route('products.show',$product->id)}}" class="btn btn-sm btn-primary mx-1">View</a>
                                <a href="{{route('products.edit',$product->id)}}" class="btn btn-sm btn-primary mx-1">Edit</a>
                                <form action="{{route('products.destroy',$product->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Delete" class="btn btn-danger btn-sm"  onclick="return confirm('Are You Sure Delete This!')">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection