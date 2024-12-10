<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function togglefollow(User $user)
    {
        // Ensure user is authenticated
        if (!Auth::check()) {
            return response()->json(['error' => 'You must be logged in to follow users'], 401);
        }

        $currentUser = Auth::user();

        // Prevent self-following
        if ($currentUser->id === $user->id) {
            return response()->json(['error' => 'You cannot follow yourself'], 403);
        }

        // Perform follow/unfollow action
        if ($currentUser->isFollowing($user)) {
            $currentUser->unfollow($user);
            return response()->json([
                'success' => 'User unfollowed successfully',
                'following' => false,
                'followers_count' => $user->followers()->count(),
            ]);
        } else {
            $currentUser->follow($user);
            return response()->json([
                'success' => 'User followed successfully',
                'following' => true,
                'followers_count' => $user->followers()->count(),
            ]);
        }
    }
}
