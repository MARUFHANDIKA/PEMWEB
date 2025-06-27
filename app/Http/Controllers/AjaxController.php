<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    public function menuList(Request $request)
    {
        if ($request->status == 'asc') {
            $menu = Product::orderBy('created_at', 'asc')->get();
        } elseif ($request->status == 'desc') {
            $menu = Product::orderBy('created_at', 'desc')->get();
        } else {
            $menu = Product::orderBy('view_count', 'asc')->get();
        }
        return response()->json($menu, 200);
    }

    public function autoAddToCart(Request $request)
    {
        $userId = Auth::user()->id;
        $count = 1;
        $productId = intval($request->menuId);
        $data = [
            'user_id' => $userId,
            'product_id' => $productId,
            'quantity' => $count
        ];
        Cart::create($data);

        $response = [
            'message' => 'Item added to the cart successfully',
            'status' => 'success',
        ];
        return response()->json($response, 200);
    }

    public function addToCart(Request $request)
    {
        $data = $this->getData($request);
        Cart::create($data);

        $response = [
            'message' => 'Item Added to the cart successfully !!',
            'status' => 'success',
        ];
        return response()->json($response, 200);
    }

    public function order(Request $request)
    {
        try {
            $orderData = $this->getOrderData($request->order);
            $order = Order::create($orderData);
            $total = 0;

            foreach ($request->orderList as $item) {
                $product = Product::find($item['product_id']);

                if (!$product || $product->stock < $item['qty']) {
                    return response()->json([
                        'status' => 'fail',
                        'message' => 'Stok tidak mencukupi untuk produk: ' . ($product->name ?? 'Unknown')
                    ], 400);
                }

                $product->stock -= $item['qty'];
                $product->save();

                $orderList = OrderList::create([
                    'user_id' => $item['user_id'],
                    'product_id' => $item['product_id'],
                    'qty' => $item['qty'],
                    'total' => $item['total'],
                    'orderCode' => $item['order_code'],
                    'order_id' => $order->id,
                ]);

                $total += $orderList->total;
            }

            Cart::where('user_id', Auth::user()->id)->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Pesanan berhasil dibuat dan stok diperbarui.',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function filterOrders(Request $request)
    {
        if ($request->status == 'all') {
            $orders = Order::join('users', 'orders.user_id', '=', 'users.id')
                ->join('order_lists', 'orders.id', '=', 'order_lists.order_id')
                ->select('orders.*', 'users.name')
                ->withCount('orderLists')
                ->orderBy('created_at', 'desc')
                ->distinct()
                ->get();
        } else {
            $orders = Order::where('status', $request->status)
                ->join('users', 'orders.user_id', '=', 'users.id')
                ->join('order_lists', 'orders.id', '=', 'order_lists.order_id')
                ->select('orders.*', 'users.name')
                ->withCount('orderLists')
                ->orderBy('created_at', 'desc')
                ->distinct()
                ->get();
        }
        return response()->json($orders, 200);
    }

    public function clearCart()
    {
        Cart::where('user_id', Auth::user()->id)->delete();
    }

    public function remove(Request $request)
    {
        Cart::where('product_id', $request->productId)
            ->where('user_id', Auth::user()->id)
            ->delete();
    }

    public function orderStatus(Request $request)
    {
        Order::where('id', $request->orderId)->update(['status' => $request->orderStatus]);
    }

    // Helpers
    private function getData($request)
    {
        return [
            'user_id' => $request->userId,
            'product_id' => $request->menuId,
            'quantity' => $request->count,
        ];
    }

    private function getOrderData($request)
    {
        return [
            'user_id' => $request['user_id'],
            'total_price' => $request['total_price'],
        ];
    }
}