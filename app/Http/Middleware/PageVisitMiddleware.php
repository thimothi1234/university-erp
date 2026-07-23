<?php

// app/Http/Middleware/PageVisitMiddleware.php

namespace App\Http\Middleware;

use Closure;
use App\Models\PageVisit;
use Illuminate\Support\Facades\Auth;

class PageVisitMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $pageVisit = PageVisit::where('user_id', $user->id)->first();

            if (!$pageVisit) {
                PageVisit::create(['user_id' => $user->id]);
            } else {
                $pageVisit->increment('visit_count');
            }
        }

        return $next($request);
    }
}
