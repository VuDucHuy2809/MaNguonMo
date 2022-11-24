<?php

namespace App\Http\Controllers;

use Exception;
//use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function uploadImage($request)
    {
        try{
            if(!$request->hasFile('image')){
                return response()->json(['message'=>'file is required'],202);
            }
            $response = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();
            return $response;
        }catch(\Exception $e)
        {
            return response()->json(['message'=>$e->getMessage()],201);
        }
    }
}
