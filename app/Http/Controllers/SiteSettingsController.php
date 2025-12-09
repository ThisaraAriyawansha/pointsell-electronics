<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\File;
use App\Models\Setting;

class SiteSettingsController extends Controller
{
    public function index()
    {
        $sitevalue = SiteSetting::first();

        return view('settings.siteSettings', compact('sitevalue'));
    }

    public function store(Request $request)
    {
        // First, validate the request
        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'sidebar_one_name' => 'required|string|max:255',
            'sidebar_two_name' => 'required|string|max:255',
            'contact_number' => 'required|string|regex:/^\d{10}$/', 
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Get all input data except the image
        $data = $request->except('company_logo');

        // Handle image upload
        if ($request->hasFile('company_logo')) {
            $file = $request->file('company_logo');
            
            // Ensure the upload directory exists
            $uploadPath = public_path('Company Logo');
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0777, true);
            }

            // Create unique filename with timestamp
            $filename = time() . '_' . $file->getClientOriginalName();
            
            // Move the uploaded file
            $file->move($uploadPath, $filename);
            
            // Add the file path to the data array
            $data['company_logo'] = 'Company Logo/' . $filename;
        }

        try {
            // Create new settings record
            SiteSetting::create($data);

            return redirect()->back()->with('success', 'Settings saved successfully!');
        } catch (\Exception $e) {
            // If there's an error and we uploaded an image, delete it
            if (isset($filename) && File::exists($uploadPath . '/' . $filename)) {
                File::delete($uploadPath . '/' . $filename);
            }

            return redirect()->back()
                ->with('error', 'Error saving settings: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        $setting = SiteSetting::findOrFail($id);

        $request->validate([
            'site_name' => 'required|string|max:255',
            'sidebar_one_name' => 'required|string|max:255',
            'sidebar_two_name' => 'required|string|max:255',
            'contact_number' => 'required|string|regex:/^\d{10}$/', 
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->except('company_logo');

        if ($request->hasFile('company_logo')) {
            $file = $request->file('company_logo');
            
            // Create directory if it doesn't exist
            $uploadPath = public_path('Company Logo');
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0777, true);
            }

            // Delete old image if exists
            if ($setting->company_logo && File::exists(public_path($setting->company_logo))) {
                File::delete(public_path($setting->company_logo));
            }

            // Generate unique filename
            $filename = time() . '_' . $file->getClientOriginalName();
            
            // Move the file to the directory
            $file->move($uploadPath, $filename);
            
            $data['company_logo'] = 'Company Logo/' . $filename;
        }

        $setting->update($data);

        return redirect()->back()->with('success', 'Settings updated successfully!');
    }


    public function showDashboard()
    {
        // Fetch the first record from the site_settings table
        $siteSetting = SiteSetting::first();

        // Pass the site settings data to the view
        return view('main_panel', compact('siteSetting'));
    }
}