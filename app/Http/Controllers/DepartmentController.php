<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::with('faculty')->get();
        return view('departments.index', compact('departments'));
    }

    public function create()
    {
        return view('departments.create');
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
        return view('departments.edit', compact('department'));
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
