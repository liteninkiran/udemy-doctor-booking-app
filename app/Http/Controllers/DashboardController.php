<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(Auth::user()->role->name === 'patient') {
            return view('home');
        }

        return view('dashboard');
    }
}
