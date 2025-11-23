<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Artwork; // Fixed: was "Artworks" (plural)

class ArtworkController extends Controller
{
    public function index(Request $request)
    {
        // Start a query builder with artist relationship
        $query = Artwork::with('artist');

        // Search by title (artworks have 'title', not 'name')
        if ($request->has('title') && $request->title != '') {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        // Search by artist name
        if ($request->has('artist') && $request->artist != '') {
            $query->whereHas('artist', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->artist . '%');
            });
        }

        // General search (searches both title and artist name)
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%')
                    ->orWhereHas('artist', function ($artistQuery) use ($searchTerm) {
                        $artistQuery->where('name', 'like', '%' . $searchTerm . '%');
                    });
            });
        }



        // Filter by category (if you have categories)
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        // Sorting: default is updated_at desc
        $sortField = $request->get('sort', 'updated_at');
        $sortOrder = $request->get('order', 'desc');


        // Paginate
        $artworks = $query->paginate(12);
        $artworksData = $artworks->items();

        // Add favorite status for each artwork
        $user = Auth::user();
        
        foreach ($artworksData as $artwork) {
            if ($user) {
                $artwork->is_favorited = $user->hasFavorited($artwork->id);
            } else {
                $artwork->is_favorited = false;
            }
            $artwork->favorites_count = $artwork->favoritesCount();
        }

        // Return JSON
        return response()->json([
            'data' => $artworks->items(),
            'current_page' => $artworks->currentPage(),
            'last_page' => $artworks->lastPage(),
            'per_page' => $artworks->perPage(),
            'total' => $artworks->total(),
        ]);
    }

    public function show($id)
    {
        // Use with() to include artist relationship
        $artwork = Artwork::with('artist')->find($id);

        if (!$artwork) {
            return response()->json([
                'message' => 'Artwork not found'
            ], 404);
        }

        return response()->json($artwork);
    }
}