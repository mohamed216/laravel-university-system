<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fee;

class FeeController extends Controller
{
    public function index()
    {
        $fees = Fee::with('student')->paginate(10);
        return view('fees.index', compact('fees'));
    }

    public function create()
    {
        return view('fees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'amount' => 'required|numeric',
            'type' => 'required',
            'due_date' => 'required|date',
            'description' => 'nullable',
        ]);

        Fee::create($request->all());
        return redirect()->route('fees.index')->with('success', __('Fee created successfully'));
    }

    public function show(Fee $fee)
    {
        return view('fees.show', compact('fee'));
    }

    public function edit(Fee $fee)
    {
        return view('fees.edit', compact('fee'));
    }

    public function update(Request $request, Fee $fee)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'amount' => 'required|numeric',
            'type' => 'required',
            'due_date' => 'required|date',
            'description' => 'nullable',
        ]);

        $fee->update($request->all());
        return redirect()->route('fees.index')->with('success', __('Fee updated successfully'));
    }

    public function destroy(Fee $fee)
    {
        $fee->delete();
        return redirect()->route('fees.index')->with('success', __('Fee deleted successfully'));
    }
}
