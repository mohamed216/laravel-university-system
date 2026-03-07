<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professor;

class ProfessorController extends Controller
{
    public function index()
    {
        $professors = Professor::with('department')->paginate(10);
        return view('professors.index', compact('professors'));
    }

    public function create()
    {
        return view('professors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:professors',
            'phone' => 'required',
            'department_id' => 'required|exists:departments,id',
        ]);

        Professor::create($request->all());
        return redirect()->route('professors.index')->with('success', __('Professor created successfully'));
    }

    public function show(Professor $professor)
    {
        return view('professors.show', compact('professor'));
    }

    public function edit(Professor $professor)
    {
        return view('professors.edit', compact('professor'));
    }

    public function update(Request $request, Professor $professor)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:professors,email,' . $professor->id,
            'phone' => 'required',
            'department_id' => 'required|exists:departments,id',
        ]);

        $professor->update($request->all());
        return redirect()->route('professors.index')->with('success', __('Professor updated successfully'));
    }

    public function destroy(Professor $professor)
    {
        $professor->delete();
        return redirect()->route('professors.index')->with('success', __('Professor deleted successfully'));
    }
}
