<?php

namespace App\Http\Controllers;

use App\Models\Hold_order_item;
use Illuminate\Http\Request;
use App\Models\Hold_order;
use Illuminate\Support\Facades\Log;

class HoldOrderController extends Controller
{
    public function store(Request $request)
    {
        $holdOrder = Hold_order::create([
            'customers_id' => 1, // Optional field
            'users_id' => 1, // Assuming authenticated user
            'hold_reference' => $request->name,
            'hold_status' => "ACTIVE",
        ]);

        $items = $request->items;

        // Prepare sales items for insertion
        $holdItems = collect($items)->map(function ($item) use ($holdOrder) {
            return [
                'users_id' => 1,
                'items_id' => $item['id'],
                'hold_orders_id' =>$holdOrder->id,
                'quantity' => $item['addQuantity'],
                'discount' => 10,
                'discount_type' => "FIXED",
            ];
        });

        // Insert into sales_items table
        $Hold_order_item = Hold_order_item::insert($holdItems->toArray());
        // Return a success response
        return response()->json([
            'success' => true,
            'message' => 'Payment and Sale successfully recorded.',
            'hold_orders_id' => $holdOrder->id,
        ]);

    }
    // Get all hold orders
    public function getHoldOrders()
    {
        $holdOrders = Hold_order::with('items')->get(); // Get hold orders along with their items
        return response()->json($holdOrders);
    }

    // Delete a specific hold order
    public function deleteHoldOrder($id)
    {
        $holdOrder = Hold_order::find($id);

        if (!$holdOrder) {
            return response()->json(['error' => 'Hold order not found.'], 404);
        }

        // Delete the related items first
        Hold_order_item::where('hold_orders_id', $id)->delete();

        // Delete the hold order
        $holdOrder->delete();

        return response()->json(['success' => 'Hold order deleted successfully.']);
    }
    public function getHoldOrder($id)
    {
        $holdOrder = HoldOrder::find($id);
        if ($holdOrder) {
            $items = $holdOrder->items; // Assuming you have a relationship set up
            return response()->json(['items' => $items]);
        }
    
        return response()->json(['error' => 'Hold order not found'], 404);
    }
}

