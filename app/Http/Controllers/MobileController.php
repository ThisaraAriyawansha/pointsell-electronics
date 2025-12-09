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
use App\Models\MobileItem;
use App\Models\MobileImei;



class MobileController extends Controller
{

    public function mobile()
    {
        return view('mobile.mobile');
    }
    
    public function addmobile()
    {
        // Fetch data for each model
        $brands = Brand::all();
        $models = Modell::all();
        $colors = Color::all();
        $storages = Storage::all();
        $rams = Ram::all();
        $distributors = Distributor::all();
        $dealers = Dealer::all();
        $agents = Agent::all();
    
        // Pass the data to the view
        return view('mobile.addMobileItem', compact('brands', 'models', 'colors', 'storages', 'rams', 'distributors', 'dealers', 'agents'));
    }
     
    
    public function mobilebilling(Request $request)
    {
        $query = MobileImei::with('mobileItem')
            ->where('purchase_status_id', 1); // Filter by purchase_status_id being 1
    
        // Filter by IMEI if it's provided
        if ($request->has('imei') && !empty($request->imei)) {
            $query->where('imei_number', 'like', '%' . $request->imei . '%');
        }
    
        // Filter by Brand if it's provided
        if ($request->has('brand') && !empty($request->brand)) {
            $query->whereHas('mobileItem.brand', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->brand . '%');
            });
        }
    
        // Filter by Model if it's provided
        if ($request->has('model') && !empty($request->model)) {
            $query->whereHas('mobileItem.model', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->model . '%');
            });
        }
    
        $imeis = $query->paginate(5); 
    
        return view('mobile.mobileBilling', compact('imeis'));
    }
    
    
    
    public function editmobile($id)
    {
        $mobileItem = MobileItem::findOrFail($id);
    
        $brands = Brand::all();
        $models = Modell::all();
        $colors = Color::all();
        $storages = Storage::all();
        $rams = Ram::all();
        $distributors = Distributor::all();
        $dealers = Dealer::all();
        $agents = Agent::all();
    
        // Pass the mobile item and other data to the view
        return view('mobile.mobileEdit', compact(
            'mobileItem', 
            'brands', 
            'models', 
            'colors', 
            'storages', 
            'rams', 
            'distributors', 
            'dealers', 
            'agents'
        ));
    }
    

    public function viewmobile()
    {
        $mobileItems = MobileItem::with(['imeis' => function($query) {
            $query->where('purchase_status_id', 1); // Filter IMEI records by purchase_status_id = 1
        }])->get();
    
        return view('mobile.mobileView', compact('mobileItems'));
    }
    
    public function updateStatus(Request $request)
    {
        $mobileItem = MobileItem::findOrFail($request->id);
        
        // Toggle the status_id between 1 and 2
        $newStatus = ($mobileItem->status_id == 1) ? 2 : 1;
        $mobileItem->status_id = $newStatus;
    
        $mobileItem->save();
    
        return response()->json(['status' => $newStatus]);
    }
    
    

    public function mobileCustomer($imei)
    {
        $imeiDetails = MobileImei::with('mobileItem.color', 'mobileItem.storage', 'mobileItem.ram')->findOrFail($imei);
        return view('mobile.mobileCustomer', compact('imeiDetails'));
    }



}
