<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function addNewOrder(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'total' => 'required',
            'address'=>'required'
        ]);
        
        $order = new Order();
        $order->user_id = $request->user_id;
        $order->status = 1;
        $order->total = $request->total;
        $order->address = $request->address;
        $order->save();
        if($order)
        {
            foreach($request->orderItem as $item)
            {
                $orderDetail = new OrderDetail();
                $orderDetail->order_id= $order->order_id;
                $orderDetail->product_id = $item['product_id'];
                $orderDetail->price = $item['price'];
                $orderDetail->quantity = $item['quantity'];
                $orderDetail->subtotal = $item['subtotal'];
                $orderDetail->save();
            }
        }
        
    }
}
