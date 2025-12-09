<?php

namespace App\Http\Controllers;

use App\Models\OtherItem;
use App\Models\SerialNumber;
use Illuminate\Http\Request;

class SerialNumberController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string',
            'returnable_item_id' => 'required', // Ensure the item exists
        ]);

        $unitCode = new SerialNumber();
        $unitCode->serial_number = $validated['code'];
        $unitCode->otherItem_id = $validated['returnable_item_id'];
        $unitCode->purchase_status_id = 1;  
        $unitCode->save();

        return response()->json($unitCode);  // Return the saved unit code
    }

    // Get all unit codes for the current item
    public function index(Request $request)
    {
        $itemId = $request->input('other_item_id');  
        
        if (!$itemId) {
            return response()->json(['error' => 'Item ID is required'], 400);  // Return error if no item_id is provided
        }

        $unitCodes = SerialNumber::where('otherItem_id', $itemId)->get();
        return response()->json($unitCodes);  // Return the unit codes as JSON
    }


    // Delete a unit code
    public function destroy($id)
    {
        $unitCode = SerialNumber::findOrFail($id);
        $unitCode->delete();
        return response()->json(['message' => 'Serial Number deleted successfully']);
    }

}
