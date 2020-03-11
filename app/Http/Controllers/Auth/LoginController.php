<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'min:6'],
        ]);
    }

    public function login(Request $request) {
        $input = $request->all();
        $validator = $this->validator($input);

        if ($validator->passes()) {
            $user = User::with('company_details')->where('email', $request->email)->first();
            if (!$user) {
                return [
                    'Success' => false,
                    'message' => 'User does not exist.'
                ];
            }
            if (!$user->email_verified_at) {
                return [
                    'Success' => false,
                    'message' => 'Email not verified'
                ];
            }

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password], 1)) {
                $redirectTo = '/';
                if (!$user->company_details)
                    $redirectTo = '/register-company';

                return array(
                    'Success' => true,
                    'userData' => Auth::user(),
                    'redirectTo' => $redirectTo
                );
            }

            return [
                'Success' => false,
                'message' => 'Wrong Email or Password'
            ];
        }

        return [
            'Success' => false,
            'message' => $validator->errors()->first()
        ];
    }

    public function showLogin(Request $request) {
        return view('application');
    }

    public function logout(Request $request) {
        Auth::logout();
    }

    public function showError(Request $request) {
        return view('application');
    }
}
