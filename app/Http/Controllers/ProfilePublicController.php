<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Chirp;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\User;
use Ramsey\Uuid\Type\Integer;
use Illuminate\Support\Facades\Auth;

class ProfilePublicController extends Controller
{
    public function view( User $prof_user){
        // $profileUser = User::where('id= $user_id')->latest()->get();
        $userChirps = Chirp::where('user_id',$prof_user->id)->with(['user:id,name', 'likes.user:id,name'])
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
                'total_likes' => $chirp->likes_count
            ]);
        });
        $followers = $prof_user->getFollowersCountAttribute();
        // dd($prof_user->followers());
        return Inertia::render('ProfilePublic/ProfilePublic', [
            'pub_user'=>$prof_user,
            'user_chirps'=>$userChirps,
            'user_followers'=> $followers,
            'user_following'=> $prof_user->getFollowingCountAttribute(),
            'isFollowing' => Auth::user() ? Auth::user()->isFollowing($prof_user) : false,
            ]);
    }
}
