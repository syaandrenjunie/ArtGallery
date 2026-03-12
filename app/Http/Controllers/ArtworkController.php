<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Artwork;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtworkController extends Controller
{
    public function index(Request $request)
    {
        $artists = Artist::all();
        $categories = Category::all();

        $query = Artwork::query();

        // Filter by status if provided
        if ($request->has('status') && in_array($request->status, ['available', 'sold'])) {
            $query->where('status', $request->status);
        }

        // Order so that available artworks come first, sold last
        $query->orderByRaw("CASE WHEN status = 'available' THEN 0 ELSE 1 END")
            ->latest('updated_at');

        $artworks = $query->paginate(12);

        return view('artworks.index', compact('artists', 'artworks', 'categories'));
    }

    public function create()
    {

        $artists = Artist::all();
        $categories = Category::all();

        return view(
            'artworks.create',
            compact('artists', 'categories')
        );

    }

    public function store(Request $request)
    {
        //validation
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'price' => ['required', 'numeric', 'min:0', 'regex:/^\d+(\.\d{1,2})?$/'],
            'picture' => 'nullable|file|mimes:jpg,jpeg,png,gif,pdf|max:10240',
            'artist_id' => 'required|exists:artists,id',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:available,sold',
        ]);

        //create
        $path = null;
        if ($request->hasFile('picture')) {
            // Store file in /storage/app/public/uploads
            $path = $request->file('picture')->store('uploads', 'public');
        }

        Artwork::create([
            'title' => request('title'),
            'price' => request('price'),
            'picture' => $path ? asset('storage/' . $path) : null,
            'artist_id' => request('artist_id'),
            'category_id' => request('category_id'),
            'status' => request('status'),
        ]);

        //redirect
        return redirect('/artworks');

    }

    public function show(Artwork $artwork)
    {
        return view('artworks.show', data: [
            'artwork' => $artwork
        ]);
    }

    public function edit(Artwork $artwork)
    {
        $artists = Artist::all();
        $categories = Category::all();


        return view('artworks.edit', compact
        ('artwork', 'artists', 'categories'));
    }

    public function update(Artwork $artwork)
    {
        // Validate
        request()->validate([
            'title' => 'required|string|max:255',
            'price' => ['required', 'numeric', 'min:0', 'regex:/^\d+(\.\d{1,2})?$/'],
            'picture' => 'nullable|file|mimes:jpg,jpeg,png,gif,pdf|max:10240',
            'artist_id' => 'required|exists:artists,id',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:available,sold',
        ]);

        // Handle picture update
        if (request()->hasFile('picture')) {
            // Delete old picture if exists
            if ($artwork->picture) {
                $oldPath = str_replace(asset('storage/'), '', $artwork->picture);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            // Store new picture
            $path = request()->file('picture')->store('uploads', 'public');
            $artwork->picture = asset('storage/' . $path);
        }

        // Update other fields
        $artwork->title = request('title');
        $artwork->price = request('price');
        $artwork->artist_id = request('artist_id');
        $artwork->category_id = request('category_id');
        $artwork->status = request('status');

        //persist
        $artwork->save();

        //redirect
        return redirect('/artworks/' . $artwork->id)
            ->with('success', 'Artwork updated successfully!');
    }


    public function destroy(Artwork $artwork)
    {
        $artwork->delete();

        //redirect
        return redirect('/artworks');
    }


    public function favorites()
    {
        $favorites = auth()->user()->favorites()
            ->with('artist')
            ->paginate(12);

        return view('artworks.favorites', compact('favorites'));
    }

    public function chat(Artwork $artwork)
    {
        return view('artworks.chat', data: [
            'artwork' => $artwork,
            'artist' => $artwork->artist
        ]);
    }
}
