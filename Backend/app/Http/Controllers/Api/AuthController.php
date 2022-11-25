<?php

namespace App\Http\Controllers\Api;

use App\Models\Account;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            //Validated
            $data = $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email|unique:accounts,email',
                'password' => 'required'
            ]);

            $user = Account::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'is_admin' => 0     
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                // 'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Login The User
     * @param Request $request
     * @return Account
     */
    public function login(Request $request)
    {
        $data = $request->validate([
            'email'=>'required|email',
            'password'=>'required|string',
        ]);
        $user = Account::where('email',$data['email'])->first();
        if(!$user || !Hash::check($data['password'],$user->password))
        {
            return response(['message'=>'invalid Credentials'],401);

        }
        else
        {
            $token =$user->createToken('API TOKEN')->plainTextToken;
            $response=[
                'user'=>$user,
                'token'=>$token
            ];
            return response($response,200);
        }
        
    }
    public function loginAdmin(Request $request)
    {
        $data = $request->validate([
            'email'=>'required|email',
            'password'=>'required|string',
        ]);
        $user = Account::where('email',$data['email'])->first();
        if(!$user || !Hash::check($data['password'],$user->password) ||$user['is_admin']!=1)
        {
            return response(['message'=>'invalid Credentials'],401);

        }
        else
        {
            $token =$user->createToken('API TOKEN')->plainTextToken;
            $response=[
                'user'=>$user,
                'token'=>$token
            ];
            return response($response,200);
        }
        
    }
    public function logout(Request $request)
    {
        
         // Get bearer token from the request
         $accessToken = $request->bearerToken();
    
        // Get access token from database
        $token = PersonalAccessToken::findToken($accessToken);

        // Revoke token
        $token->delete();
        return response(['message'=>'logged out successfully']);

    }
}
