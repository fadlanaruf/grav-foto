<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\PhotoPackage;
use App\Models\ReservationStatus;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_reservations' => Reservation::count(),
            'pending_reservations' => Reservation::where('approved_at', null)->count(),
            'total_packages' => PhotoPackage::count(),
            'total_users' => User::where('role', 'user')->count(),
        ];

        $recentReservations = Reservation::with(['user', 'photoPackage', 'reservationStatus'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentReservations'));
    }
}
