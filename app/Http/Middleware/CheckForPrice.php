<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Session;

class CheckForPrice
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->url('products/checkout') OR
            $request->url('payments/pay') OR
            $request->url('payments/success') ) {
                if(Session::get('price') == 0) {
                    return abort(403);
                }
        }
        return $next($request);
    }
}
