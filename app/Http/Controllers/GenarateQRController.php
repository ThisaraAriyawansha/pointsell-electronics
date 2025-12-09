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
use App\Models\ItemSubcategory;
use Illuminate\Support\Facades\Auth;



class GenarateQRController extends Controller
{
    public function genarate(Request $request)
    {
        $search = $request->input('search');
    
        $query = Item::query(); // Fetch all items without branch filtering
    
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(item_name) LIKE ?', ['%' . strtolower($search) . '%'])
                  ->orWhereRaw('LOWER(item_code) LIKE ?', ['%' . strtolower($search) . '%']);
            });
        }
    
        $items = $query->paginate(10);
    
        return view('item.item_genarate', ['items' => $items, 'search' => $search]);
    }
    

    public function showItemDetails($itemCode)
    {
        // Fetch item details from database based on item code
        $item = Item::where('item_code', $itemCode)->first();

        // Check if item exists
        if (!$item) {
            return abort(404, 'Item not found');
        }

        // Return the item details view with item data
        return view('item.item-details', compact('item'));
    }

}