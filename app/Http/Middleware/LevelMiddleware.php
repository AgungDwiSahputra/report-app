<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LevelMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$levels)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect('page.login')->with('error', 'Kamu belum melakukan Login.');
        }elseif(!in_array($user->level, $levels)){
            return redirect('page.profile')->with('error', 'Kamu tidak memiliki akses ke halaman ini.');
        }else{
            return redirect('page.profile')->with('error', 'Kamu tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}
