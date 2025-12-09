<?php

namespace App\Http\Controllers;
use App\Models\Item;
use App\Models\Stock_update;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    public function stock()
    {
        $items = Item::all();
        return view('stock.viewStock', ['items' => $items]);
    }

    public function addStock()
    {
        return view('stock.addStock');
    }

    public function updateStock($id)
    {
        // Retrieve the specific item by ID
        $item = Item::find($id);
    
        // Check if the item exists
        if (!$item) {
            return redirect()->back()->with('error', 'Item not found.');
        }
    
        // Retrieve stock update records where items_id matches the given ID
        $stockUpdates = Stock_update::where('items_id', $id)->get();
    
        // Pass the item and stock updates to the view
        return view('stock.updateStock', [
            'item' => $item,
            'stockUpdates' => $stockUpdates
        ]);
    }
    

    public function storeStockUpdate(Request $request)
    {
        // Validate Input
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
            'note' => 'required|string|max:255',
        ]);

        // Find Item (Ensure $item_id is passed as hidden input)
        $itemId = $request->input('item_id'); // Assuming you're passing the item's ID
        $item = Item::find($itemId);

        if (!$item) {
            return redirect()->back()->with('error', 'Item not found.');
        }

        // Insert into Stock_update table
        $stockUpdate = new Stock_update();
        $stockUpdate->user_id = Auth::id(); // Logged-in user's ID
        $stockUpdate->items_id = $itemId;
        $stockUpdate->stock = $validated['quantity'];
        $stockUpdate->status = 1; // Default status
        $stockUpdate->note = $validated['note'];
        $stockUpdate->save();

        // Update Item Quantity
        $item->quantity += $validated['quantity'];
        $item->save();

        // Success Response
        return redirect()->back()->with('success', 'Stock updated successfully.');
    }

    
}