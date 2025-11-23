<?php

namespace App\Http\Controllers\API;

use App\Models\Artwork; // Fixed: was "Artworks" (plural)
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
            $query->whereHas('artist', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->artist . '%');
            });
        }

        // General search (searches both title and artist name)
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%')
                  ->orWhereHas('artist', function($artistQuery) use ($searchTerm) {
                      $artistQuery->where('name', 'like', '%' . $searchTerm . '%');
                  });
            });
        }

        // Filter by price range
        if ($request->has('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->has('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Filter by category (if you have categories)
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        // Sorting: default is updated_at desc
        $sortField = $request->get('sort', 'updated_at');
        $sortOrder = $request->get('order', 'desc');
        
        // Validate sort field to prevent SQL injection
        $allowedSortFields = ['title', 'price', 'created_at', 'updated_at'];
        if (in_array($sortField, $allowedSortFields)) {
            $query->orderBy($sortField, $sortOrder);
        } else {
            $query->orderBy('updated_at', 'desc');
        }

        // Paginate (12 for grid layout, or 10 for list)
        $perPage = $request->get('per_page', 12);
        $artworks = $query->paginate($perPage);

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