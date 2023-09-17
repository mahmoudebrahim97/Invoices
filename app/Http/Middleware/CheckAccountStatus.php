<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

use function Laravel\Prompts\error;

class CheckAccountStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    // ...



public function handle(Request $request, Closure $next)
{
    if (Auth::check()) {
        $user = Auth::user();
        if ($user->status === 'مفعل') {
            return $next($request);
        } else {
            // إذا لم يكن الحساب نشطًا، قم بتسجيل الخروج باستخدام الحارس "web"
            Auth::guard('web')->logout();
            return redirect()->route('login')->with('error', 'حالة الحساب غير مفعلة.');
        }
    }

    return redirect()->route('login');
}


}

