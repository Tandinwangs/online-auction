<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AuctionReference;
use App\Models\Item;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($auction_reference_date = null)
    {
        if ($auction_reference_date) {
            // Fetch items based on the auction_reference_date
            $items = Item::with('images')->whereHas('auctionReference', function ($query) use ($auction_reference_date) {
                $query->where('auction_reference_date', $auction_reference_date);
            })->get();
        } else {
            // If no reference date is provided, you can fetch all items or return a default view
            $items = Item::with('images')->get();
        }
        
        // Fetch recent references for the dropdown
        $recentReferences = AuctionReference::latest('created_at')->take(5)->get();
        return view('user.pages.index', compact('items', 'recentReferences', 'auction_reference_date')); 
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
}
