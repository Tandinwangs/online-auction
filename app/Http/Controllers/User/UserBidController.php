<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use app\Http\Controllers\Controller;
use App\Http\Requests\StoreBidItemRequest;
use App\Models\Bid;
use App\Models\Item;


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
        $item = Item::findOrFail($request->item_id);

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
        return view('user.pages.item', compact('item'));
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
