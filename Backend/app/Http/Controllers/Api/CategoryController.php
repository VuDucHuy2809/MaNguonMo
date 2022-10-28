<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    //
    public function index()
    {
        /*$category=Category::all();
        if($category)
        {
            return response()->json(['category'=>$category],200);
        }
        else
        {
            return response()->json(['message'=>'No Category Found'],404);
        }*/
        //return new CategoryCollection(Category::all());
        /*$categories=Category::with('subcategory_product')->get();
        return response()->json($categories,200);*/
        $category=Category::getAllCate();
        return response()->json(['category'=>$category],200);
    }
}
