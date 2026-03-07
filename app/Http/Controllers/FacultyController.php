<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faculty;

class FacultyController extends Controller
{
    public function index()
    {
        $faculties = Faculty::with('departments')->paginate(10);
        return view('faculties.index', compact('faculties'));
    }

    public function create()
    {
        return view('faculties.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'name_en' => 'required',
            'code' => 'required|unique:faculties',
        ]);

        Faculty::create($request->all());
        return redirect()->route('faculties.index')->with('success', __('Faculty created successfully'));
    }

    public function show(Faculty $faculty)
    {
        return view('faculties.show', compact('faculty'));
    }

    public function edit(Faculty $faculty)
    {
        return view('faculties.edit', compact('faculty'));
    }

    public function update(Request $request, Faculty $faculty)
    {
        $request->validate([
            'name' => 'required',
            'name_en' => 'required',
            'code' => 'required|unique:faculties,code,' . $faculty->id,
        ]);

        $faculty->update($request->all());
        return redirect()->route('faculties.index')->with('success', __('Faculty updated successfully'));
    }

    public function destroy(Faculty $faculty)
    {
        $faculty->delete();
        return redirect()->route('faculties.index')->with('success', __('Faculty deleted successfully'));
    }
}
