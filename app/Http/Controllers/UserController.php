<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user) {
        return view ('users.show', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
{
    $request->validate([
        'role' => 'required'
    ]);

    // update role using Spatie
    $user->syncRoles([$request->role]);

    // if role is artist, create artist profile
    if ($request->role === 'artist') {

    $user->artist()->firstOrCreate([
        'name' => $user->name,
        'email' => $user->email,
        'contact' => $user->contact,
    ]);

} else {

    $user->artist()->delete();

}

    return redirect()->route('users.index')
        ->with('success', 'User role updated successfully');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
