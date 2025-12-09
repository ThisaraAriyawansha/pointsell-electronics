<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Citie;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function customers()
    {
        return view('customers.customers');
    }

    public function importCustomer()
    {
        return view('customers.importCustomer');
    }

    public function customerList()
    {
    // Retrieve all customers from the database
    $customers = Customer::all();

    // Pass the customers data to the view
    return view('customers.customerList', compact('customers'));
    }


    
    public function addCustomer() {
        // Fetch cities from the database
        $cities = Citie::all();
    
        // Pass cities to the view (no need for formatted customer ID)
        return view('customers.addCustomer', compact('cities'));
    }
    
    



    
    public function store(Request $request)
{
    // Validate input data
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'Mobile_Number' => 'required|string|regex:/^\d{10}$/', // Ensure 10 digits
        'addl1' => 'required|string|max:255',
        'city_name' => 'nullable|string|max:255',
        'due' => 'nullable|numeric',
    ]);

    // If validation fails, Laravel will automatically redirect back with error messages
    // If validation passes, continue saving the customer

    try {
        $lastCustomer = Customer::orderBy('customer_id', 'desc')->first();
        $nextCustomerId = $lastCustomer ? $lastCustomer->customer_id + 1 : 1; // Starting from 1 if no customers exist

        // Use the plain integer without leading zeros
        $nextCustomerId = (int) $nextCustomerId; // Ensure it's an integer

        // Create the new customer and manually set the customer_id
        $customer = new Customer([
            'customer_id' => $nextCustomerId,  // Set the incremented and formatted customer_id
            'customer_name' => $request->name,
            'contact_number' => $request->Mobile_Number,
            'email' => $request->email ?? null, // Set email to null if it's not provided
            'address_line_1' => $request->addl1,
            'city_name' => $request->city_name,
            'due_amount' => $request->due,
            'cities_id' => 1, // Default city ID
            'status_id' => 1, // assuming 1 is for active customers
            'user_id' => auth()->id(), // Current authenticated user ID
        ]);
        
        // Save the customer data
        $customer->save();
        
        return response()->json(['success' => true, 'message' => 'Customer added successfully!']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'An error occurred while saving the customer data.']);
    }
}




public function editCustomer($id)
{
    // Find the customer by ID
    $customer = Customer::findOrFail($id);
    
    // Fetch cities for the dropdown if needed
    $cities = Citie::all();
    
    // Pass customer and cities data to the view
    return view('customers.updateCustomer', compact('customer', 'cities'));
}

 
public function updateCustomer(Request $request, $id)
{
    // Custom validation error messages
    $messages = [
        'name.required' => 'Customer name is required.',
        'Mobile_Number.required' => 'Phone number is required.',
        'Mobile_Number.regex' => 'Phone number must be 10 digits long.',
        'email.email' => 'Please enter a valid email address.',
        'email.unique' => 'This email is already taken.',
        'addl1.required' => 'Address line 1 is required.',
        'city.required' => 'City is required.',
        'city.exists' => 'The selected city is invalid.',
    ];

    // Validate input data with custom error messages
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'Mobile_Number' => 'required|string|regex:/^\d{10}$/', 
        'email' => 'nullable|email|unique:customers,email,' . $id . ',id', // Make email nullable
        'addl1' => 'required|string|max:255',
        'city_name' => 'nullable|string|max:255',
        'due' => 'nullable|numeric',
        'city' => 'nullable|exists:cities,id',
    ], $messages);

    try {
        // Find the customer and update the details
        $customer = Customer::findOrFail($id);
        
        // Update fields
        $customer->customer_name = $request->name;
        $customer->contact_number = $request->Mobile_Number;
        
        // Update email only if it's provided
        $customer->email = $request->email ?? $customer->email;  // If no email is provided, keep the existing one
        
        $customer->address_line_1 = $request->addl1;
        $customer->city_name = $request->city_name;
        $customer->due_amount = $request->due;
        $customer->cities_id = $request->city;
        
        // Save the updated customer
        $customer->save();

        // Return success message after update
        return redirect()->route('updateCustomer', $id)
                         ->with('success', 'Customer updated successfully!');
    } catch (\Exception $e) {
        // Return error message in case of failure
        return redirect()->route('updateCustomer', $id)
                         ->with('error', 'An error occurred while updating the customer data.');
    }
}





public function deleteCustomer($id)
{
    try {
        // Find the customer and delete
        $customer = Customer::findOrFail($id);
        $customer->delete();
        
        return response()->json(['success' => true, 'message' => 'Customer deleted successfully!']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'An error occurred while deleting the customer.']);
    }
}


