<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use app\Http\Controllers\Controller;
use App\Http\Requests\StoreBidItemRequest;
use App\Models\Bid;
use App\Models\Item;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class UserBidController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.pages.item');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Item $item)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBidItemRequest $request)
    {
        $user = Auth::user();
        $item = Item::findOrFail($request->item_id);

        $payment = Payment::where('user_id', $user->id )
                            ->first();
        
        if(!$payment){
            return redirect()->back()->withErrors(['payment' => 'You must pay Nu. 26,000 to bid on this item.']);
        }else if($payment->status != 'approved'){
            return redirect()->back()->with(['error' => 'Your payment is not yet approved. Please wait for approval before bidding.']);
        }

        $minBid = $item->current_bid + $item->reserve_price;

        if($request->amount < $minBid) {
            return back()->with(['error' => "The bid amount must be at least $minBid."]); 
        }

        $data = array_merge($request->validated(), ['bid_time' => now() ]);

        Bid::create($data);

        $item->current_bid = $request->amount;
        $item->save();

        return redirect()->back()->with('success', "Bidding Added successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        $user = Auth::user();
        $hasPaid = Payment::where('user_id', $user->id)
                    ->where('auction_reference_id', $item->auction_reference_id)        
                    ->where('status', 'approved')->exists();

        $relatedItems = Item::where('category_id', $item->category_id)
                            ->where('id', '!=', $item->id)
                            ->where('auction_reference_id', $item->auction_reference_id)->get();
                            
        $highestBid = Bid::where('item_id', $item->id)->orderBy('amount', 'desc')->first();
        $myBid = Bid::where('item_id', $item->id)
                        ->where('user_id', $user->id)->orderBy('amount', 'desc')->first();
        return view('user.pages.item', compact('item', 'hasPaid', 'relatedItems', 'highestBid', 'myBid'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
