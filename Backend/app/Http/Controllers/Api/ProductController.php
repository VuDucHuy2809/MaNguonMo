<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        $products=Product::paginate(6);
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
            'sale_price'=>'required|numeric',
            //'image' =>'required',
            'description'=> 'required'
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
        // $imageName = Carbon::now()->timestamp.'.'.$request->image->extension();
        // $request->image->storeAs('products',$imageName);
        // $product->image = $imageName;
        //$product->image=Controller::uploadImage($request->file('image'));
        /*$response = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();
        $product->image=$response;*/
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
            'status'=>'required'
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
            return response()->json(['message','No Product Found']);
        }
    }
    // public function paginateProduct($page)
    // {
        
    // }
}
