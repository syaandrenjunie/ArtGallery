<?php

namespace App\Http\Controllers\API;

use App\Models\Artist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArtistController extends Controller
{
    public function index()
    {
        // Returns all artists (for initial page load)
        return response()->json([
            'data' => Artist::all()
        ]);
    }

    public function search(Request $request)
    {
        $query = Artist::query();

        // Search across name, bio, and email
        if ($request->has('name') && !empty($request->name)) {
            $searchTerm = $request->name;

            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('bio', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('email', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        $artists = $query->get();

        return response()->json([
            'data' => $artists
        ]);
    }

    public function store(Request $request)
    {
        //Validate 
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'email' => 'required|email',
            'contact' => 'required|string',
            'picture' => 'nullable|image|max:2048',
        ]);

        //Handle file upload
        if ($request->hasFile('picture')) {
            $validated['picture'] = $request->file('picture')
                ->store('artists', 'public');
        }

        //Create artist
        $artist = Artist::create($validated);

        //Return API response
        return response()->json([
            'message' => 'Artist created successfully',
            'artist' => $artist
        ], 201);
    }

    public function show($id)
    {
        $artist = Artist::find($id);

        if (!$artist) {
            return response()->json(['message' => 'Artist not found'], 404);
        }

        return response()->json($artist);
    }

    public function update(Request $request, Artist $artist)
    {
        $artist->update($request->except('picture'));

        if ($request->hasFile('picture')) {
            // handle upload later
        }

        return response()->json([
            'message' => 'Artist updated',
            'artist' => $artist
        ]);
    }
}