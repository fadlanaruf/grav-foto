<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\PhotoPackage;
use App\Models\ReservationStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    // Tampilkan daftar reservasi
    public function index()
    {
        $reservations = Reservation::where('user_id', Auth::id())
            ->with(['photoPackage', 'reservationStatus'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('reservations.index', compact('reservations'));
    }

    // Tampilkan form reservasi baru
    public function create()
    {
        $packages = PhotoPackage::where('is_active', true)->get();
        return view('reservations.create', compact('packages'));
    }

    // Store reservasi
    public function store(Request $request)
    {
        $validated = $request->validate([
            'photo_package_id' => 'required|exists:photo_packages,id',
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'required|string|max:20',
            'number_of_people' => 'required|integer|min:1',
            'photo_date' => 'required|date|after:today',
            'photo_time' => 'required',
            'notes' => 'nullable|string',
        ]);

        // Ambil package
        $package = PhotoPackage::findOrFail($validated['photo_package_id']);
        
        // Ambil status pertama (Menunggu Difoto)
        $firstStatus = ReservationStatus::orderBy('order')->first();

        $reservation = Reservation::create([
            'reservation_code' => Reservation::generateReservationCode(),
            'user_id' => Auth::id(),
            'photo_package_id' => $validated['photo_package_id'],
            'name' => $validated['name'],
            'address' => $validated['address'],
            'phone' => $validated['phone'],
            'number_of_people' => $validated['number_of_people'],
            'photo_date' => $validated['photo_date'],
            'photo_time' => $validated['photo_time'],
            'reservation_status_id' => $firstStatus->id,
            'payment_status' => 'pending',
            'payment_amount' => $package->price,
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()->route('reservations.show', $reservation)
            ->with('success', 'Reservasi berhasil dibuat! Kode reservasi Anda: ' . $reservation->reservation_code);
    }

    // Show reservasi details
    public function show(Reservation $reservation)
    {
        // Mastiin user cuman ngeliat reservasi sendiri
        if ($reservation->user_id !== Auth::id()) {
            abort(403);
        }

        $reservation->load(['photoPackage', 'reservationStatus', 'approver']);
        
        return view('reservations.show', compact('reservation'));
    }

    // Track reservasi with kode
    public function track(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        $reservation = Reservation::where('reservation_code', $request->code)
            ->with(['photoPackage', 'reservationStatus'])
            ->first();

        if (!$reservation) {
            return back()->with('error', 'Kode reservasi tidak ditemukan.');
        }

        return view('reservations.track', compact('reservation'));
    }
}
