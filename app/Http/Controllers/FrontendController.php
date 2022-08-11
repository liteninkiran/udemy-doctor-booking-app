<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Models\User;

class FrontendController extends Controller
{
    public function index()
    {
        $doctors = User::whereHas('role', function(Builder $query) {
            $query->where('name', '=', 'doctor');
        })->get();
        return view('welcome', compact('doctors'));
    }
}
