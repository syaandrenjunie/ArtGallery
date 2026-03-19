<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
    // Validate
    $request->validate([
        'name'    => 'required|max:255',
        'bio'     => 'max:255',
        'email'   => 'email:rfc,dns|required',
        'contact' => 'required',
        'picture' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
    ]);

    // Handle picture upload
    if ($request->hasFile('picture')) {
        // Delete old picture if exists
        if ($artist->picture) {
            $oldPath = str_replace(asset('storage/') . '/', '', $artist->picture);
            if (Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
        }

        // Store new picture and save full URL
        $path = $request->file('picture')->store('artists', 'public');
        $artist->picture = asset('storage/' . $path);
    }

    // Update other fields
    $artist->name    = $request->input('name');
    $artist->bio     = $request->input('bio');
    $artist->email   = $request->input('email');
    $artist->contact = $request->input('contact');

    // Persist
    $artist->save();

    return response()->json([
        'message' => 'Artist updated',
        'artist'  => $artist
    ]);
}
}