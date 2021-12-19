<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        Log::debug($user);
        Session::put(['name' => $user->name,'email' => $user->email,'user_id' => $user->id]);
        Log::debug('セッション保存しました。'.$user->email.$user->email);
        $data = Session::all();
        Log::debug($data, ['file' => __FILE__, 'line' => __LINE__]);
        return view('home')->with('users',$user);
    }
}
