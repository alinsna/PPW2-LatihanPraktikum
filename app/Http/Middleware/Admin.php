<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use app\Http\Controllers\AdminController;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah pengguna sudah login dan memiliki level 'admin'
        if (Auth::check() && Auth::user()->level != 'admin') {
            return redirect()->route('dashboard'); // Izinkan akses ke halaman admin
        }

        // Jika bukan 'admin', arahkan ke halaman beranda (/home)
        return $next ($request);
    }
}
