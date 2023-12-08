<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('employee.index',[
            'employees'=>Employee::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employee.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        // Validate the request using the EmployeeRequest class

        //handale image
        if ($request->file('photo')) {
            $image = $request->file('photo');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('/uploads/employee/'), $imageName);
        }

        //create-data
        Employee::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'position'=>$request->position,
            'department'=>$request->department,
            'salary'=>$request->salary,
            'photo'=>$imageName,
        ]);
        return back()->withSuccess('Employee has been created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return view('employee.show',[
            'employee'=>$employee
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        return view('employee.edit',[
            'employee'=>$employee
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
         // Validate the request using the EmployeeRequest class

         //handle photo update
        if ($request->file('photo')) {
            // Delete old photo if it exists
            if ($employee->photo) {
                $photoPath = public_path('/uploads/employee/' . $employee->photo);
                if (file_exists($photoPath)) {
                    unlink($photoPath);
                }
            }

            // Upload new photo
            $image = $request->file('photo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/uploads/employee/'), $imageName);
            $employee->photo = $imageName;
        }
         // Update employee data
        $employee->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'position' => $request->position,
            'department' => $request->department,
            'salary' => $request->salary,
        ]);
        return Redirect::route('employees.index')->withSuccess('Employee has been updated!');
      
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        if($employee->photo){

            $photoPath = public_path('uploads/employee/' . $employee->photo);
            if(file_exists($photoPath)){
                unlink($photoPath);
            }
        }
        $employee->delete();
        return back()->with('success','employee record has been deleted!');
    }
}