public function importCustomers(Request $request)
{
    try {
        $data = $request->input('customers');
        
        if (!is_array($data)) {
            Log::error('Invalid customer data format received', ['data' => $data]);
            return response()->json([
                'success' => false,
                'message' => 'Invalid data format'
            ], 400);
        }

        $inserted = 0;
        $errors = [];

        foreach ($data as $index => $customer) {
            // Validate each customer record
            $validator = Validator::make($customer, [
                'customer_name' => 'required|string|max:255',
                'contact_number' => 'required|string|max:20',
                'customer_id' => 'required|string|unique:customers,customer_id',
                'email' => 'nullable|email|max:255',
                'cities_id' => 'required|numeric',
                'status_id' => 'required|numeric',
                'user_id' => 'required|numeric',
            ]);

            if ($validator->fails()) {
                $errors[] = [
                    'row' => $index + 1,
                    'errors' => $validator->errors()->toArray()
                ];
                continue;
            }

            // Check if the contact_number already exists
            $existingCustomer = Customer::where('contact_number', $customer['contact_number'])->first();

            if ($existingCustomer) {
                // If the contact_number already exists, log the error and skip inserting this record
                $errors[] = [
                    'row' => $index + 1,
                    'message' => 'Duplicate contact number: ' . $customer['contact_number']
                ];
                continue;
            }

            try {
                Customer::create([
                    'customer_name' => $customer['customer_name'],
                    'contact_number' => $customer['contact_number'],
                    'address_line_1' => $customer['address_line_1'],
                    'city_name' => $customer['city_name'],
                    'customer_id' => $customer['customer_id'],
                    'due_amount' => $customer['due_amount'],
                    'user_id' => $customer['user_id'],
                    'cities_id' => $customer['cities_id'],
                    'status_id' => $customer['status_id'],
                    'email' => $customer['email'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $inserted++;
            } catch (\Exception $e) {
                Log::error('Error inserting customer record', [
                    'customer' => $customer,
                    'error' => $e->getMessage()
                ]);
                $errors[] = [
                    'row' => $index + 1,
                    'message' => $e->getMessage()
                ];
            }
        }

        $response = [
            'success' => true,
            'inserted' => $inserted,
            'total' => count($data)
        ];

        if (!empty($errors)) {
            $response['errors'] = $errors;
            $response['success'] = $inserted > 0;
        }

        return response()->json($response);

    } catch (\Exception $e) {
        Log::error('CSV import failed', ['error' => $e->getMessage()]);
        return response()->json([
            'success' => false,
            'message' => 'Import failed: ' . $e->getMessage()
        ], 500);
    }
}



public function storeBill(Request $request)
{
    // Validation rules
    $validator = Validator::make($request->all(), [
        'name'          => 'required|string|max:255',
        'Mobile_Number' => 'required|regex:/^[0-9]{10}$/ |unique:customers,contact_number', // Assuming 10-digit phone numbers
        'email' => 'nullable',
        'addl1' => 'nullable',
        'due' => 'nullable',
        'city' => 'nullable',
        
    ], [
        // Custom error messages
        'name.required'          => 'Customer name is required.',
        'Mobile_Number.required' => 'Mobile number is required.',
        'Mobile_Number.regex'    => 'Mobile number must be a valid 10-digit number.',
        
    ]);

    // Handle validation failure
    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'errors'  => $validator->errors(),
        ], 422);
    }
    try {

        $lastCustomer = Customer::orderBy('customer_id', 'desc')->first();
        $nextCustomerId = $lastCustomer ? $lastCustomer->customer_id + 1 : 1; // Starting from 1 if no customers exist

        // Use the plain integer without leading zeros
        $nextCustomerId = (int) $nextCustomerId; // Ensure it's an integer
        // Create the new customer
        $customer = new Customer();
            $customer->customer_id = $nextCustomerId;
            $customer->customer_name = $request->name;
            $customer->contact_number = $request->Mobile_Number;
            $customer->email = $request->email;
            $customer->address_line_1 = $request->addl1;
            $customer->due_amount = $request->due;
            $customer->city_name = $request->city;
            $customer->status_id = 1;  // assuming 1 is for active customers
            $customer->cities_id = 1;  // assuming 1 is for active customers
            $customer->user_id = auth()->id();
        
        
        // Save the customer data
        $customer->save();
        return redirect()->route('customers.index')->with('success', 'Customer added successfully');
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'An error occurred while saving the customer data.']);
    }
}

    
}