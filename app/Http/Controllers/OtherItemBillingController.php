<?php

namespace App\Http\Controllers;

use App\Models\OtherItem;
use App\Models\SerialNumber;
use App\Models\Customer;
use App\Models\OtherPayment;
use App\Models\OtherOrder;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Setting;

class OtherItemBillingController extends Controller
{

    public function otherItemBilling()
    {
        // Get all items with their unit numbers without branch filtering
        $items = OtherItem::with('serialNumbers')->get();
    
        // Get the user's branch id
        $userBranchId = auth()->user()->branch_id; 
    
        // Fetch items with status_id = 1, no branch_id filter
        $items = OtherItem::where('status_id', 1)->get();
    
        // Fetch customers without filtering by branch_id
        $customers = Customer::all(); // Removed branch filter
        
        // Return the view with the data
        return view('otherItem.otherItemBilling', compact('items', 'customers'));
    }
    

    public function getItemDetails($id)
    {
        $item = OtherItem::with('serialNumbers.purchaseStatus')->find($id);

        if (!$item) {
            return response()->json(['error' => 'Item not found'], 404);
        }

        return response()->json([
            'item' => $item,
            'unitNumbers' => $item->serialNumbers
        ]);
    }

    public function handleOrder(Request $request)
    {
        $validated = $request->validate([
            'customerId' => 'required|exists:customers,id',
            'unitIds' => 'required|array',
            'unitIds.*' => 'exists:serial_numbers,id',
            'total' => 'required|numeric|min:0'
        ]);
    
        // Store the order if necessary
    
        return response()->json([
            'success' => true,
            'redirectUrl' => route('another-ui', [
                'customerId' => $validated['customerId'],
                'unitIds' => implode(',', $validated['unitIds']),
                'total' => $validated['total']
            ])
        ]);
    }
    
    
    public function showAnotherUI(Request $request)
    {
        $request->validate([
            'customerId' => 'required|exists:customers,id',
            'unitIds' => 'required|string',
            'total' => 'required|numeric|min:0'
        ]);
    
        $customer = Customer::findOrFail($request->customerId);
        $units = SerialNumber::with('item')->findMany(explode(',', $request->unitIds));
        $totalPrice = $request->total;
    
        return view('otherItem.otherItempayment', compact('customer', 'units', 'totalPrice'));
    }
    







    public function store(Request $request)
    {
        Log::info('Order request received:', $request->all());
    
        try {
            $validated = $request->validate([
                'customer_id' => 'required',
                'total' => 'required|numeric',
                'payment_type' => 'required|string',
                'warranty' => 'required|string',
                'unit_ids' => 'required|array',
                'unit_ids.*' => 'required'
            ]);
    
            $invoiceNum = 'INV-' . now()->format('Ymd') . '-' . Str::random(4);
    
            $payment = OtherPayment::create([
                'invoice_num' => $invoiceNum,
                'customer_id' => $validated['customer_id'],
                'total' => $validated['total'],
                'payment_type' => $validated['payment_type'],
                'warranty' => $validated['warranty']
            ]);
    
            foreach ($validated['unit_ids'] as $unitId) {
                // Update the purchase_status_id to 2 for the serial number
                $serialNumber = SerialNumber::find($unitId);
                if ($serialNumber) {
                    $serialNumber->purchase_status_id = 2; // Set the purchase status ID to 2
                    $serialNumber->save();
                }
    
                // Create the order
                OtherOrder::create([
                    'other_payment_id' => $payment->id,
                    'serial_number_id' => $unitId
                ]);
            }
    
            return response()->json([
                'success' => true,
                'invoice_num' => $invoiceNum,
                'payment_id' => $payment->id
            ]);
    
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error:', $e->errors());
            return response()->json([
                'success' => false,
                'errors' => $e->errors()
            ], 422);
            
        } catch (\Exception $e) {
            Log::error('Order processing error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Server error: ' . $e->getMessage()
            ], 500);
        }
    }
    


    public function show($invoiceNum)
    {
        $payment = OtherPayment::with(['orders.unit.item', 'customer'])
                        ->where('invoice_num', $invoiceNum)
                        ->firstOrFail();
    
        $settings = Setting::all(); // Assuming you have settings in a table
    
        return view('otherItem.other_payment', [
            'payment' => $payment,
            'customer' => $payment->customer,
            'orders' => $payment->orders,
            'settings' => $settings
        ]);
    }
}
