<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\PasswordReset;
use App\User;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function reset(Request $request) {
        $user = PasswordReset::where('email', $request['email'])->first();
        if (!$user) {
            return redirect('error-404');
        }
        return view('application');
    }

    public function resetPassword(Request $request) {
        $user = User::where('email', $request['email'])->first();
        $reset = PasswordReset::where('email', $request['email'])->first();
        if (!$user || !$reset) {
            return [
                'success' => false,
                'message' => 'User can not found'
            ];
        }

        PasswordReset::where('email', $request['email'])->delete();
        $user->password = Hash::make($request['password']);
        $user->save();
        return [
            'success' => true,
        ];
    }
}
