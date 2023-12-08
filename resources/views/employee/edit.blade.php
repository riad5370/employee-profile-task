@extends('layouts.dashboard')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        @if (session('success'))
            <div class="alert alert-success">{{session('success')}}</div>
        @endif
        <div class="card">
            <div class="card-header bg-primary">Edit Employee</div>
            <div class="card-body">
                <form action="{{route('employees.update',$employee->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" id="name" name="name" value="{{$employee->name}}" class="form-control">
                        @error('name')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Email</label>
                                <input type="email" name="email" value="{{$employee->email}}" class="form-control">
                                @error('email')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="">Phone</label>
                                <input type="number" name="phone" value="{{$employee->phone}}" class="form-control">
                                @error('phone')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Position</label>
                                <input type="text" name="position" value="{{$employee->position}}" class="form-control">
                            @error('position')
                            <strong class="text-danger">{{$message}}</strong>
                            @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="">Department</label>
                                <input type="text" name="department" value="{{$employee->department}}" class="form-control">
                                @error('department')
                                <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Salary</label>
                        <input type="number" name="salary" value="{{$employee->salary}}" class="form-control">
                        @error('salary')
                        <strong class="text-danger">{{$message}}</strong>
                       @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Image</label>
                        <input type="file" name="photo" class="form-control" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                        <img width="100" src="{{asset('uploads/employee/'.$employee->photo)}}" id="blah" alt="">
                        @error('photo')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <input type="submit" value="save" class="btn btn-success mt-2">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection