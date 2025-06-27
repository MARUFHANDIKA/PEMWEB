<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\OrderList;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Response;

class OrderController extends Controller
{
    // Tampilkan semua order (admin)
    public function list()
    {
        $orders = Order::when(request('key'), function ($query) {
            $query->whereHas('user', function ($userQuery) {
                $userQuery->where('name', 'like', '%' . request('key') . '%');
            });
        })
        ->orderBy('created_at', 'desc')
        ->paginate(4);

        return view('admin.order.orderList', compact('orders'));
    }

    // Detail order (admin/user)
    public function orderList($id)
    {
        $orderList = OrderList::where('order_id', $id)->get();
        return view('orderList.orderList', compact('orderList'));
    }

    // ✅ FUNGSI CHECKOUT USER
    public function checkout()
    {
        $userId = Auth::id();
        $carts = Cart::with('product')->where('user_id', $userId)->get();

        if ($carts->isEmpty()) {
            return back()->with('error', 'Keranjang kosong.');
        }

        $totalPrice = 0;

        foreach ($carts as $cart) {
            $totalPrice += $cart->product->price * $cart->quantity;
        }

        // Simpan order utama
        $order = Order::create([
            'user_id' => $userId,
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        // Simpan detail dan kurangi stok
        foreach ($carts as $cart) {
            $product = Product::find($cart->product_id);

            // Cek stok cukup
            if ($product->stock < $cart->quantity) {
                return back()->with('error', "Stok untuk {$product->name} tidak mencukupi.");
            }

            // Kurangi stok
            $product->stock -= $cart->quantity;
            $product->save();

            // Simpan ke order list
            OrderList::create([
                'user_id'   => $userId,
                'product_id'=> $cart->product_id,
                'order_id'  => $order->id,
                'qty'       => $cart->quantity,
                'total'     => $cart->product->price * $cart->quantity,
                'orderCode' => strtoupper(Str::random(10)),
            ]);
        }

        // Hapus semua cart user
        Cart::where('user_id', $userId)->delete();

        return redirect()->route('user#home')->with('success', 'Checkout berhasil!');
    }

public function downloadCSV()
{
    $orders = Order::with('user')->get();

    $filename = "orders_" . now()->format('Ymd_His') . ".csv";
    $headers = [
        "Content-type"        => "text/csv",
        "Content-Disposition" => "attachment; filename=$filename",
        "Pragma"              => "no-cache",
        "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
        "Expires"             => "0"
    ];

    $callback = function () use ($orders) {
        $file = fopen('php://output', 'w');

        // Header CSV
        fputcsv($file, ['Order ID', 'User ID', 'User Name', 'Order Date', 'Total Price', 'Status']);

        // Isi Data
        foreach ($orders as $order) {
            fputcsv($file, [
                $order->id,
                $order->user->id,
                $order->user->name,
                $order->created_at->format('Y-m-d H:i'),
                $order->total_price,
                $order->status == 0 ? 'Pending' : ($order->status == 1 ? 'Approve' : 'Reject')
            ]);
        }

        fclose($file);
    };

    return Response::stream($callback, 200, $headers);
}
}
