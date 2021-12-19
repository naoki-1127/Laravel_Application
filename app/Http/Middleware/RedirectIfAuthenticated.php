<?php

namespace App\Http\Middleware;

use Aacotroneo\Saml2\Saml2Auth;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            Log::debug('test');
            return redirect(RouteServiceProvider::HOME);
        }

        /* else{
            if($this->auth->guest())
            {
                if ($request->ajax()){
                    return response('Unauthorized.','401');
                }
            }else{
                $saml2Auth = new Saml2Auth(Saml2Auth::loadOneLoginAuthFromIpdConfig('Trastlogin'));
                return $saml2Auth->login(URL::full());
            }
        } */

        return $next($request);
    }
}
