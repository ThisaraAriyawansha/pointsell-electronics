<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MobileItem;
use App\Models\MobileImei;
use Illuminate\Support\Str;


class MobileItemController extends Controller
{
    public function store(Request $request)
{
    try {
        // Debugging: Log request data
        \Log::info('Received Data:', $request->all());

        // Validate the request data
        $validatedData = $request->validate([
            'item_name' => 'required|string|max:255', // Required field
            'brand_id' => 'required|exists:brands,id', // Required field
            'model_id' => 'required|exists:modells,id', // Nullable field
            'description' => 'nullable|string', // Nullable field
            'color_id' => 'required|exists:colors,id', // Required field
            'storage_id' => 'required|exists:storages,id', // Required field
            'ram_id' => 'required|exists:rams,id', // Required field
            'distributor_id' => 'nullable|exists:distributors,id', // Required field
            'dealer_id' => 'nullable|exists:dealers,id', // Required field
            'agent_id' => 'nullable|exists:agents,id', // Required field
            'distributor_price' => 'nullable|numeric', // Required field
            'dealer_price' => 'nullable|numeric', // Required field
            'agent_price' => 'nullable|numeric', // Required field
            'tax' => 'required|numeric', // Required field
            'mrp_price' => 'required|numeric', // Required field
            'purchase_price' => 'nullable|numeric', // Required field
            'imeis' => 'nullable|array', // Nullable field
            'imeis.*.imei' => 'nullable|string|unique:mobile_imeis,imei_number', // Nullable IMEI
            'imageFile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240', // Nullable image field
        ]);

        $imagePath = null; // Initialize image path to null if no image is uploaded

        // Handle file upload if image exists
        if ($request->hasFile('imageFile')) {
            $image = $request->file('imageFile');
            $imageName = Str::random(20) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('ProductImages'), $imageName);
            $imagePath = 'ProductImages/' . $imageName;
        }

        // Create the mobile item, with null values where applicable
        $mobileItem = MobileItem::create([
            'name' => $validatedData['item_name'],
            'brand_id' => $validatedData['brand_id'],
            'model_id' => $validatedData['model_id'] ?? null, // Nullable model_id
            'description' => $validatedData['description'] ?? null, // Nullable description
            'color_id' => $validatedData['color_id'],
            'storage_id' => $validatedData['storage_id'],
            'ram_id' => $validatedData['ram_id'],
            'distributor_id' => $validatedData['distributor_id'],
            'distributor_price' => $validatedData['distributor_price'],
            'dealer_id' => $validatedData['dealer_id'],
            'dealer_price' => $validatedData['dealer_price'],
            'agent_id' => $validatedData['agent_id'],
            'agent_price' => $validatedData['agent_price'],
            'tax' => $validatedData['tax'],
            'mrp_price' => $validatedData['mrp_price'],
            'purchase_price' => $validatedData['purchase_price'],
            'status_id' => 1,
            'image_path' => $imagePath, // Null if no image uploaded
        ]);

        // If IMEIs are provided, save them
        if (!empty($validatedData['imeis'])) {
            foreach ($validatedData['imeis'] as $imeiData) {
                MobileImei::create([
                    'mobile_item_id' => $mobileItem->id,
                    'imei_number' => $imeiData['imei'],
                    'purchase_status_id' => 1
                ]);
            }
        }

        return response()->json(['success' => true]);

    } catch (\Exception $e) {
        // Log the error for debugging
        \Log::error('Error saving mobile item: ' . $e->getMessage());

        return response()->json([
            'success' => false,
            'message' => 'Error occurred: ' . $e->getMessage()
        ], 500);
    }
}



    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'item_name' => 'required|string|max:255',
            'brand_id' => 'required|exists:brands,id',
            'model_id' => 'required|exists:modells,id',
            'description' => 'nullable|string',
            'color_id' => 'required|exists:colors,id',
            'storage_id' => 'required|exists:storages,id',
            'ram_id' => 'required|exists:rams,id',
            'distributor_id' => 'nullable|exists:distributors,id',
            'dealer_id' => 'nullable|exists:dealers,id',
            'agent_id' => 'nullable|exists:agents,id',
            'distributor_price' => 'nullable|numeric',
            'dealer_price' => 'nullable|numeric',
            'agent_price' => 'nullable|numeric',
            'tax' => 'required|numeric',
            'mrp_price' => 'required|numeric',
            'purchase_price' => 'nullable|numeric',
            'imageFile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240', // Image validation
        ]);

        $mobileItem = MobileItem::findOrFail($id);
        if ($request->hasFile('imageFile')) {
            $image = $request->file('imageFile');
            
            // Ensure unique filename without using original name
            $imageName = Str::random(20) . '.' . $image->getClientOriginalExtension();
        
            // Store in the public folder
            $imagePath = 'ProductImages/' . $imageName;
            $image->move(public_path('ProductImages'), $imageName);
        
            // Delete old image if exists
            if (!empty($mobileItem->image_path) && file_exists(public_path($mobileItem->image_path))) {
                @unlink(public_path($mobileItem->image_path)); // Suppress errors if file is missing
            }
        
            $mobileItem->image_path = $imagePath;
        }
        

        // Update the mobile item
        $mobileItem->update([
            'name' => $validatedData['item_name'],
            'brand_id' => $validatedData['brand_id'],
            'model_id' => $validatedData['model_id'],
            'description' => $validatedData['description'],
            'color_id' => $validatedData['color_id'],
            'storage_id' => $validatedData['storage_id'],
            'ram_id' => $validatedData['ram_id'],
            'distributor_id' => $validatedData['distributor_id'],
            'distributor_price' => $validatedData['distributor_price'],
            'dealer_id' => $validatedData['dealer_id'],
            'dealer_price' => $validatedData['dealer_price'],
            'agent_id' => $validatedData['agent_id'],
            'agent_price' => $validatedData['agent_price'],
            'tax' => $validatedData['tax'],
            'mrp_price' => $validatedData['mrp_price'],
            'purchase_price' => $validatedData['purchase_price'],
        ]);

        return response()->json(['success' => 'Item updated successfully!']);
    }
    
}