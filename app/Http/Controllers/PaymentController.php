<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('student')->get();
        return view('payments.index', compact('payments'));
    }

    public function create()
    {
        return view('payments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'amount' => 'required|numeric',
            'payment_method' => 'required',
            'payment_date' => 'required|date',
            'reference_number' => 'nullable',
            'status' => 'required',
        ]);

        Payment::create($request->all());
        return redirect()->route('payments.index')->with('success', __('Payment created successfully'));
    }

    public function show(Payment $payment)
    {
        return view('payments.show', compact('payment'));
    }

    public function edit(Payment $payment)
    {
        return view('payments.edit', compact('payment'));
    }

    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'amount' => 'required|numeric',
            'payment_method' => 'required',
            'payment_date' => 'required|date',
            'reference_number' => 'nullable',
            'status' => 'required',
        ]);

        $payment->update($request->all());
        return redirect()->route('payments.index')->with('success', __('Payment updated successfully'));
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('payments.index')->with('success', __('Payment deleted successfully'));
    }

    public function receipt(Payment $payment)
    {
        return view('payments.receipt', compact('payment'));
    }
}
