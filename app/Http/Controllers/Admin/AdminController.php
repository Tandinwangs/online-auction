<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bid;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Item;
use App\Models\Payment;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if(checkAdminAccess()) {
            $filter = $request->get('filter', 'year'); // Default to 'year' if no filter is selected

            switch ($filter) {
                case 'today':
                    $startDate = now()->startOfDay();
                    break;
                case 'month':
                    $startDate = now()->startOfMonth();
                    break;
                case 'year':
                default:
                    $startDate = now()->startOfYear();
                    break;
            }
        

            $startOfDay = now()->startOfDay();
            $startOfMonth = now()->startOfMonth();
            $startOfYear = now()->startOfYear();

            // Bids and Revenue for Today
            $bidsToday = Bid::where('created_at', '>=', $startOfDay)->count();
            $revenueToday = Bid::where('created_at', '>=', $startOfDay)
                ->groupBy('item_id')
                ->select(DB::raw('MAX(amount) as max_amount'))
                ->get()
                ->sum('max_amount');
            
            // Bids and Revenue for This Month
            $bidsThisMonth = Bid::where('created_at', '>=', $startOfMonth)->count();
            $revenueThisMonth = Bid::where('created_at', '>=', $startOfMonth)
                ->groupBy('item_id')
                ->select(DB::raw('MAX(amount) as max_amount'))
                ->get()
                ->sum('max_amount');
            
            // Bids and Revenue for This Year
            $bidsThisYear = Bid::where('created_at', '>=', $startOfYear)->count();
            $revenueThisYear = Bid::where('created_at', '>=', $startOfYear)
                ->groupBy('item_id')
                ->select(DB::raw('MAX(amount) as max_amount'))
                ->get()
                ->sum('max_amount');
        
                $recentActivities = [];

                // Get recent bids
                $recentBids = Bid::where('created_at', '>=', now()->subMonth())->orderBy('created_at', 'desc')->limit(2)->get();
                foreach ($recentBids as $bid) {
                    $recentActivities[] = [
                        'time' => $bid->created_at->diffForHumans(),
                        'type' => 'Bid',
                        'message' => "Bid of {$bid->amount} on item {$bid->item->name}",
                    ];
                }
            
                // Get recent payments
                $recentPayments = Payment::where('created_at', '>=', now()->subMonth())->orderBy('created_at', 'desc')->limit(2)->get();
                foreach ($recentPayments as $payment) {
                    $recentActivities[] = [
                        'time' => $payment->created_at->diffForHumans(),
                        'type' => 'Payment',
                        'message' => "Payment made for reference {$payment->auctionReference->auction_reference_date}",
                    ];
                }
            
                // Sort by most recent
                usort($recentActivities, function($a, $b) {
                    return strtotime($b['time']) - strtotime($a['time']);
                });

                $startOfYear = Carbon::now()->startOfYear();
                $endOfYear = Carbon::now()->endOfYear();
                $startOfLastYear = Carbon::now()->subYear()->startOfYear();
                $endOfLastYear = Carbon::now()->subYear()->endOfYear();

                $pendingCount = Payment::where('status', 'pending')
                                        ->whereBetween('created_at', [$startOfYear, $endOfYear])
                                        ->count();

                $rejectedCount = Payment::where('status', 'rejected')
                                        ->whereBetween('created_at', [$startOfYear, $endOfYear])
                                        ->count();

                $approvedCount = Payment::where('status', 'approved')
                                        ->whereBetween('created_at', [$startOfYear, $endOfYear])
                                        ->count();
                
                $totalItemThisYear = Item::whereBetween('created_at', [$startOfYear, $endOfYear])->count();
                $totalItemLastYear = Item::whereBetween('created_at', [$startOfLastYear, $endOfLastYear])->count();

                if ($totalItemLastYear > 0) {
                    // Normal percentage increase calculation
                    $percentageIncrease = (($totalItemThisYear - $totalItemLastYear) / $totalItemLastYear) * 100;
                } elseif ($totalItemLastYear == 0 && $totalItemThisYear > 0) {
                    // If no items last year but items added this year
                    $percentageIncrease = 100; // or any other value you consider appropriate to represent a significant increase
                } else {
                    // No items last year and no items this year
                    $percentageIncrease = 0;
                }


            $recentItems = Item::orderBy('created_at', 'desc')->limit(5)->get();

            $totalUser = User::whereHas('roles', function($query) {
                $query->where('name', 'user');
            })->where('created_at', '>=', $startDate)->count();

            $totalUserThisYear = User::whereBetween('created_at', [$startOfYear, $endOfYear])->whereHas('roles', function($query) {
                $query->where('name', 'user');
            })->count();

            // Get the total number of users added last year
            $totalUserLastYear = User::whereBetween('created_at', [$startOfLastYear, $endOfLastYear])->whereHas('roles', function($query) {
                $query->where('name', 'user');
            })->count();

            if ($totalUserLastYear > 0) {
                $percentageIncreaseUsers = (($totalUserThisYear - $totalUserLastYear) / $totalUserLastYear) * 100;
            } elseif ($totalUserLastYear == 0 && $totalUserThisYear > 0) {
                $percentageIncreaseUsers = 100;
            } else {
                $percentageIncreaseUsers = 0;
            }


            return view('admin.pages.dashboard', compact('totalItemThisYear',  'totalUser', 'filter',
             'bidsToday', 'revenueToday', 'bidsThisMonth', 'revenueThisMonth', 
             'bidsThisYear', 'revenueThisYear', 'recentActivities', 'recentItems',
            'pendingCount', 'rejectedCount', 'approvedCount', 'percentageIncrease', 'percentageIncreaseUsers'
            ));
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

    public function getRecentActivities($filter = 'today')
    {
        $query = [];

        if ($filter == 'today') {
            $startOfDay = now()->startOfDay();
            $query = [
                'bids' => Bid::where('created_at', '>=', $startOfDay)->latest()->take(5)->get(),
                'users' => User::where('created_at', '>=', $startOfDay)->latest()->take(5)->get(),
                'items' => Item::where('created_at', '>=', $startOfDay)->latest()->take(5)->get(),
            ];
        } elseif ($filter == 'month') {
            $startOfMonth = now()->startOfMonth();
            $query = [
                'bids' => Bid::where('created_at', '>=', $startOfMonth)->latest()->take(5)->get(),
                'users' => User::where('created_at', '>=', $startOfMonth)->latest()->take(5)->get(),
                'items' => Item::where('created_at', '>=', $startOfMonth)->latest()->take(5)->get(),
            ];
        } elseif ($filter == 'year') {
            $startOfYear = now()->startOfYear();
            $query = [
                'bids' => Bid::where('created_at', '>=', $startOfYear)->latest()->take(5)->get(),
                'users' => User::where('created_at', '>=', $startOfYear)->latest()->take(5)->get(),
                'items' => Item::where('created_at', '>=', $startOfYear)->latest()->take(5)->get(),
            ];
        }

        return response()->json($query);
    }
}
