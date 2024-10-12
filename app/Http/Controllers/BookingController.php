<?php

namespace App\Http\Controllers;


use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingCreated;
use App\Mail\BookingStatusUpdated;

class BookingController extends Controller
{
    // Show the public booking form
    public function showBookingForm()
    {
        return view('book');
    }

    // Store booking in the database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'event_date' => 'required|date|after:today',
            'guests' => 'required|integer|min:1',
        ]);

        $booking = Booking::create($validated);

        // Send notification emails to admin and booker
        Mail::to('hansopoku360@gmail.com')->send(new BookingCreated($booking));
        Mail::to($booking->email)->send(new BookingCreated($booking));

        return redirect('/book')->with('success', 'Booking submitted successfully!');
    }
    // Admin dashboard to view bookings
    public function index()
    {
        $bookings = Booking::all();
        return view('admin.bookings', compact('bookings'));
    }

    // Accept a booking
    public function accept(Booking $booking)
    {
        $booking->update(['status' => 'accepted']);
        return back()->with('success', 'Booking accepted.');
    }

    // Decline a booking
    public function decline(Booking $booking)
    {
        $booking->update(['status' => 'declined']);
        return back()->with('success', 'Booking declined.');
    }
}
