<?php

namespace App\Http\Controllers;

use App\Models\order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index() {
        $order = order::orderByDesc('created_at')->get();

        return view('order.order-data', compact('order'));
    }

    public function insertOrder(Request $request){
    $validatedData = $request->validate([
        'customer_id' => 'required|numeric',
        'name' => 'required|string|max:100',
        'number' => 'required|string|max:50',
        'email' => 'required|string|email|max:50',
        'method' => 'required|string|max:50',
        'address' => 'required|string|max:100',
        'total_products' => 'required|string|max:50',
        'total_price' => 'required|integer',
        'event_time' => 'required|date',
        'order_status' => 'nullable|string|max:255',
        'proof_payment' => 'nullable|string|max:255',
        'payment_status' => 'nullable|string|max:255',
    ]);

    $order = Order::create($validatedData);
    return response()->json(['message' => 'Order berhasil ditambahkan.', 'order' => $order]);
}

    public function update(Request $request, $id)
{
    $order = Order::findOrFail($id);

    $orderStatus = $request->input('order_status');
    $paymentStatus = $request->input('payment_status');

    // Cek apakah ada perubahan
    if ($orderStatus == $order->order_status && $paymentStatus == $order->payment_status) {
        return back()->with('warning3', 'Tidak ada perubahan yang dilakukan.');
    }

    // Lakukan pembaruan data
    $order->order_status = $orderStatus;
    $order->payment_status = $paymentStatus;
    $order->save();

    // Set pesan berdasarkan kombinasi status
    $messages = [];
    if ($orderStatus == 'Ditolak' && $paymentStatus == 'Belum lunas') {
        $messages['warning'] = 'Order ditolak!';
        $messages['warning2'] = 'Order belum lunas!';
    } elseif ($orderStatus == 'Ditolak' && $paymentStatus == 'Lunas') {
        $messages['warning'] = 'Order ditolak!';
        $messages['success'] = 'Order lunas!';
    } elseif ($orderStatus == 'Diterima' && $paymentStatus == 'Belum lunas') {
        $messages['success'] = 'Order diterima!';
        $messages['warning'] = 'Order belum lunas!';
    } elseif ($orderStatus == 'Diterima' && $paymentStatus == 'Lunas') {
        $messages['success'] = 'Order diterima!';
        $messages['success2'] = 'Order lunas!';
    } elseif ($orderStatus == 'Diterima' && $paymentStatus == null) {
        $messages['success'] = 'Order diterima!';
    } elseif ($orderStatus == 'Ditolak' && $paymentStatus == null) {
        $messages['success'] = 'Order ditolak!';
    } elseif ($orderStatus == null && $paymentStatus == 'Belum lunas') {
        $messages['success'] = 'Belum lunas!';
    } elseif ($orderStatus == null && $paymentStatus == 'Lunas') {
        $messages['success'] = 'Lunas!';
    } else {
        return back()->withErrors(['warning' => 'Terjadi Error!']);
    }

    return back()->with($messages);
}



    public function destroy(Request $request) {

        $order = $request->input('order');

        if (empty($order)) {
            return back()->with('error', 'Select the item first.');
        }

        foreach ($order as $orderId) {
            $order = Order::findOrFail($orderId);

        if ($order->proof_payment) {
            $oldFilePath = public_path('bukti/'.$order->proof_payment);
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        }
        $order->delete();
    }
        return back()->with('success', 'Order deleted.');
    }

    public function show() {
        $order = order::orderByDesc('created_at')->get();

        return view('order.order-update', compact('order'));
    }
}
