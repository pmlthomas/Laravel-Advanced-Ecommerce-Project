<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function French()
    {   
        session()->get('language');
        session()->forget('language');
        Session::put('language', 'fr');
        return redirect()->back();
    }

    public function English()
    {
        session()->get('language');
        session()->forget('language');
        Session::put('language', 'en');
        return redirect()->back();
    }
}
