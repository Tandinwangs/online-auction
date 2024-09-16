<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use app\Http\Controllers\Controller;
use App\Models\AuctionReference;
use App\Models\Bid;
use App\Models\Item;

class BidController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(checkAdminAccess()) {
            $refDates = AuctionReference::all();
            $bids = Bid::all();
            $items = Item::all();
            return view('admin.pages.bids.bids', compact('bids', 'items', 'refDates'));
        }
        return redirect("/");
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

    public function getItemsByrefDate($refDate)
    {
        $refID = AuctionReference::where('auction_reference_date', $refDate)->value('id');
        $items = Item::where('auction_reference_id', $refID)->get();
        // return response()->json(['items' => $items]); 
    }
}
