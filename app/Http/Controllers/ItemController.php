<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Item;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\Item_categorie;




class ItemController extends Controller
{
    public function item()
    {
        return view('item.item');
    }

    public function importItem()
    {
        return view('item.importItem');
    }

    public function item_list(Request $request)
    {
        $search = $request->input('search');
    
        $query = Item::query();
    
        if ($search) {
            $query->whereRaw('LOWER(item_name) LIKE ?', ['%' . strtolower($search) . '%'])
                  ->orWhereRaw('LOWER(item_code) LIKE ?', ['%' . strtolower($search) . '%']);
        }
    
        $items = $query->paginate(10);
    
        return view('item.item_list', ['items' => $items, 'search' => $search]);
    }
    
    
    
    public function item_Add()
    {
        $categories=Item_categorie::all();
        $suppliers = Supplier::all();
        return view('item.add_item', compact('suppliers','categories'));
    }
    private function generateUniqueItemCode()
    {
        do {
            $code = str_pad(random_int(0, 99999), 5, '0', STR_PAD_LEFT);
        } while (Item::where('item_code', $code)->exists());

        return $code;
    }
     // Validate if the item code exists in the database
     public function validateItemCode($code)
    {
        $item = Item::where('item_code', $code)->first();

        if ($item) {
            return response()->json([
                'valid' => true,
                'item_code' => $item->item_code,
                'item_name' => $item->item_name,
                'quantity' => $item->quantity,
                'purchase_price' => $item->purchase_price,
                'retail_price' => $item->retail_price,
                'wholesale_price' => $item->wholesale_price,
            ]);
        }

        return response()->json(['valid' => false]);
    }
    
    public function item_Insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'item_name' => 'required',
            'quantity' => 'required|integer',
            'minimum_qty' => 'required|integer',
            'suppliers_id' => [
                'integer',
                'required',
                function ($attribute, $value, $fail) {
                    if ($value == -1) {
                        $fail('Please select supplier.');
                    }
                },
            ],
            'purchase_price' => 'required|numeric',  // Allow decimals
            'retail_price' => 'required|numeric',    // Allow decimals
            'wholesale_price' => 'required|numeric', // Allow decimals
        ], [
            'quantity.required' => 'The Quantity must be an integer.',
            'minimum_qty.required' => 'The Minimum Qty must be an integer.',
            'purchase_price.required' => 'The Purchase Price must be a valid number.',
            'retail_price.required' => 'The Retail Price must be a valid number.',
        ]);
        

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422); // 422 Unprocessable Entity status code for validation errors
        }
        $save = new Item;

        $save->item_code = $this->generateUniqueItemCode(); // Auto-generate the item code
        $save->item_name = $request->item_name;
        $save->suppliers_id = $request->suppliers_id;
        $save->quantity = $request->quantity;
        $save->start_qty = $request->quantity;
        $save->minimum_qty = $request->minimum_qty;
        $save->purchase_price = $request->purchase_price;
        $save->retail_price = $request->retail_price;
        $save->status_id = 1;
        $save->wholesale_price = $request->wholesale_price;
        if (!empty($request->file('image_path'))) {
            $ext = $request->file('image_path')->getClientOriginalExtension();
            $file = $request->file('image_path');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/item/', $filename);
            $save->image_path = $filename;
        }
        $save->item_category_id = $request->category_id;

        $save->save();
        return response()->json(['message' => 'Item created successfully!']);

    }

    //view for edit
    public function edit($id)
    {
        $item = Item::findOrFail($id);
        $suppliers = Supplier::all();
        $categories=Item_categorie::all();
        return view('item.edit_item', compact('item', 'suppliers','categories'));
    }

    public function update($id, Request $request)
    {
        $item = Item::getSingle($id);
        $item->item_name = trim($request->item_name);
        $item->suppliers_id = trim($request->suppliers_id);
        $item->quantity = trim($request->quantity);
        $item->minimum_qty = trim($request->minimum_qty);
        $item->purchase_price = trim($request->purchase_price);
        $item->retail_price = trim($request->retail_price);
        $item->wholesale_price = trim($request->wholesale_price);
        $item->item_category_id = $request->category_id ? trim($request->category_id) : null; // Allow NULL

        if (!empty($request->file('image_path'))) {
            // Check if the current image exists and is not the default image
            if (!empty($item->image_path) && $item->image_path !== 'default.png') {
                $imagePath = public_path('upload/item/' . $item->image_path);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
    
            // Upload new image
            $file = $request->file('image_path');
            $ext = $file->getClientOriginalExtension();
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/item/', $filename);
            $item->image_path = $filename;
        }
    
        // If no image was uploaded, set default image if it's null
        if (empty($item->image_path)) {
            $item->image_path = 'default.png';
        }
    
        $item->save();
    
        return redirect()->back()->with('success', 'Item successfully updated');
    }
    
    public function delete($id)
    {
        $item = Item::findOrFail($id);

        // If an image exists, delete it from the server
        if ($item->image_path && file_exists(public_path('upload/item/' . $item->image_path))) {
            unlink(public_path('upload/item/' . $item->image_path));
        }

        // Delete the item from the database
        $item->delete();

        return redirect('item/item_list')->with('success', "Item successfully delete");
    }


    public function importItems(Request $request)
{
    $items = $request->input('items');
    
    if (!$items || !is_array($items)) {
        return response()->json(['success' => false, 'message' => 'Invalid data.'], 400);
    }

    $inserted = 0;
    $skipped = 0;

    foreach ($items as $item) {
        // Check for duplicate item_code
        if (isset($item['item_code']) && Item::where('item_code', $item['item_code'])->exists()) {
            $skipped++;
            continue; // Skip this row if duplicate
        }

        // Insert the item if no duplicate found
        Item::create([
            'item_code' => $item['item_code'] ?? null,
            'item_name' => $item['item_name'] ?? null,
            'quantity' => $item['quantity'] ?? 0,
            'supplier_id' => $item['supplier_id'] ?? null,
            'min_qty' => $item['min_qty'] ?? 0,
            'purchase_price' => $item['purchase_price'] ?? 0,
            'retail_price' => $item['retail_price'] ?? 0,
            'wholesale_price' => $item['wholesale_price'] ?? 0,
            'status_id' => $item['status_id'] ?? null,
        ]);

        $inserted++;
    }

    return response()->json([
        'success' => true,
        'message' => "Items imported successfully.",
        'details' => [
            'inserted' => $inserted,
            'skipped' => $skipped,
        ]
    ]);
}




public function toggleItemStatus($id)
{
    try {
        $item = Item::findOrFail($id);
        
        // Toggle the status_id between 1 (Active) and 2 (Inactive)
        $item->status_id = $item->status_id == 1 ? 2 : 1;
        
        // Save the updated user
        $item->save();

        return response()->json(['status_id' => $item->status_id]);

    } catch (\Exception $e) {
        // Log the exception for debugging
        \Log::error('Error toggling item status: ' . $e->getMessage());
        \Log::error($e->getTraceAsString());

        // Return a JSON response with error information
        return response()->json(['error' => 'Something went wrong. Please try again later.'], 500);
    }
}
}