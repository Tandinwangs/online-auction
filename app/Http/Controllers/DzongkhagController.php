<?php

namespace App\Http\Controllers;

use App\Models\Dzongkhag;
use Illuminate\Http\Request;
use App\Models\Gewog;
use App\Models\Village;

class DzongkhagController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Dzongkhag $dzongkhag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dzongkhag $dzongkhag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dzongkhag $dzongkhag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dzongkhag $dzongkhag)
    {
        //
    }

    public function getGewogs($dzongcode)
    {
        $gewogs = Gewog::where('dzongcode', $dzongcode)->get();
        return response()->json($gewogs);
    }

    public function getVillages($gewogcode)
    {
        $villages = Village::where('gewocode', $gewogcode)->get();
        return response()->json($villages);
    }
}
