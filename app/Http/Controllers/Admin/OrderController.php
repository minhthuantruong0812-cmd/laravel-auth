<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    // Danh sách order
    public function index()
    {
        $orders = Order::latest()->get();

        return view('admin.orders.index', compact('orders'));
    }

    // Chi tiết order
    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }
}