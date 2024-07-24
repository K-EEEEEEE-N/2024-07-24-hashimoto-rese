<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function show($id)
    {
        $shop = Shop::findOrFail($id);
        return view('detail', compact('shop'));
    }

    public function store(Request $request, Shop $shop)
    {
        $request->validate([
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'number' => 'required|integer',
        ]);

        $reservation = new Reservation();
        $reservation->user_id = Auth::id();
        $reservation->shop_id = $shop->id;
        $reservation->date = $request->date;
        $reservation->time = $request->time;
        $reservation->number = $request->number;
        $reservation->save();

        return redirect()->route('reservations.thanks');
    }
}