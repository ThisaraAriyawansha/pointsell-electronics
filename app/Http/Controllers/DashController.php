<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use illuminate\View\View;
use illuminate\Http\RedirectResponse;
use illuminate\Http\Response;
use App\Models\Dash;

class DashController extends Controller

{
    public function index()
    {
        /*$dash['header_title'] = 'Dash';
        return view ('dash.dash', $dash);*/
        return view('dash.dash'); 
        /*$dash = Dash::all();
        return view('dash.dash', compact('dash'));*/
    }
}