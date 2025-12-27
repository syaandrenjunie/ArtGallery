<?php

namespace App\Http\Controllers\API;

use App\Models\Artist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArtistController extends Controller
{
    public function index()
    {

        return Artist::all();
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
