<?php
/**
 * Created by PhpStorm.
 * User: nejc
 * Date: 28. 03. 2016
 * Time: 12:31
 */

namespace App\Http\Middleware;


use App\Models\Uporabnik;
use Closure;
use Illuminate\Support\Facades\Auth;

class Skrbnik
{
    public function handle($request, Closure $next, $guard = 'uporabnik')
    {
        $user = Auth::guard('prijavljen')->user();
        if (!($user instanceof Uporabnik)) {
            return redirect()->guest('prijava');
        }
        if (!$user->jeSkrbnik() || !$user->jeAdministrator()) {
            return redirect('/');
        }

        return $next($request);
    }
}