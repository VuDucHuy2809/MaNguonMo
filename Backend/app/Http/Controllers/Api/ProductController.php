<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Category;
use App\Models\OrderDetail;
use App\Models\Product;
use Carbon\Carbon;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $products = Product::all();
        $products=Product::paginate(8);
        if($products)
        {
            return response()->json(['products'=>$products],200);
        }
        else
        {
            return response()->json(['message'=>'No Product Found'],404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'subcate_id'=>'required',
            'quantity'=>'required|numeric',
            'price' => 'required|numeric',
            // 'sale_price'=>'required|numeric',
            'image' =>'required',
            'description'=> 'required',
            //'status'=>'required'    
        ]);
        $product= new Product;
        $product->name = $request->name;
        $product->subcate_id=$request->subcate_id;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->description = $request->description;
        //$product->status  = $request->status;
        $product->sale_price=$request->sale_price;
        $product->status=1;
        $product->discount_id=1;
        // $imageName = Carbon::now()->timestamp.'.'.$request->image->extension();
        // $request->image->storeAs('products',$imageName);
        // $product->image = $imageName;
        //$product->image=Controller::uploadImage($request->file('image'));
        // $product->brand_id = $request->brand_id;
        $response = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();
        $product->image=$response;
        if($product->save())
            return response()->json(['message'=>'Product Added Successfully','test'=>$request->image],200);
        else
            return response()->json(['message'=>'Product Added Fail']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function pagination($page)
    {
        $product=Product::paginate(2);
        return response()->json(['products'=>$product],200);
    }*/
    public function show($id)
    {
        $products=Product::find($id);
        if($products)
        {
            return response()->json(['products'=>$products],200);
        }
        else
        {
            return response()->json(['message'=>'No Product Found'],404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required',
            'quantity'=>'required',
            'price' => 'required',
            'description'=> 'required',
            'status'=>'required',
            'subcate_id'=>'required'
        ]); 
        $product= Product::find($id);
        //return response()->json(['message'=>'Product Update  Successfully'],200);
        if($product)
        {
            $product->name = $request->name;
            $product->quantity = $request->quantity;
            $product->price = $request->price;
            $product->description = $request->description;
            $product->status  = $request->status;
            $product->subcate_id = $request->subcate_id;
            if($request->discount_id)
            {
                $product->discount_id = $request->discount_id;
            }
            else
            {
                $product->discount_id = 0;
            }
            if($request->sale_price)
            {
                $product->sale_price=$request->sale_price;
            }
            else
            {
                $product->sale_price=0;
            }
            $product->update();
            return response()->json(['message'=>'Product Update Successfully'],200);
        }
        else
        {
            return response()->json(['message'=>'No Product Found'],404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product= Product::find($id);
        if($product)
        {
            $product->delete();
             return response()->json(['message'=>'Delete Product Successfully']);
        }
        else
        {
            return response()->json(['message'=>'No Product Found']);
        }
    }
    // public function paginateProduct($page)
    // {
        
    // }
    public function statistical1()
    {
        $product=Product::getStatistical1();
        return response()->json(['statistical'=>$product]);
    }
    public function statistical2()
    {
        for($i=1;$i<=12;$i++)
        {
            $product[$i]=Product::getStatistical2($i);
        }
        return response()->json(['statistical'=>$product]);
    }

    public function filterByCategoryID($id)
    {
        $product = Product::where('subcate_id',$id)->get();
        if($product)
        {
             return response()->json(['product'=>$product],200);
        }
        else
        {
            return response()->json(['message','No Product Found'],404);
        }
    }

    public function searchProduct(Request $request)
    {
        $search = $request->search;
    }
    public function test()
    {
        // $user = Account::find($user_id=Auth::id());
        // return $user->is_admin;
    }
    public function test2()
    {
        
    }
}
