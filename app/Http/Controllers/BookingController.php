<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Arena;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\BookingRequest;

class BookingController extends Controller
{

    public $sources = [
        [
            'model'      => Booking::class,
            'date_field' => 'time_from',
            'date_field_to' => 'time_to',
            'field'      => 'user_id',
            'number'      => 'arena_id',
            'prefix'     => '',
            'suffix'     => '',
        ],
    ];

    public function index(Request $request)
    {
        $bookings = [];
        $arenas = Arena::where('status', 1)->get();

        // Debug: Log raw booking data
        \Log::info('Raw Booking Query:', [
            'count' => Booking::count(),
            'sample' => Booking::first()
        ]);

        // Ambil semua booking yang masih aktif (status 0 atau 1)
        $bookingData = Booking::whereIn('status', [0, 1])
            ->with(['user', 'arena'])
                ->get();

        // Debug: Log booking data after query
        \Log::info('Booking Data After Query:', [
            'count' => $bookingData->count(),
            'first_item' => $bookingData->first()
        ]);

        foreach ($bookingData as $booking) {
            // Pastikan semua data yang diperlukan tersedia
            if ($booking->user && $booking->arena) {
                // Format waktu ke format yang sesuai dengan FullCalendar
                $startTime = \Carbon\Carbon::parse($booking->time_from)->format('Y-m-d\TH:i:s');
                $endTime = \Carbon\Carbon::parse($booking->time_to)->format('Y-m-d\TH:i:s');

                $bookings[] = [
                    'id' => $booking->id,
                    'title' => sprintf('Lapangan %d - %s (%s - %s)', 
                        $booking->arena->number,
                        $booking->user->name,
                        \Carbon\Carbon::parse($booking->time_from)->format('H:i'),
                        \Carbon\Carbon::parse($booking->time_to)->format('H:i')
                    ),
                    'start' => $startTime,
                    'end' => $endTime,
                    'color' => '#1a73e8',
                    'textColor' => '#ffffff',
                    'allDay' => false
                ];
            }
        }

        // Debug: Log final formatted bookings
        \Log::info('Final Formatted Bookings:', [
            'count' => count($bookings),
            'data' => $bookings
        ]);

        return view('welcome', compact('arenas', 'bookings'));
    }

    public function booking(Request $request){

        $arenas = Arena::where('status', 1)->get();
        $arenaNumber = $request->get('number');

        return view('booking', compact('arenas', 'arenaNumber'));
    }

    public function store(BookingRequest $request)
    {
        if (!auth()->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Anda harus login terlebih dahulu untuk melakukan booking.',
            ], 401);
        }
    
        $arena = Arena::findOrFail($request->arena_id);
    
        $orderDate = date('Y-m-d H:i:s');
        $paymentDue = (new \DateTime($orderDate))->modify('+1 hour')->format('Y-m-d H:i:s');
        
        $booking = Booking::create($request->validated() + [
            'user_id' => auth()->id(),
            'grand_total' => $arena->price,
            'status' => !isset($request->status) ? 0 : $request->status
        ]);
    
        // Refresh bookings data dengan format yang sama
        $bookings = [];
        $bookingData = Booking::where('status', 0)
            ->with(['user', 'arena'])
            ->get();

        foreach ($bookingData as $item) {
            $startTime = \Carbon\Carbon::parse($item->time_from)->format('Y-m-d\TH:i:s');
            $endTime = \Carbon\Carbon::parse($item->time_to)->format('Y-m-d\TH:i:s');
            
            $bookings[] = [
                'id' => $item->id,
                'title' => sprintf('Lapangan %d - %s (%s - %s)', 
                    $item->arena->number,
                    $item->user->name,
                    \Carbon\Carbon::parse($item->time_from)->format('H:i'),
                    \Carbon\Carbon::parse($item->time_to)->format('H:i')
                ),
                'start' => $startTime,
                'end' => $endTime,
                'color' => '#1a73e8',
                'textColor' => '#ffffff',
                'allDay' => false
            ];
        }
    
        return response()->json([
            'success' => true,
            'message' => 'Terimakasih sudah booking, Silahkan upload bukti pembayaran!',
            'payment_due' => $paymentDue,
            'arena_number' => $arena->number,
            'user_name' => auth()->user()->name,
            'bookings' => $bookings
        ]);
    }

    public function success($paymentDue){
        $arenaNumber = session()->get('arenaNumber'); // Tambahkan ini agar arenaNumber tersedia di view
        return view('success', compact('paymentDue', 'arenaNumber'));
    }
}
