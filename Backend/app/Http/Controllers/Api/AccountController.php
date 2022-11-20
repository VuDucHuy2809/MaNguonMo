<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Customer;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        // $products = Product::all();
        $accounts=Account::getAllCus();
        if($accounts)
        {
            return response()->json(['accounts'=>$accounts],200);
        }
        else
        {
            return response()->json(['message'=>'No Accounts Found'],404);
        }
    }
    public function show($id)
    {
        $accounts=Account::getCus($id);
        if($accounts)
        {
            return response()->json(['account'=>$accounts],200);
        }
        else
        {
            return response()->json(['message'=>'No Account Found'],404);
        }
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required',
            'address'=>'required',
            'phone' => 'required',
        ]); 
        $customer= Customer::find($id);
        //return response()->json(['message'=>'Product Update  Successfully'],200);
        if($customer)
        {
            $customer->name = $request->name;
            $customer->address = $request->address;
            $customer->phone = $request->phone;
            $customer->update();
            return response()->json(['message'=>'User Update Successfully'],200);
        }
        else
        {
            return response()->json(['message'=>'No User Found'],404);
        }
    }
}
