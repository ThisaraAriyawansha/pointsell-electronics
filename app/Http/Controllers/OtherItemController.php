<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OtherItem;
use App\Models\SerialNumber;
use App\Models\OtherItemBrand;
use App\Models\OtherItemCategory;
use App\Models\OtherItemType;
use Illuminate\Support\Str;

class OtherItemController extends Controller
{
    public function otheritem()
    {
        return view('otherItem.otherItem');
    }

    public function addotherItem()
    {
        $brands = OtherItemBrand::all();
        $categories = OtherItemCategory::all();
        $types = OtherItemType::all();
    
        return view('otherItem.addotherItem', compact('brands', 'categories', 'types'));
    }
    

    

    public function viewotherItem(Request $request)
    {
        // Get search query from the request (if exists)
        $search = $request->input('search_cat', '');
    
        // Fetch the OtherItem data with pagination, filtered by item name
        $mobileItems = OtherItem::where('name', 'like', '%' . $search . '%')
                                 ->withCount('serialNumbers') // Get count of serialNumbers
                                 ->paginate(10);
    
        // Return the data to the Blade view
        return view('otherItem.viewotherItem', compact('mobileItems'));
    }
    
    

    public function updateStatus(Request $request)
    {
        $RItem = OtherItem::findOrFail($request->id);
        
        // Toggle the status_id between 1 and 2
        $newStatus = ($RItem->status_id == 1) ? 2 : 1;
        $RItem->status_id = $newStatus;
    
        $RItem->save();
    
        return response()->json(['status' => $newStatus]);
    }
    



    
}
