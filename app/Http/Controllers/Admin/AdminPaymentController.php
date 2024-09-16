<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use app\Http\Controllers\Controller;
use App\Mail\PaymentStatusUpdateMail;
use App\Models\Payment;
use Illuminate\Support\Facades\Mail;
use App\Models\FinalPayment;

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


    public function finalPayView()
    {
        $payments = FinalPayment::all();
        return view('admin.pages.payment.finalPayment', compact('payments'));
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

    public function finalPayUpdate(Request $request, string $id)
    {
        $payment = FinalPayment::findOrFail($id);

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
        // Mail::to($user->email)->send(new PaymentStatusUpdateMail($user, $payment));

        return redirect()->back()->with('success', 'Payment status updated successfully.');
    }

    public function rePayView(){
        $users = Payment::where('status', 'approved')->get();
        return view('admin.pages.payment.rePayment', compact('users'));
    }


//     public function rePayment(Request $request, $id)
// {
//     // Find the payment by ID
//     $payment = Payment::findOrFail($id);

//     // Update refund_status, set to 1 if checked, otherwise default to 0
//     $payment->refund_status = $request->has('refund_status') ? 1 : 0;

//     // Save the changes
//     $payment->save();

//     // Redirect or return a response (e.g., redirecting back to the form)
//     return redirect()->back()->with('success', 'Refund status updated successfully!');
// }

    public function updateRefundStatus(Request $request, $id)
    {
        // Find the payment by its ID
        $payment = Payment::findOrFail($id);

        // Update the refund_status based on the checkbox value
        $payment->refund_status = $request->has('refund_status') ? 1 : 0;

        // Save the updated payment status
        $payment->save();

        // Redirect back to the page with a success message
        return redirect()->back()->with('success', 'Refund status updated successfully');
    }



}
