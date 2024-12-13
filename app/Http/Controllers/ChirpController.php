<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use App\Models\Chirp;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
{
    return Inertia::render('Chirps/Index', [
        'chirps' => Chirp::with(['user:id,name', 'likes.user:id,name'])
            ->withCount('likes')
            ->when(Auth::check(), function ($query) {
                $query->with(['likes' => function ($query) {
                    $query->where('user_id', Auth::id());
                }]);
            })
            ->latest()
            ->get()
            ->map(function ($chirp) {
                return array_merge($chirp->toArray(), [
                    'liked_by_user' => Auth::check()
                        ? $chirp->likes->where('user_id', Auth::id())->isNotEmpty()
                        : false,
                    'total_likes' => $chirp->likes_count]);
            })
             ,'followingUsers'=> Auth::user()->following()->get()]);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $request->user()->chirps()->create($validated);

        return Redirect::back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Chirp $chirp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chirp $chirp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chirp $chirp): RedirectResponse
    {
        //
        Gate::authorize('update', $chirp);

        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $chirp->update($validated);

        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp): RedirectResponse
    {
        //
        Gate::authorize('delete', $chirp);

        $chirp->delete();
        return Redirect::back();
    }
}
