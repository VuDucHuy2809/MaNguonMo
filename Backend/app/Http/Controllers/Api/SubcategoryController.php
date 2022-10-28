<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    //
    public function index()
    {
        $subcate=SubCategory::all();
        if($subcate)
        {
            return response()->json(['subcate'=>$subcate],200);
        }
        else 
        {
            return response()->json(['message'=>'No SubCategory Found']);
        }
    }
    public function show($id)
    {
        $subcate=SubCategory::find($id);
        if($subcate)
        {
            return response()->json(['subcate'=>$subcate],200);
        }
        else 
        {
            return response()->json(['message'=>'No SubCategory Found']);
        }
    }
}
