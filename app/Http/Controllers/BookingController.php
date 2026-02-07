<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Segment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'segment_id' => 'required|exists:segments,id',
            'seats_reserved' => 'required|integer|min:1|max:10',
        ]);

        $segment = Segment::with('programme.bus')->findOrFail($request->segment_id);
        
        $bookedSeats = $segment->reservations()
            ->where('status', 'confirmed')
            ->sum('seats_reserved');
        
        $available = ($segment->programme->bus->capacity ?? 50) - $bookedSeats;

        if ($request->seats_reserved > $available) {
            return back()->with('error', 'Only ' . $available . ' seats available!');
        }

        $total_price = $segment->tariff * $request->seats_reserved;

        Reservation::create([
            'user_id' => Auth::id(),
            'segment_id' => $segment->id,
            'seats_reserved' => $request->seats_reserved,
            'total_price' => $total_price,
            'status' => 'confirmed',
        ]);

        return redirect()->route('dashboard')->with('success', 'Ticket booked successfully for ' . $request->seats_reserved . ' passenger(s)!');
    }

    public function cancel(Reservation $reservation)
    {
        if ($reservation->user_id !== auth()->id()) {
            abort(403);
        }

        $reservation->update([
            'status' => 'cancelled'
        ]);

        return back()->with('success', 'Your reservation has been cancelled.');    
    }
}