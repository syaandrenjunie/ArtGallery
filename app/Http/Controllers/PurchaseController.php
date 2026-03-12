<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{


    public function index()
    {

        $purchases = Purchase::with('artwork')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('purchases.index', compact('purchases'));
    }

    /**
     * Show purchase form
     */
    public function create(Artwork $artwork)
    {
        return view('purchases.create', [
            'artwork' => $artwork
        ]);
    }


    /**
     * Store purchase
     */
    public function store(Request $request, Artwork $artwork)
    {
        $request->validate([
            'payment_method' => ['required', 'string'],
            'account_number' => ['required', 'string', 'max:255'],
            'payment_proof' => ['nullable', 'image', 'max:2048']
        ]);

        $paymentProofPath = null;

        if ($request->hasFile('payment_proof')) {
            $paymentProofPath = $request->file('payment_proof')
                ->store('payment_proofs', 'public');
        }

        Purchase::create([
            'user_id' => Auth::id(),
            'artist_id' => $artwork->artist_id,
            'artwork_id' => $artwork->id,
            'payment_method' => $request->payment_method,
            'account_number' => $request->account_number,
            'payment_proof' => $paymentProofPath,
            'status' => 'to_ship'
        ]);

        // mark artwork as sold
        $artwork->update([
            'status' => 'sold'
        ]);

        return redirect()
            ->route('artworks.show', $artwork->id)
            ->with('success', 'Purchase submitted successfully.');
    }

    
}