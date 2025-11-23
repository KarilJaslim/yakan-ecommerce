<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class TrackingController extends Controller
{
    public function index()
    {
        // Show tracking form
        return view('track-order');
    }

    public function track(Request $request)
    {
        $request->validate([
            'tracking_number' => 'required|string'
        ]);

        $trackingNumber = $request->tracking_number;

        // Fetch order for logged-in user
        $order = Order::where('tracking_number', $trackingNumber)
                      ->where('user_id', Auth::id())
                      ->first();

        if (!$order) {
            return back()->with('error', 'Tracking number not found.');
        }

        // Decode JSON history, fallback to empty array
        $history = $order->tracking_history ? json_decode($order->tracking_history, true) : [];

        // Include current status if not in history
        if (empty($history)) {
            $history[] = [
                'status' => $order->tracking_status,
                'date' => $order->updated_at->format('Y-m-d h:i A')
            ];
        }

        return view('track-order', [
            'tracking' => [
                'tracking_number' => $order->tracking_number,
                'status' => $order->tracking_status,
                'history' => $history
            ]
        ]);
    }
}
