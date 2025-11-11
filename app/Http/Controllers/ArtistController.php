<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    public function index(){

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

    

    public function create() {
        
        return view('artists.create');
    }

    public function store(Request $request) {

        //validation
        request()->validate( [
            'name' => 'required|max:255',
            'bio' => 'max:255',
            'email' => 'email:rfc,dns|required' ,   
            'contact' =>  'required',
            'picture' => 'extensions:jpg,png',
        ]);

        //create
        Artist::create( [
            'name' => request('name'),
            'bio' => request('bio'),
            'email' => request('email'),
            'contact' => request('contact'),
            'picture' => request('picture'),
        ]);

        //redirect
        return redirect('/artists');

    }

    public function show(Artist $artist) {
        return view ('artists.show', [
            'artist' => $artist
        ]);
    }

    public function edit(Artist $artist) {
        return view('artists.edit', [
            'artist' => $artist
        ]);

    }

    public function update(Artist $artist) {
        //validate
        request()->validate([
            'name' => 'required|max:255',
            'bio' => 'max:255',
            'email' => 'email:rfc,dns|required' ,   
            'contact' =>  'required',
            'picture' => 'extensions:jpg,png',
        ]);

        //authorize on hold

        //update
        $artist->name = request('name');
        $artist->bio = request('bio');
        $artist->email = request('email');
        $artist->contact = request('contact');
        $artist->picture = request('picture');
                
        //persist
        $artist->save();

        //redirect
        return redirect('/artists/'. $artist->id);
    }

    public function destroy(Artist $artist) {
        $artist->delete();

        return redirect('/artists');

    }
}
