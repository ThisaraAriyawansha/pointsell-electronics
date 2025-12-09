<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Modell;
use App\Models\Color;
use App\Models\Storage;
use App\Models\Ram;
use App\Models\Distributor;
use App\Models\Dealer;
use App\Models\Agent;

class BrandController extends Controller
{
    public function save(Request $request)
{
    $type = $request->input('type');
    $value = trim($request->input('value')); // Trim to avoid leading/trailing spaces

    try {
        $modelClass = null;

        switch ($type) {
            case 'brand':
                $modelClass = Brand::class;
                break;
            case 'model':
                $modelClass = Modell::class;
                break;
            case 'color':
                $modelClass = Color::class;
                break;
            case 'storage':
                $modelClass = Storage::class;
                break;
            case 'ram':
                $modelClass = Ram::class;
                break;
            case 'distributor':
                $modelClass = Distributor::class;
                break;
            case 'dealer':
                $modelClass = Dealer::class;
                break;
            case 'agent':
                $modelClass = Agent::class;
                break;
            default:
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid type'
                ]);
        }

        // Check if the record already exists
        if ($modelClass::where('name', $value)->exists()) {
            return response()->json([
                'success' => false,
                'message' => ucfirst($type) . ' already exists'
            ]);
        }

        // Create the new entry
        $item = $modelClass::create(['name' => $value]);

        return response()->json([
            'success' => true,
            'id' => $item->id,
            'message' => ucfirst($type) . ' added successfully'
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ]);
    }
}



    // Method to fetch items based on type
    public function fetchItems($type)
    {
        $items = [];
        
        switch ($type) {
            case 'brand':
                $items = Brand::all();
                break;
            case 'model':
                $items = Modell::all();
                break;
            case 'color':
                $items = Color::all();
                break;
            case 'storage':
                $items = Storage::all();
                break;
            case 'ram':
                $items = Ram::all();
                break;
            case 'distributor':
                $items = Distributor::all();
                break;
            case 'dealer':
                $items = Dealer::all();
                break;
            case 'agent':
                $items = Agent::all();
                break;
            default:
                return response()->json(['success' => false, 'message' => 'Invalid type']);
        }
        
        return response()->json([
            'items' => $items
        ]);
    }

    // Method to remove an item by type and id
    public function removeItem($type, $id)
    {
        try {
            switch ($type) {
                case 'brand':
                    $item = Brand::findOrFail($id);
                    break;
                case 'model':
                    $item = Modell::findOrFail($id);
                    break;
                case 'color':
                    $item = Color::findOrFail($id);
                    break;
                case 'storage':
                    $item = Storage::findOrFail($id);
                    break;
                case 'ram':
                    $item = Ram::findOrFail($id);
                    break;
                case 'distributor':
                    $item = Distributor::findOrFail($id);
                    break;
                case 'dealer':
                    $item = Dealer::findOrFail($id);
                    break;
                case 'agent':
                    $item = Agent::findOrFail($id);
                    break;
                default:
                    return response()->json(['success' => false, 'message' => 'Invalid type']);
            }
    
            $item->delete();
    
            return response()->json(['success' => true, 'message' => ucfirst($type) . ' deleted successfully']);
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            \Log::error('Error deleting item: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
        }
    }
    
}