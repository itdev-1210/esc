<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Carbon\Carbon;

class Company
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->user()) {
            return redirect('/login');
        }

        $user = User::with('company_details')->find($request->user()->id);

        if ($request->user() && !$user->company_details) {
            return redirect('/register-company');
        }

        if ($request->user()->is_trial) {
            $expireDate = Carbon::parse($request->user()->created_at)->addDays(14);
            if ($expireDate->gte(Carbon::now())) {
                return $next($request);
            } else {
                return redirect('subscription');
            }
        }

        if ($request->user() && !$request->user()->subscribed('main')) {
            return redirect('subscription');
        } else {
            return $next($request);
        }
    }
}
