<?php

namespace App\Http\Controllers\Admin;
 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\AuctionReference;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Support\Facades\Mail;
use App\Mail\AuctionStatusUpdateMail;
use App\Models\ItemImage;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(checkAdminAccess()) {
            $items = Item::all();
            return view('admin.pages.item.item',compact('items'));
        }
        return redirect("/");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(checkAdminAccess()) {
            $categories = Category::all();
            $auctionRefDates = AuctionReference::all();
            return view('admin.pages.item.addItem', compact('categories', 'auctionRefDates'));
        }
        return redirect("/");
    }


    public function store(Request $request)
{
    // Validate the input directly in the store method
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'starting_bid' => 'required|numeric|min:0',
        'current_bid' => 'nullable|numeric|min:0',
        'reserve_price' => 'required|numeric|min:0',
        'category_id' => 'required|exists:categories,id',
        'auction_reference_id' => 'required|exists:auction_references,id',
        'user_id' => 'required|exists:users,id',
        'status' => 'boolean',
        'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Validate multiple images
    ]);

    // Create the item
    $item = Item::create([
        'name' => $validated['name'],
        'description' => $validated['description'],
        'starting_bid' => $validated['starting_bid'],
        'current_bid' => $request->starting_bid,
        'reserve_price' => $validated['reserve_price'],
        'category_id' => $validated['category_id'],
        'auction_reference_id' => $validated['auction_reference_id'],
        'user_id' => $validated['user_id'],
        'status' => $request->has('status') ? 1 : 0,
    ]);

    // Handle multiple image uploads
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $file) {
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '-' . uniqid() . '.' . $extension;
            $path = 'uploads/item/';
            $file->move($path, $filename);

            // Save image paths in the item_images table
            ItemImage::create([
                'item_id' => $item->id,
                'image_path' => $path . $filename,
            ]);
        }
    }

    return redirect()->back()->with('success', 'Item created successfully!');
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
    public function edit(Item $item)
    {
        $categories = Category::all();
        $auctionRefDates = AuctionReference::all();
        return view('admin.pages.item.addItem', compact('item', 'categories', 'auctionRefDates'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        $validated = $request->validated();
    
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'uploads/item/';
            $file->move($path, $filename);
            $validated['image_path'] = $path . $filename;
        }
    
        // Ensure status is set to 0 if it's not present in the request
        $validated['status'] = $request->has('status') ? 1 : 0;
    
        // Check if the status is set to '0' (closed)
        if ($validated['status'] == 0) {
            $item->update($validated); // Update item details including status
    
            // Fetch the highest bid for the item
            $highestBid = $item->bids()->where('status', 'bidding stage')->orderBy('amount', 'desc')->first();
    
            if ($highestBid) {
                // Update highest bid status to 'wins in Bidding'
                $highestBid->update(['status' => 'wins in Bidding']);
    
                // Send email to the user who placed the highest bid
                $user = $highestBid->user;
                Mail::to($user->email)->send(new AuctionStatusUpdateMail($user, $item));
    
                // Update other bids' status to 'loose in Bidding'
                $item->bids()->where('id', '!=', $highestBid->id)->update(['status' => 'loose in Bidding']);
            }
    
            return redirect()->route('item.index')->with('success', 'Item updated and auction closed successfully!');
        } else {
            // Update item details without changing bid statuses if status is not '0'
            $item->update($validated);
    
            return redirect()->route('item.index')->with('success', 'Item updated successfully!');
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        // Check if the item has a non-null and non-empty image path
        if (!empty($item->image_path)) {
            // Construct the full file path
            $filePath = public_path($item->image_path);
    
            // Check if the file exists before attempting deletion
            if (file_exists($filePath)) {
                // Attempt to delete the file
                if (!unlink($filePath)) {
                    // Log the failure to delete the file
                    dd("Failed to delete file at path: $filePath");
                    return redirect()->route('items.index')->with('error', 'Failed to delete image file.');
                }
            } else {
                // Log that the file does not exist
                dd("File does not exist at path: $filePath");
            }
        } else {
            // Log that there was no image path provided
           
        }
    
        // Delete the item record from the database
        $item->delete();
    
        // Redirect with a success message
        return redirect()->route('item.index')->with('success', 'Item deleted successfully!');
    }
    
    
    
}
