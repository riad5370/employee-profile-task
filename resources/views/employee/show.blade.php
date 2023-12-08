@extends('layouts.dashboard')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-success">
                    <h3>View Employee Details</h3>
                </div>
                <div class="card-body">
                    <h5>Name: {{ $employee->name }}</h5>
                    <p>Email: {{ $employee->email }}</p>
                    <p>Phone: {{ $employee->phone }}</p>
                    <p>Position: {{ $employee->position }}</p>
                    <p>Department: {{ $employee->department }}</p>
                    <p>Salary: {{ $employee->salary }}</p>
                    <div class="my-5">
                       <span>Photo:</span>  <img width="150" src="{{asset('uploads/employee/'.$employee->photo)}}" alt="">
                    </div>
                </div>
                <a href="{{route('employees.index')}}" class="btn btn-secondary w-10">back</a>
            </div>
        </div>
    </div>
</div>
@endsection