<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ProviderLoggedOut
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
   * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
   */
  public function handle(Request $request, Closure $next)
  {
    if (session()->has('provider_id')) {
      return redirect('provider/profile');
    } else {
      return $next($request);
    }
  }
}
