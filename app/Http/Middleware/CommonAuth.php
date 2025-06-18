<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CommonAuth
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next): Response
  {
    if (session()->has('adminLoggedIn') || session()->has('userLoggedIn')) {
      return $next($request);
    }

    // Redirect based on the requested role in URL
    $role = $request->route('role');

    if ($role === 'admin') {
      return redirect('admin/login');
    } elseif ($role === 'employee') {
      return redirect('employee/login');
    }

    return redirect('/'); // default fallback
  }
}
