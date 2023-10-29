<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $listingId = $request->route("listing")->id;
        $user = auth()->user();

        if ($user->listings->contains($listingId)) {
            return $next($request);
        }

        return redirect(route('index'));
    }
}
