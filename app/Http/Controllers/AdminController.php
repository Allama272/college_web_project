<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Chirp;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(): Response|RedirectResponse
    {
        if (Auth::user()->is_admin) {
            return Inertia::render('Admin', ['chirps' => Chirp::with('user:id,name')->latest()->get(),]);
        } else {
            return Redirect::route('Home');
        }

    }

    public function destroy(Chirp $chirp): RedirectResponse
    {
        //
        if (Auth::user()->is_admin) {
            $chirp->delete();
            return Redirect::back();
        } else {
            return Redirect::route('Home');
        }

        $chirp->delete();
        return Redirect::back();
    }
}
