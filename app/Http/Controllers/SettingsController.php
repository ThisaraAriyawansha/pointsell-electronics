<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Setting;
use Auth;
use Hash;
use Illuminate\Support\Facades\File;



class SettingsController extends Controller
{
    public function settings()
    {
        return view('settings.settings');
    }
    public function addUnit()
    {
        return view('settings.addUnit');
    }
    public function addBranch()
    {
        return view('settings.addBranch');
    }
    public function siteSettings()
    {
        return view('settings.siteSettings');
    }
    public function changePassword()
    {
        $data['header_title'] = "Change Password";
        return view('settings.changePassword', $data);
    }
    
    public function updateChangePassword(Request $request)
    {
        // Validate the input
        $request->validate([
            'old_password' => 'required|string',  // Ensure old password is provided
            'new_password' => 'required|string|min:5|confirmed',  // Ensure 'new_password' is confirmed
            'new_password_confirmation' => 'required|string|min:5',  // Make sure the confirmation field is required
        ]);
    
        // Fetch the authenticated user
        $user = User::find(Auth::user()->id);  // or User::where('id', Auth::user()->id)->first();
        
        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }
    
        // Check if the old password matches the stored one
        if (Hash::check($request->old_password, $user->password)) {
            // Update the password and save it
            $user->password = Hash::make($request->new_password);
            $user->save();
    
            return redirect()->back()->with('success', "Password successfully updated");
        } else {
            return redirect()->back()->with('error', "Old Password is not correct");
        }
    }
    

    public function changeSite()
    {
        $sitevalue = Setting::all();

        return view('settings.changeSite', compact('sitevalue'));
    }

    public function update(Request $request)
        {
            // Validate the incoming request
            $request->validate([
                'id' => 'required|exists:settings,id', // Ensure the ID exists in the database
                'value' => 'nullable|string|max:255', // For non-image values
                'image_login' => 'nullable|mimes:jpg,jpeg,png,gif,ico|max:2048', // Validate the uploaded image, including .ico
            ]);

            // Fetch the setting by ID
            $setting = Setting::findOrFail($request->id);

            // Initialize an array to store updated data
            $updatedData = [];

            // Handle image upload if ID is 1 and an image is provided
            if (in_array($request->id, [1, 13]) && $request->hasFile('image_login')) {
                $file = $request->file('image_login');

                // Define the upload path
                $uploadPath = public_path('Company Logo');

                // Create the directory if it doesn't exist
                if (!File::exists($uploadPath)) {
                    File::makeDirectory($uploadPath, 0777, true);
                }

                // Delete the old image if it exists
                if ($setting->value && File::exists(public_path($setting->value))) {
                    File::delete(public_path($setting->value));
                }

                // Generate a unique filename and move the file
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move($uploadPath, $filename);

                // Save the relative image path to the 'value' column
                $updatedData['value'] = 'Company Logo/' . $filename;
            } else {
                // For other settings, directly update the 'value' column
                $updatedData['value'] = $request->value;
            }

            // Update the setting in the database
            $setting->update($updatedData);

            return response()->json(['success' => true, 'message' => 'Setting updated successfully!']);
        }




    
}
