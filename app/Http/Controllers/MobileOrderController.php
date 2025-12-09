<?php

namespace App\Http\Controllers;

use App\Models\MobileOrder;
use App\Models\MobileImei;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class MobileOrderController extends Controller
{
    public function showInvoice($invoice_number)
    {
        $order = MobileOrder::where('invoice_number', $invoice_number)->firstOrFail();
        return view('mobile.mobileInvoice', compact('order'));
    }

    public function completePurchase(Request $request, $imei_id)
    {
        // Generate unique invoice number
        $invoiceNumber = 'INV-' . Str::upper(Str::random(10));

        // Create the mobile order
        $order = MobileOrder::create([
            'invoice_number' => $invoiceNumber,
            'mobile_imei_id' => $imei_id,
            'name' => $request->input('fullName'),
            'email' => $request->input('email'),
            'number' => $request->input('phone'),
            'address' => $request->input('address'),
        ]);

        // Update the purchase status of the MobileImei to 2
        $imei = MobileImei::find($imei_id);
        $imei->purchase_status_id = 2; // Assuming '2' is the status code for completed purchases
        $imei->save();

        // Redirect to the invoice page with the order details
        return redirect()->route('mobile.mobileInvoice', ['invoice_number' => $invoiceNumber]);
    }


}
