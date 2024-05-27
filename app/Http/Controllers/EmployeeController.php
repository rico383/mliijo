<?php

namespace App\Http\Controllers;

use App\Models\employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index() {
        $employee = employee::all();

        return view('people.employee', compact('employee'));
    }

    public function store(Request $request) {

        $validatedData = $request->validate([
        'name' => 'nullable|string|max:500',
        'email' => 'nullable|email|unique:employees,email|max:500',
        'phone' => 'nullable|string|max:500',
        'position' => 'nullable|string|max:500',
        'address' => 'nullable|string|max:500',
    ]);

    if ($validatedData){

        $employee = new employee();
        $employee->name=$request->name;
        $employee->email=$request->email;
        $employee->number=$request->number;
        $employee->position=$request->position;
        $employee->address=$request->address;
        $employee->save();

        return back()->with('success', 'Account Added.');
    }else{
        return back()->with('warning', 'There is a problem.');
    }
}

    public function update(Request $request, $id)
    {
        $emp = employee::findOrFail($id);

        $emp->name=$request->input('name');
        $emp->email=$request->input('email');
        $emp->number=$request->input('number');
        $emp->position=$request->input('position');
        $emp->address=$request->input('address');

        $emp->save();

        return back()->with('success', 'Update successfull.');
    }

    public function destroy($id)
    {
        $employee = employee::findOrFail($id);

        $employee -> delete();

        return back()->with('success', 'Employee deleted.');
    }
}
