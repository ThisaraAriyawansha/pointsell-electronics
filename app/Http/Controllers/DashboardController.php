<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\Payment;
use App\Models\Sale;
use App\Models\Customer;
use App\Models\Supplier;
use App\Models\Item;

class DashboardController extends Controller
{
    public function dashboard()
{
    // Fetch total expenses
    $totalExpenses = Expense::sum('amount');

    // Fetch total sales and the grand total from payments
    $totalSales = Sale::with('payment')->get()->sum(function ($sale) {
        return $sale->payment->grand_total ?? 0;
    });

    // Fetch total due (sum of the due_amount in payments)
    $totalDue = Payment::sum('grand_total') - Payment::sum('paid_amount');

    // Fetch today's total sales (filtered by today's date)
    $todaySales = Sale::whereDate('created_at', today())
    ->whereHas('payment') // Ensure the payment exists
    ->with('payment')
    ->get()
    ->sum(function ($sale) {
        // Safely access the grand_total and default to 0 if NULL
        return $sale->payment->grand_total ?? 0;
    });


    // Fetch today's total expenses (filtered by today's date)
    $todayExpenses = Expense::whereDate('expense_date', today())->sum('amount');

    // Fetch counts for Customers, Suppliers, Items, and Sales Invoices
    $customerCount = Customer::count();
    $supplierCount = Supplier::count();
    $itemCount = Item::count();
    $invoiceCount = Payment::count();

    // Fetch all items with their details (name, quantity, minimum_qty)
    $items = Item::all();

    // Calculate total sales for each month (this is just an example, adjust as needed)
 // Fetch total sales for each month along with item prices
 $monthlySales = [];
 for ($i = 1; $i <= 12; $i++) {
     $salesInMonth = Sale::whereMonth('created_at', $i)
         ->with(['salesItems.item']) // Load sales items and associated items
         ->get();

     $totalSalesForMonth = 0;

     // Loop through the sales and their items to calculate the total sales
     foreach ($salesInMonth as $sale) {
         foreach ($sale->salesItems as $salesItem) {
             $item = $salesItem->item; // Get the item associated with this sales item
             if ($item) {
                 // Calculate total price (quantity * item price)
                 $totalSalesForMonth += $salesItem->quantity * $item->retail_price;
             }
         }
     }

     $monthlySales[] = $totalSalesForMonth;
 }

    // Pass all data to the view
    return view('dash.dash', [
        'totalExpenses' => $totalExpenses,
        'totalSales' => $totalSales,
        'totalDue' => $totalDue,
        'todaySales' => $todaySales,
        'todayExpenses' => $todayExpenses,
        'customerCount' => $customerCount,
        'supplierCount' => $supplierCount,
        'itemCount' => $itemCount,
        'invoiceCount' => $invoiceCount,
        'items' => $items, // Pass the items data to the view
        'monthlySales' => $monthlySales,
    ]);
}

}