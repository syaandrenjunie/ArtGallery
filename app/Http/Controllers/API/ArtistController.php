<?php

namespace App\Http\Controllers\API;

use App\Models\Artist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArtistController extends Controller
{
    public function index(Request $request) {
    // Start a query builder
    $query = Artist::query();

    // Filter by name
    if ($request->has('name') && $request->name != '') {
        $query->where('name', 'like', '%' . $request->name . '%');
    }

    // Filter by email containing @gmail.com
    if ($request->has('email_provider') && $request->email_provider == 'gmail') {
        $query->where('email', 'like', '%@gmail.com');
    }

    // Sorting: default is updated_at desc
    $sortField = $request->get('sort', 'updated_at');
    $sortOrder = $request->get('order', 'desc');
    $query->orderBy($sortField, $sortOrder);

    // Paginate
    $artists = $query->paginate(10);

    // Return JSON
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
