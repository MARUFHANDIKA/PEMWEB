<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use App\Models\OrderList;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Helpers\OrderCodeHelper;


class CheckoutController extends Controller
{
    public function index()
    {
        $carts = Cart::with('product')->where('user_id', Auth::id())->get();
        return view('user.cart.checkout', compact('carts'));
    }

    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'payment_method' => 'required',
            'receipt' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        // Upload gambar
        $imagePath = $request->file('receipt')->store('receipts', 'public');

        // Hitung total harga
        $carts = Cart::with('product')->where('user_id', Auth::id())->get();
        $total = 0;
        foreach ($carts as $cart) {
            $total += $cart->product->price * $cart->quantity;
        }

        // Simpan order
        $order = Order::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'payment_method' => $request->payment_method,
            'receipt' => $imagePath,
            'status' => 'pending',
            'total_price' => $total, // 🟢 tambahkan ini
        ]);

        // Simpan order detail
        $orderCode = OrderCodeHelper::generate($order->id);

        foreach ($carts as $cart) {
            $qty = $cart->quantity;
            $price = $cart->product->price;
            $subtotal = $qty * $price;

            OrderList::create([
                'order_id' => $order->id,
                'user_id' => Auth::id(),
                'product_id' => $cart->product_id,
                'qty' => $qty,
                'price' => $price,
                'total' => $subtotal,
                'orderCode' => $orderCode, // 👍 otomatis
            ]);
        }



        // Bersihkan cart
        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('user#home')->with(['success' => 'Pesanan berhasil dikirim!']);
    }


}
