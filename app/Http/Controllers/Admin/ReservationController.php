<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\ReservationStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ReservationController extends Controller
{
    // Tampilkan daftar reservasi
    public function index(Request $request)
    {
        $query = Reservation::with(['user', 'photoPackage', 'reservationStatus']);

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('reservation_status_id', $request->status);
        }

        // Filter by payment status
        if ($request->has('payment') && $request->payment != '') {
            $query->where('payment_status', $request->payment);
        }

        // Filter by approval status
        if ($request->has('approved')) {
            if ($request->approved == 'yes') {
                $query->whereNotNull('approved_at');
            } elseif ($request->approved == 'no') {
                $query->whereNull('approved_at');
            }
        }

        // Filter by date range
        if ($request->has('date_from') && $request->date_from != '') {
            $query->whereDate('photo_date', '>=', $request->date_from);
        }

        if ($request->has('date_to') && $request->date_to != '') {
            $query->whereDate('photo_date', '<=', $request->date_to);
        }

        $reservations = $query->orderBy('created_at', 'desc')->paginate(20);
        $statuses = ReservationStatus::orderBy('order')->get();

        return view('admin.reservations.index', compact('reservations', 'statuses'));
    }

    // Tampilkan detail reservasi
    public function show(Reservation $reservation)
    {
        $reservation->load(['user', 'photoPackage', 'reservationStatus', 'approver', 'album']);
        $statuses = ReservationStatus::orderBy('order')->get();
        
        return view('admin.reservations.show', compact('reservation', 'statuses'));
    }

    // Setujui reservasi
    public function approve(Reservation $reservation)
    {
        $reservation->update([
            'approved_at' => now(),
            'approved_by' => Auth::id(),
        ]);

        return back()->with('success', 'Reservasi berhasil disetujui.');
    }

    // Update status reservasi
    public function updateStatus(Request $request, Reservation $reservation)
    {
        $request->validate([
            'reservation_status_id' => 'required|exists:reservation_statuses,id',
        ]);

        $reservation->update([
            'reservation_status_id' => $request->reservation_status_id,
        ]);

        return back()->with('success', 'Status reservasi berhasil diperbarui.');
    }

    // Update status pembayaran
    public function updatePayment(Request $request, Reservation $reservation)
    {
        $request->validate([
            'payment_status' => 'required|in:pending,paid,cancelled',
        ]);

        $reservation->update([
            'payment_status' => $request->payment_status,
        ]);

        return back()->with('success', 'Status pembayaran berhasil diperbarui.');
    }

    // Update catatan admin
    public function updateNotes(Request $request, Reservation $reservation)
    {
        $request->validate([
            'admin_notes' => 'nullable|string',
        ]);

        $reservation->update([
            'admin_notes' => $request->admin_notes,
        ]);

        return back()->with('success', 'Catatan admin berhasil diperbarui.');
    }

    // Hapus reservasi
    public function destroy(Reservation $reservation)
    {
        if ($reservation->proof_of_payment) {
            Storage::disk('public')->delete($reservation->proof_of_payment);
        }

        $reservation->delete();

        return back()->with('success', 'Data reservasi berhasil dihapus.');
    }
}
