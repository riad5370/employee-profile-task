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
                        <th>Email</th>
                        <th>Photo</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($employees as $key=>$employee)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$employee->name}}</td>
                            <td>{{$employee->email}}</td>
                            <td>
                                <img width="50" src="{{asset('uploads/employee/'.$employee->photo)}}" alt="">
                            </td>
                            <td class="btn-group">
                                <a href="{{route('employees.show',$employee->id)}}" class="btn btn-sm btn-primary mx-1">show</a>
                                <a href="{{route('employees.edit',$employee->id)}}" class="btn btn-sm btn-primary mx-1">Edit</a>
                                <form action="{{route('employees.destroy',$employee->id)}}" method="POST">
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