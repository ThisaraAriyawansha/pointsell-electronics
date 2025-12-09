<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Sales_item;
use App\Models\Payment;
use App\Models\Item;
use Illuminate\Support\Facades\Validator;
use App\Models\SalesDuePayment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\User;


class PaymentController extends Controller
{
    
    public function store(Request $request)
{
    // Validation rules
    $validator = Validator::make($request->all(), [
        'warrenty_period' => 'nullable|integer|min:0',
        'warrenty_cnum'   => 'nullable|string|max:255',
        'items'           => 'required|json',
        'r_amount'        => 'required|numeric|min:0',
        'p_type'          => 'required',
        'p_status'        => 'required',
        'cheque_no'       => 'nullable|string|max:255',
        'notes'           => 'nullable|string|max:1000',
    ], [
        // Custom error messages
        'warrenty_period.nullable' => 'Warranty period is required.',
        'warrenty_period.integer'  => 'Warranty period must be a valid number.',
        'items.required'           => 'Items are required for the sale.',
        'items.json'               => 'Items must be a valid JSON string.',
        'r_amount.required'        => 'Recieved amount is required.',
        'p_type.required'          => 'Payment type is required.',
        'p_status.required'        => 'Payment status is required.',
        'r_amount.numeric'         => 'Recieved amount must be a valid number.',
    ]);

    // Handle validation failure
    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'errors'  => $validator->errors(),
        ], 422);
    }

    try {
        DB::beginTransaction();

        // Create Sale Record
        $sale = Sale::create([
            'sales_code' => 'SALE-' . strtoupper(uniqid()), // Generate unique sales code
            'customers_id' => $request->selectedCustomerId ?? 1,
            'users_id' => auth()->id() ?? 1, // Use authenticated user if available
            'warranty_period' => $request->warrenty_period,
            'warranty_card_no' => $request->warrenty_cnum,
        ]);

        $items = json_decode($request->items, true);
        if (empty($items)) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'No valid items provided.',
            ], 422);
        }

        
        // Prepare sales items and update stock
        // Prepare sales items and update stock
            $itemDetails = []; // To store item details for the response
            foreach ($items as $item) {
                // Get the item from the database
                $itemModel = Item::find($item['id']);

                if (!$itemModel) {
                    DB::rollBack();
                    return response()->json([
                        'success' => false,
                        'message' => 'Item not found: ' . $item['id'],
                    ], 404);
                }

                // Check stock availability
                if ($itemModel->quantity < $item['addQuantity']) {
                    DB::rollBack();
                    return response()->json([
                        'success' => false,
                        'message' => 'Insufficient stock for item: ' . $itemModel->item_name,
                    ], 422);
                }

                // Create sales item record
                Sales_item::create([
                    'sales_id' => $sale->id,
                    'items_id' => $item['id'],
                    'quantity' => $item['addQuantity'],
                    'discount' => $item['discount'] ?? 0,
                    'discount_type' => "FIXED",
                ]);

                // Update stock quantity
                $itemModel->quantity -= $item['addQuantity'];
                $itemModel->save();

                // Collect item details for the response
                $itemDetails[] = [
                    'item_id'    => $item['id'],
                    'item_name'  => $itemModel->item_name,
                    'item_code'  => $itemModel->item_code,
                    'quantity'   => $item['addQuantity'],
                    'price'      => $itemModel->retail_price,
                ];
            }


        $grandTotal = $request->grand_total;
        $paidAmount = $request->p_amount;
        $dueAmount = $grandTotal - $paidAmount;

                // Ensure grand_total is always greater or equal to paid_amount
                if ($grandTotal < $paidAmount) {
                    DB::rollBack();
                    return response()->json([
                        'success' => false,
                        'message' => 'Paid amount cannot exceed grand total.',
                    ], 422);
                }

        // Create payment record
        $payment = new Payment();
        $payment->users_id = auth()->id() ?? 1;
        $payment->sales_id = $sale->id;
        $payment->paid_amount = $request->p_amount;
        $payment->sub_total = $request->t_amount;
        $payment->grand_total = $request->grand_total;
        $payment->due_amount = $dueAmount;
        $payment->cheque_no = $request->cheque_no;
        $payment->payment_type = $request->p_type;
        $payment->cheque_date = $request->cheque_date;
        $payment->discount = $request->discount;
        $payment->sales_note = $request->notes;

        // Check and set payment status based on grand_total and paid_amount
        if ($request->grand_total == $request->p_amount) {
            $payment->payment_status = 'PAID';
        } elseif ($request->grand_total > $request->p_amount) {
            $payment->payment_status = 'DUE';
        } else {
            // Optional: Handle overpayment or invalid cases
            $payment->payment_status = 'HOLD'; // Or handle this scenario differently
        }

        $payment->save();


        DB::commit();

                // Retrieve customer and user names using IDs
                $customer = Customer::find($sale->customers_id);
                $user = User::find($payment->users_id);
                
        // Return a success response
        return response()->json([
            'success' => true,
            'message' => 'Payment and Sale successfully recorded.',
            'sale_id' => $sale->id,
            'payment_id' => $payment->id,
            'sales_code' => $sale->sales_code,
            'due_amount' => $dueAmount,
            'paid_amount' => $paidAmount,
            'payment_type' => $request->p_type,
            'customer_name' => $customer ? $customer->customer_name : 'N/A', 
            'user_name' => $user ? $user->name : 'N/A',
            'discount' => $request->discount,
            'sub_total' => $request->t_amount,
            'received_amount' => $request->r_amount,

        ]);

        
        
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json([
            'success' => false,
            'message' => 'An error occurred while processing the sale.',
            'error'   => $e->getMessage(),
        ], 500); // HTTP 500 Internal Server Error
    }
}


    // Due paymant
    public function duePay($id)
    {
        // Retrieve the payment data along with the related customer data
        $payment = Payment::with(['sale.customer'])->find($id);
    
        if (!$payment) {
            return redirect()->route('sales.index')->with('error', 'Payment not found');
        }
    
        $customer = $payment->sale->customer;
        
        // Get the current logged-in user's name
        $userName = Auth::user()->name;
    
        // Retrieve the customer_id from the related customer model
        $customerId = $customer->id;
    
        // Pass payment, customer data, customer_id, and the logged-in user's name to the view
        return view('sales.salesPayment', [
            'payment' => $payment,
            'customer' => $customer,
            'userName' => $userName,  // Sending the logged-in user's name
            'customerId' => $customerId,  // Sending the customer_id
        ]);
    }
    

    
    
    
    
    public function updatePayment(Request $request)
    {
        // Validate the request
        $request->validate([
            'payment_id' => 'required|exists:payments,id',
            'amount_paid' => 'required|numeric|min:0',
            'payment_type' => 'required|in:CASH,CARD,CHEQUE,CREDIT',
        ]);
    
        try {
            DB::beginTransaction();
    
            // Get the payment record by ID
            $payment = Payment::find($request->payment_id);
    
            if (!$payment) {
                throw new \Exception('Payment record not found');
            }
    
            // Validate that the amount paid does not exceed the due amount
            if ($request->amount_paid > ($payment->grand_total - $payment->paid_amount)) {
                return redirect()->back()->with('error', 'The payment amount exceeds the due amount.');
            }
    
            // Update payment columns
            $payment->paid_amount += $request->amount_paid; 
            $payment->pay_due_amount += $request->amount_paid;  
    
            // Change payment status only if due amount becomes zero
            if ($payment->grand_total - $payment->paid_amount == 0) {
                $payment->payment_status = 'PAID';
            }
    
            $payment->save();
    
            // Create a record in SalesDuePayment table
            SalesDuePayment::create([
                'sale_id' => $payment->sales_id,
                'amount_paid' => $request->amount_paid,
                'payment_type' => $request->payment_type,
                'cheque_number' => $request->cheque_number,
                'cheque_date' => $request->cheque_date,
            ]);
    
            DB::commit();
    
            // Optionally generate a receipt here
    
            return redirect()->back()->with('success', 'Payment updated successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            
            // Log exception for debugging
            Log::error('Payment update failed: '.$e->getMessage());
    
            return redirect()->back()
                ->withErrors(['error' => 'Failed to update payment: ' . $e->getMessage()])
                ->withInput();
        }
    }
    
    

    public function viewDetails($id)
    {
        // Fetch payment with all related data using eager loading
        $payment = Payment::with([
            'sale.customer',
            'sale.salesItems.item',
            'sale.salesReturnItems',
            'user'
        ])->findOrFail($id);
        
        // Get all due payments for this sale
        $duePayments = SalesDuePayment::where('sale_id', $payment->sales_id)
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Calculate total returned items value
        $totalReturned = $payment->sale->salesReturnItems->sum('return_quantity');
        
        // Calculate payment statistics
        $stats = [
            'total_paid' => $payment->paid_amount,
            'total_returns' => $totalReturned,
            'remaining_due' => $payment->grand_total - $payment->paid_amount,
            'original_amount' => $payment->grand_total,
        ];
        
        return view('sales.salePaymentDetails', compact(
            'payment',
            'duePayments',
            'stats'
        ));
    }
    
    
    
}