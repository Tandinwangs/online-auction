<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use app\Http\Controllers\Controller;
use App\Mail\PaymentStatusUpdateMail;
use App\Models\Payment;
use Illuminate\Support\Facades\Mail;

class AdminPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::all();
        return view('admin.pages.payment.payment', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $payment = Payment::findOrFail($id);

        $request->validate([
            'status' => 'required|string|in:pending,approved,rejected',
            'reason' => 'nullable|string',
        ]);

        if($request->input('status') === 'rejected'){
            $request->validate([
                'reason' => 'required|string',
            ]);
        }
        $payment->status = $request->input('status');
        $payment->reason = $request->input('reason');
        $payment->save();

        $user = $payment->user;
        Mail::to($user->email)->send(new PaymentStatusUpdateMail($user, $payment));

        return redirect()->back()->with('success', 'Payment status updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
