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
            'first_name' => 'required',
            'last_name' => 'required',
            'employee_id' => 'required|unique:professors',
            'email' => 'required|email|unique:users',
            'department_id' => 'required|exists:departments,id',
        ]);

        // Generate a default password if not provided
        $password = $request->password ?? 'password123';

        $user = \App\Models\User::create([
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($password),
            'role' => 'professor',
        ]);

        Professor::create([
            'user_id' => $user->id,
            'department_id' => $request->department_id,
            'employee_id' => $request->employee_id,
            'first_name' => $request->first_name,
            'first_name_en' => $request->first_name_en ?? $request->first_name,
            'last_name' => $request->last_name,
            'last_name_en' => $request->last_name_en ?? $request->last_name,
            'phone' => $request->phone,
            'birth_date' => $request->birth_date,
            'specialization' => $request->specialization,
            'degree' => $request->degree,
            'qualifications' => $request->qualifications,
            'office' => $request->office,
            'office_hours' => $request->office_hours,
            'status' => 'active',
        ]);

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
            'first_name' => 'required',
            'last_name' => 'required',
            'employee_id' => 'required|unique:professors,employee_id,' . $professor->id,
            'email' => 'required|email',
            'department_id' => 'required|exists:departments,id',
        ]);

        $professor->update([
            'first_name' => $request->first_name,
            'first_name_en' => $request->first_name_en ?? $request->first_name,
            'last_name' => $request->last_name,
            'last_name_en' => $request->last_name_en ?? $request->last_name,
            'employee_id' => $request->employee_id,
            'phone' => $request->phone,
            'birth_date' => $request->birth_date,
            'specialization' => $request->specialization,
            'degree' => $request->degree,
            'qualifications' => $request->qualifications,
            'office' => $request->office,
            'office_hours' => $request->office_hours,
            'department_id' => $request->department_id,
        ]);

        // Update associated user
        if ($professor->user) {
            $professor->user->update([
                'name' => $request->first_name . ' ' . $request->last_name,
                'email' => $request->email,
            ]);
        }

        return redirect()->route('professors.index')->with('success', __('Professor updated successfully'));
    }

    public function destroy(Professor $professor)
    {
        // Delete associated user account
        if ($professor->user) {
            $professor->user->delete();
        }
        $professor->delete();
        return redirect()->route('professors.index')->with('success', __('Professor deleted successfully'));
    }
}
