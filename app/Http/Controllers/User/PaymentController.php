<?php

namespace App\Http\Controllers\User;

use App\Models\Payment;
use Illuminate\Http\Request;
use app\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request, $item_id)
    {
        $user = Auth::user();
        $item = Item::findOrFail($item_id);

        $request->validate([
            'screenshot' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

     // Check if the user has already paid for this item
     $existingPayment = Payment::where('user_id', $user->id)
     ->where('auction_reference_id', $item->auction_reference_id)
     ->where('status', 'approved')
     ->first();

        if ($existingPayment) {
        return redirect()->back()->with('error', 'You have already paid for this item.');
        }

        // Handle file upload
        $screenshotPath = $request->file('screenshot')->store('payment', 'public');
        $file = $request->file('screenshot');
        $extention = $file->getClientOriginalExtension();

        $filename = time().'.'.$extention;
        $path = 'uploads/payment/';
        $file->move($path, $filename);
        $screenshotPath = $path.$filename;

        // Create a new payment record
        Payment::create([
        'user_id' => $user->id,
        'screenshot' => $screenshotPath,
        'auction_reference_id' => $item->auction_reference_id,
        'status' => 'pending', 
        ]);

        return redirect()->route('bid.show', ['item' => $item_id])
        ->with('success', 'Payment details submitted successfully. Please wait for the approval.');  
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
