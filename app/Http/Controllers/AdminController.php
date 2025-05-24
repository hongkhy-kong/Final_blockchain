<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        $employers = User::where('role', 'employer')->get();
        $employees = User::where('role', 'employee')->get();

        return view('admin.dashboard', compact('employers', 'employees'));
    }

    // ---------------------
    // Create & Store Employer
    // ---------------------
    public function createEmployer()
    {
        return view('admin.create-employer');
    }

    public function storeEmployer(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'phone'    => 'nullable|string|max:20',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'employer',
            'phone'    => $request->phone,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Employer created successfully.');
    }

    // ---------------------
    // Edit & Update Employer
    // ---------------------
    public function editEmployer($id)
    {
        $employer = User::where('role', 'employer')->findOrFail($id);
        return view('admin.edit-employer', compact('employer'));
    }

    public function updateEmployer(Request $request, $id)
    {
        $employer = User::where('role', 'employer')->findOrFail($id);

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $employer->id,
            'phone' => 'nullable|string|max:20',
        ]);

        $employer->update([
            'name'  => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Employer updated successfully.');
    }

    // ---------------------
    // Delete Employer
    // ---------------------
    public function deleteEmployer($id)
    {
        $employer = User::where('role', 'employer')->findOrFail($id);
        $employer->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Employer deleted successfully.');
    }

    // ---------------------
    // Create & Store Employee
    // ---------------------
    public function createEmployee()
    {
        $employers = User::where('role', 'employer')->get();
        return view('admin.create-employee', compact('employers'));
    }

    public function storeEmployee(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|string|min:6|confirmed',
            'employer_id'=> 'nullable|exists:users,id',
            'position'   => 'nullable|string',
            'department' => 'nullable|string',
            'hire_date'  => 'nullable|date',
        ]);

        User::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'role'       => 'employee',
            'employer_id'=> $request->employer_id,
            'position'   => $request->position,
            'department' => $request->department,
            'hire_date'  => $request->hire_date,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Employee created successfully.');
    }

    // ---------------------
    // Edit & Update Employee
    // ---------------------
    public function editEmployee($id)
    {
        $employee = User::where('role', 'employee')->findOrFail($id);
        $employers = User::where('role', 'employer')->get();

        return view('admin.edit-employee', compact('employee', 'employers'));
    }

    public function updateEmployee(Request $request, $id)
    {
        $employee = User::where('role', 'employee')->findOrFail($id);

        $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email,' . $employee->id,
            'employer_id'=> 'nullable|exists:users,id',
            'position'   => 'nullable|string',
            'department' => 'nullable|string',
            'hire_date'  => 'nullable|date',
        ]);

        $employee->update([
            'name'       => $request->name,
            'email'      => $request->email,
            'employer_id'=> $request->employer_id,
            'position'   => $request->position,
            'department' => $request->department,
            'hire_date'  => $request->hire_date,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Employee updated successfully.');
    }

    // ---------------------
    // Delete Employee
    // ---------------------
    public function deleteEmployee($id)
    {
        $employee = User::where('role', 'employee')->findOrFail($id);
        $employee->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Employee deleted successfully.');
    }
}
