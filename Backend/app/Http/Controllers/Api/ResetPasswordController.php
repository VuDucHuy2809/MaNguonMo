<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Account;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use App\Notifications\ResetPasswordRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    /**
     * Create token password reset.
     *
     * @param  ResetPasswordRequest $request
     * @return JsonResponse
     */
    public function sendMail(Request $request)
    {
        $user = Account::where('email', $request->email)->firstOrFail();
        $passwordReset = PasswordReset::updateOrCreate([
            'email' => $user->email,
        ], [
            'token' => Str::random(60),
        ]);
        if ($passwordReset) {
            $user->notify(new ResetPasswordRequest($passwordReset->token));
        }
  
        return response()->json([
        'message' => 'We have e-mailed your password reset link!'
        ]);
    }

    /*public function reset(Request $request, $token)
    {
        $passwordReset = PasswordReset::where('token', $token)->firstOrFail();
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();

            return response()->json([
                'message' => 'This password reset token is invalid.',
            ], 422);
        }
        $request->validate([
            'new_password' => 'required',
        ]);
        Account::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->get('new_password'))
        ]);
        $passwordReset->delete();

        return response()->json([
            'status' => "Success!!!",
            'newPassword' =>$request->get('new_password')
        ]);
    }*/
    public function reset(Request $request, $token)
    {
        $passwordReset = PasswordReset::where('token', $token)->firstOrFail();
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();

            return response()->json([
                'message' => 'This password reset token is invalid.',
            ], 422);
        }
        $user = Account::where('email', $passwordReset->email)->firstOrFail();
        $updatePasswordUser = $user->update([
            'password' => Hash::make($request->get('new_password'))
        ]);
        $passwordReset->delete();

        return response()->json([
            'success' => $updatePasswordUser,
            //'newPassword' =>$request->only('password')
        ]);
    }
}