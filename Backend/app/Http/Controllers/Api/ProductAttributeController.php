<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;

class ProductAttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pattributes = ProductAttribute::all();
        if($pattributes)
        {
            return response()->json(['pattributes'=>$pattributes],200);
        }
        else
        {
            return response()->json(['message'=>'No Product Attribute Found'],404);
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
            'name' => 'required'
        ]);

        $pattribute= new ProductAttribute;
        $pattribute->name = $request->name;
        $pattribute->save();
        return response()->json(['message'=>'Product Attribute Added Successfully!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pattribute=ProductAttribute::find($id);
        if($pattribute)
        {
            return response()->json(['pattribute'=>$pattribute],200);
        }
        else
        {
            return response()->json(['message'=>'No Product Attribute Found'],404);
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
            'name'=>'required'
        ]);
        $pattribute = ProductAttribute::find($id);
        if($pattribute)
        {
            $pattribute->name=$request->name;
            $pattribute->save();
            return response()->json(['message'=>'Update Product Attribute Success'],200);
        }
        else
        {
            return response()->json(['message'=>'Product Attribute Not Found']);
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
        $pattribute= ProductAttribute::find($id);
        if($pattribute)
        {
            $pattribute->delete();
            return response()->json(['message'=>'Product Attribute Was Delete!']);
        }
        else
        {
            return response()->json(['message','No Product Found']);
        }
    }
}
