<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    public function switch(Request $request)
    {
        $locale = $request->input('locale', 'en');
        
        if (!in_array($locale, ['en', 'ar'])) {
            $locale = 'en';
        }

        // Set locale in session
        $request->session()->put('locale', $locale);
        $request->session()->put('rtl', $locale === 'ar');
        
        // Set locale for current request
        App::setLocale($locale);

        return redirect()->back();
    }

    public function setLocale(Request $request, string $locale)
    {
        if (!in_array($locale, ['en', 'ar'])) {
            $locale = 'en';
        }

        // Set locale in session
        $request->session()->put('locale', $locale);
        $request->session()->put('rtl', $locale === 'ar');
        
        // Set locale for current request
        App::setLocale($locale);

        return redirect()->back();
    }
}
