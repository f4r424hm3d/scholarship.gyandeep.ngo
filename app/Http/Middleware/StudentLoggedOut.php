<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class StudentLoggedOut
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
    if (session()->has('student_id')) {
      return redirect('profile');
    } else {
      return $next($request);
    }
  }
}
