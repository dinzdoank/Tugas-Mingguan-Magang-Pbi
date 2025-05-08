<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderStatsController extends Controller
{
    public function index()
    {
        $totalOrder = Order::count();
        $totalPaid = Order::where('status', 'paid')->count();
        $totalRejected = Order::where('status', 'rejected')->count();
        $totalWaiting = Order::where('status', 'waiting_admin')->count();
        $totalPending = Order::where('status', 'pending')->count();
        $totalIncome = Order::where('status', 'paid')->with('product')->get()->sum(function($order) {
            return $order->product ? $order->product->price * $order->quantity : 0;
        });
        return view('admin.orders.stats', compact('totalOrder', 'totalPaid', 'totalRejected', 'totalWaiting', 'totalPending', 'totalIncome'));
    }
} 