<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
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
        $order->status = 'Ordered';
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
                $orderDetail->subtotal = $item['price']*$item['quantity'];
                $orderDetail->size = $item['size'];
                $orderDetail->save();
                $product=Product::find($item['product_id']);
                $product->quantity-= $item['quantity'];
                $product->update();
            }
            return response()->json(['message'=>'Order Successfully!']);
        }
        return response()->json(['message'=>'Fail!']);
        
    }
    public function showOrderDetail($id)
    {
        $order=Order::getDetailOrder($id);
        if($order)
        {
            return response()->json(['orders'=>$order],200);
        }
        else
        {
            return response()->json(['message'=>'No Order Found'],404);
        }
    }
    public function showOrder()
    {
        $user_id = Auth::id();
        $order = Order::where('user_id',$user_id)->get();
        if($order)
        {
            return response()->json(['order'=>$order],200);
        }
        else
        {
            return response()->json(['message'=>'No Order Found'],404);
        }
    }
    //for admin
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
    public function update($id)
    {
        $order=Order::find($id);
        $user_id=Auth::id();
        $user = Account::find($user_id);
        if($user->is_admin == 0){
            if($order->status == 'Ordered')
            {
                $order->status = 'Canceled';
                $order->update();
                $orderItem = OrderDetail::where('order_id',$id)->get();
                foreach($orderItem as $item)
                {
                    $product = Product::find($item->product_id);
                    $product->quantity += $item['quantity'];
                    $product->update();
                }
                return response()->json(['message'=>'Cancel Order Successfully!']);
            }
            else
            {
                return response()->json(['message'=>'You cannot cancel this order']);
            }  
        }
        // elseif($user->is_admin == 1)
        // {
        //     switch($order->status){
        //         case
        //     }
        // }
        }
    public function updateStatus($id)
    {
        $order= Order::find($id);
        if($order->status=="Ordered")
        {
            $order->status="Confirmed";
            $order->update();
            return response()->json(['message'=>'Status update success(confirmed)'],200);
        }
        else if($order->status=="Confirmed")
        {
            $order->status="Delivered";
            $order->update();
            return response()->json(['message'=>'Status update success(delivery)'],200);
        }
        else
        {
            return response()->json(['message'=>'Fail'],200);
        }
    }
    public function cancelStatus($id)
    {
        $order= Order::find($id);
        $order->status="Cancelled";
        $order->update();
        return response()->json(['message'=>'Status update success(cancelled)'],200);
    }
}
