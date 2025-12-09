<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Citie;
use Illuminate\Support\Facades\Validator;

class SuppliersController extends Controller 
{
    public function suppliers()
    {
        return view('suppliers.suppliers');
    }

    public function importSupplier()
    {
        return view('suppliers.importSupplier');
    }

    public function supplierList()
    {
        // Retrieve all suppliers from the database
        $suppliers = Supplier::all();

        // Pass the suppliers data to the view
        return view('suppliers.supplierList', compact('suppliers'));
        }

    public function addSupplier()
    {
        // Fetch cities from the database
        $cities = Citie::all();
        
        // Pass cities to the view
        return view('suppliers.addSupplier', compact('cities'));
    }




    public function store(Request $request) 
    {
        // Custom validation messages
        $messages = [
            'supplier_name.required' => 'Supplier name is required.',
            'supplier_name.max' => 'Supplier name cannot exceed 255 characters.',
            'contact_number.required' => 'Contact number is required.',
            'contact_number.regex' => 'Contact number must be 10 digits.',
            
            'city_id.required' => 'Please select a city.',
            'city_id.exists' => 'Selected city is invalid.',
        ];

        // Validate input data with custom messages
        $validated = $request->validate([
            'supplier_name' => 'required|string|max:255',
            'contact_number' => 'required|string|regex:/^\d{10}$/', // Ensure 10 digits

        ], $messages);

        try {
            // If validation passes, save the supplier
            $supplier = new Supplier([
                'supplier_name' => $request->supplier_name,
                'contact_number' => $request->contact_number,
                'email' => $request->email,
                'address' => $request->address,
                'city_name' => $request->city_name,
                'city_id' => 1,
                'status_id' => 1, 
                'user_id' => auth()->id(),
                 // assuming 1 is for active
            ]);

            // Save the supplier data
            $supplier->save();

            // Success message with flash session
            return redirect()->back()->with('success', 'Supplier added successfully!');
        } catch (\Exception $e) {
            // Error message with detailed error logging
            \Log::error('Supplier creation error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while saving the supplier data: ' . $e->getMessage());
        }
    }




    public function deleteSuppliers($id)
{
    try {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();
        
        return response()->json(['success' => true, 'message' => 'Supplier deleted successfully!']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'An error occurred while deleting the Supplier.']);
    }
}


public function editSupplier($id)
{
    // Find the supplier by ID
    $supplier = Supplier::findOrFail($id);
    
    // Fetch all cities for the dropdown
    $cities = Citie::all();
    
    // Pass the supplier and cities data to the view
    return view('suppliers.updateSupplier', compact('supplier', 'cities'));
}


public function update(Request $request, $id) {
    // Set default city to 1 if not provided
    $request->merge([
        'city' => $request->input('city', 1),
    ]);

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'mobile_number' => [
            'required', 
            'string', 
            'regex:/^\d{10}$/'
        ],
    ], [
        'name.required' => 'Supplier name is required.',
        'name.max' => 'Supplier name cannot exceed 255 characters.',
        'mobile_number.required' => 'Mobile number is required.',
        'mobile_number.regex' => 'Mobile number must be a 10-digit number.',
        
        
    ]);

    try {
        // Find and update supplier
        $supplier = Supplier::findOrFail($id);
        $supplier->update([
            'supplier_name' => $validated['name'],
            'contact_number' => $validated['mobile_number'],
            'email' => $request['email'],
            'address' => $request['address'],
            'city_id' => $request['city'],
            'city_name' => $request['city_name']
        ]);
    
        // Clear old errors and redirect with success message
        return redirect()->back()->with('success', 'Supplier updated successfully!');
    } catch (\Exception $e) {
        \Log::error('Error updating supplier: ' . $e->getMessage());
        return redirect()->back()
            ->with('error', 'An unexpected error occurred. Please try again.')
            ->withInput();
    }
}





public function import(Request $request)
{
    $validatedData = $request->validate([
        'suppliers' => 'required|array',
        'suppliers.*.supplier_name' => 'required|string',
        'suppliers.*.mobile_number' => 'required|string',
        'suppliers.*.address' => 'nullable|string',
        'suppliers.*.email' => 'nullable|email',
        'suppliers.*.user_id' => 'nullable|integer',
        'suppliers.*.city_id' => 'nullable|integer',
        'suppliers.*.status_id' => 'nullable|integer',
    ]);

    foreach ($request->suppliers as $supplierData) {
        // Check if the mobile_number already exists
        $existingSupplier = Supplier::where('contact_number', $supplierData['mobile_number'])->first();

        // Only create the supplier if it doesn't exist already
        if (!$existingSupplier) {
            Supplier::create([
                'supplier_name' => $supplierData['supplier_name'],
                'contact_number' => $supplierData['mobile_number'],
                'address' => $supplierData['address'],
                'email' => $supplierData['email'],
                'user_id' => $supplierData['user_id'],
                'city_id' => $supplierData['city_id'],
                'status_id' => $supplierData['status_id'],
                'city_name' => $supplierData['city_name'],

            ]);
        }
    }

    return response()->json(['success' => true]);
}



public function toggleUserStatus($id)
{
    try {
        $supplier = Supplier::findOrFail($id);
        
        // Toggle the status_id between 1 (Active) and 2 (Inactive)
        $supplier->status_id = $supplier->status_id == 1 ? 2 : 1;
        
        // Save the updated user
        $supplier->save();

        return response()->json(['status_id' => $supplier->status_id]);

    } catch (\Exception $e) {
        // Log the exception for debugging
        \Log::error('Error toggling supplier status: ' . $e->getMessage());
        \Log::error($e->getTraceAsString());

        // Return a JSON response with error information
        return response()->json(['error' => 'Something went wrong. Please try again later.'], 500);
    }
}


}