<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isRestaurant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Periksa apakah pengguna saat ini adalah restoran
        if (Auth::check() && Auth::user()->is_resto == 1) {
            return $next($request);
        }

        // Jika tidak, redirect ke halaman yang sesuai atau tampilkan pesan kesalahan
        return redirect('/')->with('error', 'You are not authorized to access this resource.');
    }
}
