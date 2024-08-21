<?php

namespace App\Http\Controllers\Admin;

use App\Models\AuctionReference;
use Illuminate\Http\Request;
use app\Http\Controllers\Controller;

class AuctionReferenceController extends Controller
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
    public function store(Request $request)
    {
        $request->validate([
            'auction_reference_date' => 'required|date'
        ]);

        
        $auctionReference = new AuctionReference();
        $auctionReference->auction_reference_date = $request->input('auction_reference_date');
        $auctionReference->save();

        return redirect()->back()->with('success', 'Auction reference date addedd successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(AuctionReference $auctionReference)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AuctionReference $auctionReference)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AuctionReference $auctionReference)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AuctionReference $auctionReference)
    {
        //
    }
}
