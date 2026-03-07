<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Library;

class LibraryController extends Controller
{
    public function index()
    {
        $libraryRecords = Library::with('student')->paginate(10);
        return view('library.index', compact('libraryRecords'));
    }

    public function create()
    {
        return view('library.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'book_title' => 'required',
            'book_author' => 'required',
            'isbn' => 'nullable',
            'borrow_date' => 'required|date',
            'due_date' => 'required|date',
            'status' => 'required',
        ]);

        Library::create($request->all());
        return redirect()->route('library.index')->with('success', __('Library record created successfully'));
    }

    public function show(Library $library)
    {
        return view('library.show', compact('library'));
    }

    public function edit(Library $library)
    {
        return view('library.edit', compact('library'));
    }

    public function update(Request $request, Library $library)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'book_title' => 'required',
            'book_author' => 'required',
            'isbn' => 'nullable',
            'borrow_date' => 'required|date',
            'due_date' => 'required|date',
            'status' => 'required',
        ]);

        $library->update($request->all());
        return redirect()->route('library.index')->with('success', __('Library record updated successfully'));
    }

    public function destroy(Library $library)
    {
        $library->delete();
        return redirect()->route('library.index')->with('success', __('Library record deleted successfully'));
    }

    public function borrow(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'book_title' => 'required',
            'book_author' => 'required',
            'isbn' => 'nullable',
            'borrow_date' => 'required|date',
            'due_date' => 'required|date',
        ]);

        Library::create([
            'student_id' => $request->student_id,
            'book_title' => $request->book_title,
            'book_author' => $request->book_author,
            'isbn' => $request->isbn,
            'borrow_date' => $request->borrow_date,
            'due_date' => $request->due_date,
            'status' => 'borrowed',
        ]);

        return redirect()->route('library.index')->with('success', __('Book borrowed successfully'));
    }

    public function returnBook(Request $request, Library $library)
    {
        $library->update([
            'return_date' => now(),
            'status' => 'returned',
        ]);

        return redirect()->route('library.index')->with('success', __('Book returned successfully'));
    }
}
