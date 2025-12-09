<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;

class SystemController extends Controller
{
    public function resetSystem()
    {
        // Clear the application cache
        Artisan::call('cache:clear');

        // Optionally, provide feedback to the user
        return response()->json(['message' => 'Application cache cleared successfully.']);
    }
}
