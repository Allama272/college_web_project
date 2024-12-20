<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Chirp;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        $chirps = Chirp::all();
        return view('admin.dashboard', compact('users', 'chirps'));
    }

}
