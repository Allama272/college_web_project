<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Chirp;

class LikeController extends Controller
{
    public function toggleLike(Chirp $chirp){
    $user = Auth::user();
    $existingLike = $chirp->likes()->where('user_id', $user->id)->first();

    if ($existingLike) {
        $existingLike->delete();
        return response()->json(['liked' => false, 'likes_count' => $chirp->likes()->count()]);
    } else {
        $chirp->likes()->create(['user_id' => $user->id]);
        return response()->json(['liked' => true, 'likes_count' => $chirp->likes()->count()]);
    }
}

}
