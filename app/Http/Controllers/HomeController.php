<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

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
        $roleName = Auth::user()->role->name;
        if($roleName === 'admin' || $roleName === 'doctor') {
            return redirect()->to('/dashboard');
        } else {
            return redirect()->to('/');
        }
    }
}
