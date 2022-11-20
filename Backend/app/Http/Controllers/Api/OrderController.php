<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function addNewOrder(Request $request)
    {
        $request->validate([
            // 'user_id' => 'required',
            'total' => 'required',
            'address'=>'required'
        ]);
        
        $order = new Order();
        $order->user_id = Auth::id();
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
    public function showOrder($id)
    {
        $order=Order::find($id);
        if($order)
        {
            return response()->json(['order'=>$order],200);
        }
        else
        {
            return response()->json(['message'=>'No Order Found'],404);
        }
    }
    public function index()
    {
        $orders=Order::all();
        if($orders)
        {
            return response()->json(['orders'=>$orders],200);
        }
        else
        {
            return response()->json(['message'=>'No Order Found'],404);
        }
    }
}
