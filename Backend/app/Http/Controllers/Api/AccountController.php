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
        $accounts=Account::getAll();
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
        $accounts=Account::find($id);
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
        $account= Account::find($id);
        //return response()->json(['message'=>'Product Update  Successfully'],200);
        if($account)
        {
            $account->name = $request->name;
            $account->address = $request->address;
            $account->phone = $request->phone;
            $account->update();
            return response()->json(['message'=>'User Update Successfully'],200);
        }
        else
        {
            return response()->json(['message'=>'No User Found'],404);
        }
    }
}
