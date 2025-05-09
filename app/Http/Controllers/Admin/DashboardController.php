<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;

class DashboardController extends Controller
{
    public function index(){
        $users = User::count();
        $bookings = Booking::count();
        $success = Booking::where('status', 1)->count();
        $pendings = Booking::where('status', 0)->count();
        
        $recentBookings = Booking::with(['user', 'arena'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('users', 'bookings', 'success', 'pendings', 'recentBookings'));
    }
}
