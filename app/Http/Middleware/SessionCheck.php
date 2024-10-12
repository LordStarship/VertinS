<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

class SessionCheck
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('loggedUser') && Route::currentRouteName() != 'index') {
            return Redirect::route('index');
        }

        return $next($request);
    }
}