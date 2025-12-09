<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OtherItem;
use App\Models\SerialNumber;
use App\Models\OtherItemBrand;
use App\Models\OtherItemCategory;
use App\Models\OtherItemType;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OtherItemDataController extends Controller
{

    public function save(Request $request)
    {
        $type = $request->input('type');
        $value = trim($request->input('value')); // Trim to avoid leading/trailing spaces
    
        try {
            $modelClass = null;
    
            switch ($type) {
                case 'brand':
                    $modelClass = OtherItemBrand::class;
                    break;
                case 'category':
                    $modelClass = OtherItemCategory::class;
                    break;
                case 'type':
                    $modelClass = OtherItemType::class;
                    break;
                default:
                    return response()->json([
                        'success' => false,
                        'message' => 'Invalid type'
                    ]);
            }
    
            // Check if the record already exists (without branch_id)
            if ($modelClass::where('name', $value)->exists()) {
                return response()->json([
                    'success' => false,
                    'message' => ucfirst($type) . ' already exists'
                ]);
            }
    
            // Create the new entry
            $item = $modelClass::create([
                'name' => $value,
            ]);
    
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
    




    public function fetchItems($type)
    {
        $items = [];

        // Determine the model based on the type
        switch ($type) {
            case 'brand':
                $modelClass = OtherItemBrand::class;
                break;
            case 'category':
                $modelClass = OtherItemCategory::class;
                break;
            case 'type':
                $modelClass = OtherItemType::class;
                break;
            default:
                return response()->json(['success' => false, 'message' => 'Invalid type']);
        }

        // Retrieve the items from the respective model
        $items = $modelClass::all(); // Fetch all records from the corresponding table

        // Return the items in the response
        return response()->json([
            'success' => true,  // Indicate success
            'items' => $items   // Return the fetched items
        ]);
    }


        public function removeotheritem($type, $id)
        {
            try {
                // Determine the correct model class based on the type
                switch ($type) {
                    case 'brand':
                        $modelClass = OtherItemBrand::class;
                        break;
                    case 'category':
                        $modelClass = OtherItemCategory::class;
                        break;
                    case 'type':
                        $modelClass = OtherItemType::class;
                        break;
                    default:
                        return response()->json(['success' => false, 'message' => 'Invalid type']);
                }

                // Fetch the item using the model's find() method
                $item = $modelClass::find($id);
                
                if (!$item) {
                    return response()->json(['success' => false, 'message' => ucfirst($type) . ' not found']);
                }

                // Delete the item
                $item->delete();

                // Return success response
                return response()->json(['success' => true, 'message' => ucfirst($type) . ' deleted successfully']);
            } catch (\Exception $e) {
                // Log the error for debugging purposes
                \Log::error('Error deleting item: ' . $e->getMessage());
                return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
            }
        }




        public function saveOtherItemAndSerialNumbers(Request $request)
        {
            DB::beginTransaction();
            
            try {
                // Validate the input data
                $data = $request->validate([
                    'name' => 'required|string|max:255',
                    'brand_id' => 'required',
                    'category_id' => 'required',
                    'type_id' => 'required',
                    'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:10240',
                    'unit_codes' => 'required|string',
                    'purchase_price' => 'required|numeric|min:1',
                    'retails_price' => 'required|numeric|min:1',
                    'wholesale_price' => 'required|numeric|min:1',
                ]);
        
                // Decode the unit_codes from JSON string to array
                $unitCodes = json_decode($data['unit_codes'], true);
                
                if (json_last_error() !== JSON_ERROR_NONE) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Invalid unit codes format.'
                    ], 400);
                }
        
                if (empty($unitCodes)) {
                    return response()->json([
                        'success' => false,
                        'message' => 'At least one unit code is required.'
                    ], 400);
                }
        
                $unitCodes = array_map(function ($code) {
                    return $code['unitCode'];
                }, $unitCodes);
        
                Log::info('Final unit_codes:', ['unit_codes' => $unitCodes]);
        
                // Create the item
                $item = new OtherItem();
                $item->name = $data['name'];
                $item->otherItem_brand_id = $data['brand_id'];
                $item->otherItem_category_id = $data['category_id'];
                $item->otherItem_type_id = $data['type_id'];
                $item->purchase_price = $data['purchase_price'];
                $item->retail_price = $data['retails_price']; // Note: Model uses singular
                $item->wholesale_price = $data['wholesale_price'];
                $item->status_id = 1; // Default status
        
                // Handle image upload
                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $imageName = Str::random(20) . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('OtherItem'), $imageName);
                    $imagePath = 'OtherItem/' . $imageName;
                    $item->image_path = $imagePath;
                }
        
                $item->save();
        
                // Save serial numbers
                foreach ($unitCodes as $code) {
                    $unitNumber = new SerialNumber();
                    $unitNumber->otherItem_id = $item->id;
                    $unitNumber->serial_number = $code;
                    $unitNumber->purchase_status_id = 1; // Default status
                    $unitNumber->save();
                }
        
                DB::commit();
        
                return response()->json([
                    'success' => true,
                    'item' => $item,
                    'message' => 'Item saved successfully!'
                ]);
        
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Detailed error saving item', [
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'trace' => $e->getTraceAsString(),
                    'request_data' => $request->except(['image']) // Exclude binary image data
                ]);
                
                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred while saving the item.',
                    'error_details' => env('APP_DEBUG') ? $e->getMessage() : null
                ], 500);
            }
        }

        public function editOItem($id)
        {
            $RItem = OtherItem::findOrFail($id);
    
            $brands = OtherItemBrand::all();
            $categories = OtherItemCategory::all();
            $types = OtherItemType::all();
            
            return view('otherItem.otherItemedit', compact('brands','categories', 'types' ,'RItem'));;
        }



        public function update(Request $request, $id)
        {
            // Debugging: Log the incoming request data
            \Log::info('Update Request Data:', $request->all());
        
            // Validate incoming data
            $request->validate([
                'name' => 'required|string|max:255',
                'brand_id' => 'required',
                'category_id' => 'required',
                'type_id' => 'required',
                'purchase_price' => 'required|numeric|min:1',
                'retails_price' => 'required|numeric|min:1',
                'wholesale_price' => 'required|numeric|min:1',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
        
            $item = OtherItem::findOrFail($id);
            $item->name = $request->input('name');
            $item->otherItem_brand_id = $request->input('brand_id');
            $item->otherItem_category_id = $request->input('category_id');
            $item->otherItem_type_id = $request->input('type_id');
            $item->purchase_price = $request->input('purchase_price');
            $item->retail_price = $request->input('retails_price');
            $item->wholesale_price = $request->input('wholesale_price');

            
            // Handle Image Upload (if new image is provided)
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = Str::random(20) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('OtherItem'), $imageName);
                $imagePath = 'OtherItem/' . $imageName;
                $item->image_path = $imagePath;
            }
        
            $item->save();
        
            // Return a JSON response indicating success
            return response()->json(['success' => true, 'message' => 'Item updated successfully']);
        }
        

}
