<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    // Form checkout
    public function index()
    {
        $cart = session()->get('cart', []);

        return view('frontend.checkout.index', compact('cart'));
    }

    // Save order
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {

            return redirect('/cart')
                ->with('error', 'Cart is empty');
        }

        // Tính tổng tiền
        $total = 0;

        foreach ($cart as $item) {

            $total += $item['price'] * $item['quantity'];

        }

        // Tạo order
        $order = Order::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'total_price' => $total,
        ]);

        // Lưu order items
        foreach ($cart as $productId => $item) {

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        // Xóa cart
        session()->forget('cart');

        return redirect('/products')
            ->with('success', 'Đặt hàng thành công!');
    }
}