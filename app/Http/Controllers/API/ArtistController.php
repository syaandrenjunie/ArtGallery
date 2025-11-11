<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Artist;

class ArtistController extends Controller
{
    public function index() {
        $artists = Artist::latest('updated_at')->paginate(10);

        return response()->json([
            'data' => $artists->items(),
            'current_page' => $artists->currentPage(),
            'last_page' => $artists->lastPage(),
            'per_page' => $artists->perPage(),
            'total' => $artists->total(),
        ]);
    }

    public function show($id) {
        $artist = Artist::find($id);

        if (!$artist) {
            return response()->json(['message' => 'Artist not found'], 404);
        }

        return response()->json($artist);
    }
}
