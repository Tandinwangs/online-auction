<?php

namespace App\Http\Controllers\Admin;
 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Category;
use App\Models\Item;

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
            return view('admin.pages.item.addItem', compact('categories'));
        }
        return redirect("/");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemRequest $request)
    {
        $validated = $request->validated();
      
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $extention = $file->getClientOriginalExtension();

        $filename = time().'.'.$extention;
        $path = 'uploads/item/';
        $file->move($path, $filename);
        $validated['image_path'] = $path.$filename;
        // $validated['image_path'] = $request->file('image')->store('images', 'public');
    }

    Item::create($validated);

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
        return view('admin.pages.item.addItem', compact('item', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
    
            $filename = time().'.'.$extention;
            $path = 'uploads/item/';
            $file->move($path, $filename);
            $validated['image_path'] = $path.$filename;
            // $validated['image_path'] = $request->file('image')->store('images', 'public');
        }
    
        $item->update($validated);
        return redirect()->route('item.index')->with('success', 'Item updated successfully!');
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
