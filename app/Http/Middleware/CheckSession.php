<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CheckSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $checkUser = Session::get('user_id');
        $checkEmail = Session::get('email');
        
        if(!$checkUser || !$checkEmail){
            Log::debug("セッション切れのためログイン画面に戻ります");
            return redirect('login');
        }else{
            Log::debug("セッションOK");
            return $next($request);
        }
    }
}
