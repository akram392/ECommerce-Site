<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
use Session;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ( Auth::user()->is_admin == 1 ) {
            # code...
            return $next($request);                         // If you are admin, you will go to admin panel.
        }
        else if (Auth::user()->is_admin == 2) {
            # code...
            Auth::guard('web')->logout();                   // If you are not admin , logout your session
            $request->session()->invalidate();              // regernerate your invalitade session
            $request->session()->regenerateToken();         // regenerate your session token, you need again login your account

            $notification = array (
                'message' => 'You have not Access the Page!!!',
                'alert-type' => 'error',
            );
            return redirect()->route('homepage')->with($notification);
        }
    }
}
