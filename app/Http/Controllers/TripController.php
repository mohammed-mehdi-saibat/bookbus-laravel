<?php

namespace App\Http\Controllers;

use App\Models\Ville;
use App\Models\Segment;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TripController extends Controller
{
    public function index()
    {
        $villes = Ville::all();
        return view('trips.index', compact('villes'));
    }

    public function search(Request $request)
    {
        if (!$request->has('departure_ville')) {
            return redirect()->route('trips.index');
        }

        $request->validate([
            'departure_ville' => 'required|exists:villes,id',
            'arrival_ville' => 'required|exists:villes,id',
            'travel_date' => 'required|date|after_or_equal:today',
        ]);

        Carbon::setLocale('fr');
        $dayName = ucfirst(Carbon::parse($request->travel_date)->translatedFormat('l'));

        $results = Segment::whereHas('departureEtape.gare', function ($query) use ($request) {
            $query->where('ville_id', $request->departure_ville);
        })
        ->whereHas('arrivalEtape.gare', function ($query) use ($request) {
            $query->where('ville_id', $request->arrival_ville);
        })
        ->whereHas('programme', function ($query) use ($dayName) {
            $query->where('departure_day', $dayName);
        })
        ->with([
            'programme.route', 
            'programme.bus', 
            'departureEtape.gare.ville', 
            'arrivalEtape.gare.ville',
            'reservations'
        ])
        ->get()
        ->map(function ($segment) {
            $bookedSeats = $segment->reservations()
                ->where('status', 'confirmed')
                ->sum('seats_reserved');
            
            $segment->seats_available = ($segment->programme->bus->capacity ?? 50) - $bookedSeats;
            return $segment;
        });

        return view('trips.results', compact('results', 'request'));
    }
}