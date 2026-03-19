<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtistController extends Controller
{
    public function index()
    {

        $artists = Artist::latest('updated_at')->simplePaginate(10);

        return view('artists.index', [
            'artists' => $artists
        ]);

    }

    /* JSON API
    public function apiIndex() {
        $artists = Artist::latest('updated_at')->paginate(10);

        return response()->json([
            'data' => $artists->items(),
            'current_page' => $artists->currentPage(),
            'last_page' => $artists->lastPage(),
            'per_page' => $artists->perPage(),
            'total' => $artists->total(),
        ]); 
    }
    */



    public function create()
    {

        return view('artists.create');
    }

    public function store(Request $request)
    {

        //validation
        request()->validate([
            'name' => 'required|max:255',
            'bio' => 'max:255',
            'email' => 'email:rfc,dns|required',
            'contact' => 'required',
            'picture' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);


        //create
        $path = null;
        if ($request->hasFile('picture')) {
            // Store file in /storage/app/public/uploads
            $path = $request->file('picture')->store('artists', 'public');
        }

        //create
        Artist::create([
            'name' => request('name'),
            'bio' => request('bio'),
            'email' => request('email'),
            'contact' => request('contact'),
            'picture' => $path,
        ]);

        //redirect
        return redirect('/artists');

    }

    public function show(Artist $artist)
    {
        return view('artists.show', [
            'artist' => $artist
        ]);
    }

    public function edit(Artist $artist)
    {
        return view('artists.edit', [
            'artist' => $artist
        ]);

    }

    public function update(Request $request, Artist $artist) {
    // Validate
    $request->validate([
        'name'    => 'required|max:255',
        'bio'     => 'max:255',
        'email'   => 'email|required',
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

        // Store new picture and save full URL (consistent with faker)
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

    return redirect('/artists/' . $artist->id);
}

    public function destroy(Artist $artist)
    {
        $artist->delete();

        return redirect('/artists');

    }
}
