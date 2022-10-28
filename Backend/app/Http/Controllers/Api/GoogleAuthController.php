<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use PhpParser\Node\Stmt\TryCatch;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
        //return Socialite::driver('google')->stateless()->user();
    }
    
    public function callbackGoogle()
    {
        try {
            $google_user=Socialite::driver('google')->user();
            $user=Account::where('google_id',$google_user->getId())->first();
            if(!$user)
            {
                $new_user=Account::create([
                        'name'=>$google_user->getName(),
                        'email'=>$google_user->getEmail(),
                        'google_id'=>$google_user->getId()
                ]);
                Auth::login($new_user);
                return redirect()->intended('dashboard');
            }
            Auth::login($user);
            return redirect()->intended('dashboard');
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
    
}
