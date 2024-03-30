<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckSiswaAccess
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if ($user && $user->hasRole('siswa')) {
            // Lakukan pengecekan lebih lanjut sesuai kebutuhan Anda, misalnya kelas siswa
            // Jika siswa tidak memiliki akses, arahkan mereka kembali atau ke halaman yang sesuai
            if (!$user->belongsToClass($request->kelas_id)) {
                return redirect()->back()->with('error', 'Anda tidak memiliki akses ke kelas ini.');
            }
        }

        return $next($request);
    }
}
