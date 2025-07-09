<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // 1. Tampilkan isi keranjang user
    public function index()
    {
        $carts = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        return view('user.cart', compact('carts'));
    }

    // 2. Tambah produk ke keranjang
    public function addToCart(Request $request)
    {
        $productId = $request->product_id;
        $quantity = $request->quantity ?? 1;

        $product = Product::findOrFail($productId);

        // Cek jika sudah ada di cart
        $cart = Cart::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->first();

        if ($cart) {
            $cart->quantity += $quantity;
            $cart->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
        }

        return redirect()->route('user#carts')->with('success', 'Produk ditambahkan ke keranjang.');
    }

    // 3. Hapus satu item dari cart
    public function remove($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();

        return back()->with('success', 'Item berhasil dihapus.');
    }

    // 4. Kosongkan semua cart user
    public function clear()
    {
        Cart::where('user_id', Auth::id())->delete();
        return back()->with('success', 'Keranjang dikosongkan.');
    }

    // 5. Update jumlah item
    public function updateQty(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);
        $cart->quantity = $request->quantity;
        $cart->save();

        return back()->with('success', 'Jumlah berhasil diperbarui.');
    }

    public function removeAjax($id)
    {
        $cart = Cart::find($id);

        if ($cart && $cart->user_id == Auth::id()) {
            $cart->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Item tidak ditemukan atau tidak memiliki akses.']);
    }

}
