<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use app\Http\Controllers\Controller;
use App\Http\Requests\StoreBidItemRequest;
use App\Models\Bid;
use App\Models\Item;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use App\Events\BidPlaced;
use App\Models\FinalPayment;

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
                            ->where('auction_reference_id', $item->auction_reference_id)
                            ->orderBy('created_at', 'desc')
                            ->first();
  
        if(!$payment){
            return redirect()->back()->withErrors(['error' => 'You must pay Nu. 26,000 to bid on this item.']);
        }else if($payment->status != 'approved'){
            return redirect()->back()->with(['error' => 'Your payment is not yet approved. Please wait for approval before bidding.']);
        }

        $minBid = $item->current_bid + $item->reserve_price;
     
        if($request->amount < $minBid) {

            return back()->with(['error' => "The bid amount must be at least $minBid."]); 
        }

        $data = array_merge($request->validated(), ['bid_time' => now() ]);


        $bid = Bid::create($data);

        $item->current_bid = $request->amount;
        $item->save();
        
        $responseData = [
            'item_id' => $item->id,
            'highest_bid' => $bid->amount,
            'bidder' => $user->name, // or any other relevant user info
        ];

        broadcast(new BidPlaced($item, $bid))->toOthers();

        return $request->ajax()
            ? response()->json($responseData)
            : redirect()->back()->with('success', "Bidding added successfully.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        // Load the related images for the item (using eager loading to improve performance)
        $item->load('images'); // Assuming the relationship is defined in the Item model
        
        $activeBidder = Bid::where('item_id', $item->id)->distinct('user_id')->count();
        $user = Auth::user();
        $hasPaid = Payment::where('user_id', $user->id)
                    ->where('auction_reference_id', $item->auction_reference_id)        
                    ->where('status', 'approved')->exists();
    
        $finalPayment = FinalPayment::where('user_id', $user->id)
                                ->where('item_id', $item->id)
                                ->orderBy('created_at', 'desc')
                                ->first();
    
        $relatedItems = Item::with('images')
                            ->where('category_id', $item->category_id)
                            ->where('id', '!=', $item->id)
                            ->where('auction_reference_id', $item->auction_reference_id)
                            ->get();
    
        $highestBid = Bid::where('item_id', $item->id)->orderBy('amount', 'desc')->first();
        $highestBidder = $item->bids()->orderBy('amount', 'desc')->first();
        
        $payable = $highestBidder ? (0.25 * $highestBidder->amount) - 25000 : 0;
        
        $bidUser = $highestBidder ? $highestBidder->user : '';
        
        $myBid = $user ? Bid::where('item_id', $item->id)
                        ->where('user_id', $user->id)
                        ->orderBy('amount', 'desc')
                        ->first() : null;
    
        return view('user.pages.item', compact('item', 'hasPaid', 'relatedItems', 'highestBid', 'myBid', 
                        'user', 'bidUser', 'finalPayment', 'activeBidder', 'payable'));
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

    // public function store(StoreBidItemRequest $request)
    // {
    //     $user = Auth::user();
    //     $item = Item::findOrFail($request->item_id);

    //     $payment = Payment::where('user_id', $user->id)
    //                         ->first();
        
    //     if (!$payment) {
    //         $message = 'You must pay Nu. 26,000 to bid on this item.';
    //         return $request->ajax()
    //             ? response()->json(['error' => $message], 422)
    //             : redirect()->back()->withErrors(['payment' => $message]);
    //     } else if ($payment->status != 'approved') {
    //         $message = 'Your payment is not yet approved. Please wait for approval before bidding.';
    //         return $request->ajax()
    //             ? response()->json(['error' => $message], 422)
    //             : redirect()->back()->with(['error' => $message]);
    //     }

    //     $minBid = $item->current_bid + $item->reserve_price;

    //     if ($request->amount < $minBid) {
    //         $message = "The bid amount must be at least Nu. $minBid.";
    //         return $request->ajax()
    //             ? response()->json(['error' => $message], 422)
    //             : back()->with(['error' => $message]);
    //     }

    //     $data = array_merge($request->validated(), ['bid_time' => now()]);

    //     $bid = Bid::create($data);

    //     $item->current_bid = $request->amount;
    //     $item->save();

    //     $responseData = [
    //         'success' => "Bidding added successfully.",
    //         'myBid' => $bid->amount,
    //         'highestBid' => $item->current_bid,
    //     ];

    //     return $request->ajax()
    //         ? response()->json($responseData)
    //         : redirect()->back()->with('success', "Bidding added successfully.");
    // }
}
