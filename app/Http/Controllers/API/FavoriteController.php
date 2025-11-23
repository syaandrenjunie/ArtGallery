<?php

namespace App\Http\Controllers\API;

use App\Models\Artwork;
use App\Models\Favorite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function toggle(Request $request, $artworkId)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'message' => 'Unauthenticated'
            ], 401);
        }

        $artwork = Artwork::findOrFail($artworkId);

        // Check if already favorited (ignore soft deleted)
        $favorite = Favorite::where('user_id', $user->id)
                           ->where('artwork_id', $artworkId)
                           ->first();

        if ($favorite) {
            // Force delete (permanently remove)
            $favorite->forceDelete(); // ← Changed from delete() to forceDelete()
            
            return response()->json([
                'message' => 'Removed from favorites',
                'is_favorited' => false,
                'favorites_count' => $artwork->favoritesCount()
            ]);
        } else {
            // Add favorite
            Favorite::create([
                'user_id' => $user->id,
                'artwork_id' => $artworkId
            ]);
            
            return response()->json([
                'message' => 'Added to favorites',
                'is_favorited' => true,
                'favorites_count' => $artwork->favoritesCount()
            ]);
        }
    }
}