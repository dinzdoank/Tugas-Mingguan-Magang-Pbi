<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Mail\OrderPaidMail;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'address' => 'required|string',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'note' => 'nullable|string',
        ]);

        $product = Product::findOrFail($request->product_id);
        if ($product->stock < $request->quantity) {
            return back()->with('error', 'Stok produk tidak mencukupi.');
        }

        // Simpan order
        $order = Order::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'note' => $request->note,
        ]);

        // Kurangi stok produk
        $product->stock -= $request->quantity;
        $product->save();

        // Redirect ke halaman konfirmasi pembayaran
        return redirect()->route('order.confirmation', $order);
    }

    public function showConfirmation(Order $order)
    {
        return view('order.confirmation', compact('order'));
    }

    public function confirmPayment(Order $order)
    {
        $order->status = 'waiting_admin';
        $order->save();
        return redirect('/')->with('success', 'Pembayaran Anda menunggu verifikasi admin.');
    }

    // ADMIN: Setujui pembayaran
    public function approvePayment(Order $order)
    {
        $order->status = 'paid';
        $order->save();
        return back()->with('success', 'Pembayaran telah disetujui.');
    }

    // ADMIN: Tolak pembayaran
    public function rejectPayment(Request $request, Order $order)
    {
        $request->validate([
            'reject_reason' => 'nullable|string|max:255',
        ]);
        $order->status = 'rejected';
        $order->note = $order->note ? $order->note . "\n[Alasan Ditolak: {$request->reject_reason}]" : "[Alasan Ditolak: {$request->reject_reason}]";
        $order->save();
        // Kembalikan stok produk
        if ($order->product) {
            $order->product->stock += $order->quantity;
            $order->product->save();
        }
        return back()->with('success', 'Pembayaran telah ditolak dan stok produk dikembalikan.');
    }

    // ADMIN: Tampilkan daftar order
    public function indexAdmin()
    {
        $orders = \App\Models\Order::with('product')->orderByDesc('created_at')->get();
        return view('admin.orders.index', compact('orders'));
    }

    // USER: Tampilkan daftar order milik user yang sedang login
    public function userOrders()
    {
        $orders = \App\Models\Order::with('product')
            ->where('email', auth()->user()->email)
            ->orderByDesc('created_at')
            ->get();
        return view('order.user_orders', compact('orders'));
    }

    public function create(Product $product)
    {
        return view('order.create', compact('product'));
    }
} 