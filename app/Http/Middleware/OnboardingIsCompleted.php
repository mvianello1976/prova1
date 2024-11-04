<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OnboardingIsCompleted
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user->role->name === 'partner') {
            if (!$user->hasVerifiedEmail() || $user->onboarding_current_step < 3) {
                return redirect()->route("partners.onboarding.step-{$user->onboarding_current_step}");
            }
        }

        return $next($request);
    }
}
