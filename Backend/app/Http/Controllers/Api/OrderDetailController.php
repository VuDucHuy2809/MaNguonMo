<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;

class OrderDetailController extends Controller
{
    public function showOrderDetails($id)
    {
        $user_id = Auth::id();
        $orderDetails = OrderDetail::where('order_id',$id)->get();
        if($orderDetails)
        {
            return response()->json(['orderDetails'=>$orderDetails],200);
        }
        else
        {
            return response()->json(['message'=>'Not Found'],404);
        }
    }
}
