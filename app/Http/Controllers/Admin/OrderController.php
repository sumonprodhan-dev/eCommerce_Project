<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $data['orders'] = Order::with('user')
            ->where('status', 'pending')
            ->withCount('products')
            ->get();

        return view('admin.order.pending_order', $data);
    }

    public function approvedOrder()
    {
        $data['orders'] = Order::with('user')->where('status', 'approved')->get();

        return view('admin.order.approved_order', $data);
    }

    public function showOrder($id)
    {
        $data['order'] = Order::with('user')->where('id', $id)->first();

        return view('admin.order.show', $data);
    }
}
