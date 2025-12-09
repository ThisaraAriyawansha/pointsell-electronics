<?php

namespace App\Http\Controllers;

use App\Models\Item_categorie;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Sale;
use Illuminate\Support\Facades\Validator;
use App\Models\Citie;
use App\Models\Sales_item;
use App\Models\SalesReturnItem;
use Illuminate\Support\Facades\DB;  // Add this line
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class SalesController extends Controller
{
    public function sales()
    {
        return view('sales.sales');
    }
    public function salesItems()
    {
        // Eager load 'payment.user' and 'customer' relationships
        $salesData = Payment::get();
        
        return view('sales.salesItems', compact('salesData'));
    }
    public function filterSales(Request $request)
{
    $customerName = $request->get('customer_name');
    
    $sales = Sale::with('customer')
                ->whereHas('customer', function($query) use ($customerName) {
                    $query->where('customer_name', 'like', '%'.$customerName.'%');
                })
                ->get();

    return response()->json($sales);
}

    public function salesReturnList()
{
    // Retrieve sales data with related sales items and item details
    $sales = Sale::with(['salesItems.item'])->get();

    // Pass the data to the view
    return view('sales.salesReturnList', compact('sales'));
}

public function billing()
{
    // Get items where status_id is 1
    $items = Item::where('status_id', 1)->get();
    
    // Fetch all customers and cities as before
    $customers = Customer::all();
    $cities = Citie::all();

    // Pass filtered items, customers, and cities to the view
    return view('sales.billing', compact('items', 'customers', 'cities'));
}



    public function add_customer()
    {
        return view('item.add_customer');
    }
    public function insert_customer(Request $request)
    {

        $validator = Validator::make($request->all(), [
            // 'full_name' => 'required|max:255|min:5|unique:students,full_name',

            'categories' => 'required',
            'description' => 'required',

        ], [
            'categories.required' => 'Categories field is required.',
            'description.required' => 'Categories Description field is required.',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422); // 422 Unprocessable Entity status code for validation errors
        }

        $save = new Item_categorie;

        $save->categories = $request->categories;
        $save->description = $request->description;
        $save->save();

        // Return a JSON response
        return response()->json(['message' => 'Category created successfully!']);

    }
    public function filter(Request $request)
    {
        $search = $request->input('sales_code');

        // Fetch sales based on sales_code
        $sales = Sale::where('sales_code', 'like', "%{$search}%")
            ->with('salesItems.item') // Eager load related data
            ->get();

        return response()->json($sales);
    }


    public function processReturn(Request $request)
{
    try {
        // Validate request data
        $validated = $request->validate([
            'sales_id' => 'required|exists:sales,id',
            'items_id' => 'required|exists:items,id',
            'return_quantity' => 'required|integer|min:1',
            'is_permanent' => 'required|boolean',
        ]);
        
        // Get the sales item with detailed error checking
        $salesItem = Sales_item::where('sales_id', $request->sales_id)
            ->where('items_id', $request->items_id)
            ->firstOrFail();
        
        // Check if return quantity is valid
        if ($request->return_quantity > $salesItem->quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Return quantity cannot exceed original quantity'
            ], 400);
        }
    
        // Check if item has already been returned
        if ($salesItem->return_quantity > 0) {
            return response()->json([
                'success' => false,
                'message' => 'This item has already been partially or fully returned'
            ], 400);
        }
    
        // Update sales_items table
        $salesItem->return_quantity = $request->return_quantity;
        $salesItem->status = $request->is_permanent ? 'permanent' : 'not_permanent';
        $salesItem->save();
        
        // Create sales return item record with status
        $salesReturnItem = SalesReturnItem::create([
            'item_id' => $request->items_id,
            'sales_id' => $request->sales_id,
            'return_quantity' => $request->return_quantity,
            'status' => $request->is_permanent ? 'permanent' : 'not_permanent',
        ]);
    
        // If not permanent return, update item quantity
        if (!$request->is_permanent) {
            $item = Item::findOrFail($request->items_id);
            $item->quantity += $request->return_quantity;
            $item->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Return processed successfully',
            'data' => $salesReturnItem,
        ]);

    } catch (ValidationException $e) {
        Log::error('Validation error in processReturn:', [
            'errors' => $e->errors(),
            'request' => $request->all(),
        ]);
        return response()->json([
            'success' => false,
            'message' => 'Validation error',
            'errors' => $e->errors(),
        ], 422);

    } catch (ModelNotFoundException $e) {
        Log::error('Model not found in processReturn:', [
            'message' => $e->getMessage(),
            'request' => $request->all(),
        ]);
        return response()->json([
            'success' => false,
            'message' => 'Sales item or item not found',
        ], 404);

    } catch (\Exception $e) {
        Log::error('Error in processReturn:', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
            'request' => $request->all(),
        ]);
        return response()->json([
            'success' => false,
            'message' => 'Error processing return: ' . $e->getMessage(),
        ], 500);
    }
}



public function returnView()
{
    // Fetch all data from the SalesReturnItem table with relationships
    $salesReturnItems = SalesReturnItem::with(['item', 'sale'])->get();

    // Group the sales return items by sales_code
    $groupedSalesReturnItems = $salesReturnItems->groupBy(function ($item) {
        return $item->sale->sales_code; // Group by sales_code
    });

    // Pass the grouped data to the view
    return view('sales.returnView', compact('groupedSalesReturnItems'));
}

public function dueAmount()
{
    // Eager load 'payment.user' and 'customer' relationships
    $salesData = Payment::get();
    
    return view('sales.dueAmount', compact('salesData'));
}

        public function getCustomerDue($id)
        {
            if ($id == 1) {
                $dueAmount=0;
            } 
             else {
                $dueAmount = Payment::selectRaw('SUM(payments.grand_total - payments.paid_amount) as total_due_amount')
                ->join('sales', 'payments.sales_id', '=', 'sales.id') // Join Payment and Sale
                ->where('sales.customers_id', $id) // Filter by customer ID
                ->groupBy('sales.customers_id') // Group by customer ID
                ->first();
            }
            return response()->json([
                'customer_id' => $id,
                'total_due_amount' => $dueAmount ? $dueAmount->total_due_amount : 0,
            ]);
        }


        public function getDueCustomerId(Request $request, $id)
        {
            // Use the customer_id ($id) passed via the route to filter the sales data
            $salesData = Payment::whereHas('sale.customer', function ($query) use ($id) {
                $query->where('id', $id); // Filter by the customer's ID
            })->get();
        
            return view('sales.dueBilling', compact('salesData'));
        }
        
        

}