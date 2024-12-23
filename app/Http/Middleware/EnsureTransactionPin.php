<?php

namespace App\Http\Middleware;

use App\Modules\Users\UsersFinance;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTransactionPin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response {
        $finance = UsersFinance::where('user_id', $request->user()->id)->first();

        if(!$finance->transaction_pin) {
            return redirect('/account/setup/pin');
        }
        return $next($request);
    }
}
