<?php

namespace App\Http\Controllers;

use App\Models\MobileImei;
use Illuminate\Http\Request;

class MobileImeiController extends Controller
{
    public function getImei($mobileItemId)
    {
        $imeis = MobileImei::where('mobile_item_id', $mobileItemId)->get();

        return response()->json($imeis);
    }

    public function updateStatus(Request $request, $imeiId)
    {
        try {
            $imei = MobileImei::findOrFail($imeiId);
            $imei->purchase_status_id = $request->purchase_status_id;
            $imei->save();

            return response()->json(['success' => true, 'message' => 'Status updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error updating status: ' . $e->getMessage()], 500);
        }
    }



    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'imei' => 'required|string|unique:mobile_imeis,imei_number',
            'mobile_item_id' => 'required|exists:mobile_items,id',
        ]);

        // Insert IMEI into the database
        MobileImei::create([
            'mobile_item_id' => $request->mobile_item_id,
            'imei_number' => $request->imei,
            'purchase_status_id' => 1, 
        ]);

        return response()->json(['success' => true, 'message' => 'IMEI added successfully']);
    }


    public function destroy($imeiId)
    {
        $imei = MobileImei::find($imeiId);

        if (!$imei) {
            return response()->json(['success' => false, 'message' => 'IMEI not found']);
        }

        $imei->delete();

        return response()->json(['success' => true, 'message' => 'IMEI deleted successfully']);
    }

}
