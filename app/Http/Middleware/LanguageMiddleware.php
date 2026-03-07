<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;

class LanguageMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Check if locale is stored in session
        if ($request->session()->has('locale')) {
            $locale = $request->session()->get('locale');
            App::setLocale($locale);
        }
        
        return $next($request);
    }
}
