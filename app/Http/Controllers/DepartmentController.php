<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Faculty;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::with('faculty')->get();
        $faculties = Faculty::all();
        return view('departments.index', compact('departments', 'faculties'));
    }

    public function create()
    {
        $faculties = Faculty::all();
        return view('departments.create', compact('faculties'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'name_en' => 'required',
            'code' => 'required|unique:departments',
            'faculty_id' => 'required|exists:faculties,id',
        ]);

        Department::create($request->all());
        return redirect()->route('departments.index')->with('success', __('Department created successfully'));
    }

    public function show(Department $department)
    {
        return view('departments.show', compact('department'));
    }

    public function edit(Department $department)
    {
        $faculties = Faculty::all();
        return view('departments.edit', compact('department', 'faculties'));
    }

    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name' => 'required',
            'name_en' => 'required',
            'code' => 'required|unique:departments,code,' . $department->id,
            'faculty_id' => 'required|exists:faculties,id',
        ]);

        $department->update($request->all());
        return redirect()->route('departments.index')->with('success', __('Department updated successfully'));
    }

    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('departments.index')->with('success', __('Department deleted successfully'));
    }
}
