<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LogVisitor
{
    public function handle(Request $request, Closure $next)
    {
        // Get logged-in user info if available
        $user = Auth::user();

        // Store visitor info in database
        DB::table('visitor_logs')->insert([
            'user_id' => $user ? $user->id : null,
            'user_name' => $user ? $user->name : 'Guest',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'url_visited' => $request->fullUrl(),
            'visited_at' => now(),
        ]);

        return $next($request);
    }
}
