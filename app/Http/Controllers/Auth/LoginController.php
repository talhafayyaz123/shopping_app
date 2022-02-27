<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Helper\HelperModule;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('admin.login');
    }

//    protected function guard()
//    {
//        return Auth::guard('admin');
//    }



    public function authenticated(Request $request, $user)
    {
        if($request->ajax() && ($user->hasrole('admin') || $user->hasrole('manager'))){
            return response()->json(['status' =>200,'message'=>'Login Success' ,'redirect_url' => url('dashboard')]);
        }
        else if($request->ajax() && $user->hasrole('customer')){
            return response()->json(['status' =>200,'message'=>'Login Success' ,'redirect_url' => url('home')]);
        }
//        else{
//            Auth::logout();
//            return new JsonResponse(['status'=>422,'message'=> 'User can not be logged in']);
//        }
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        if ($request->ajax() || $request->wantsJson())
        {
            $errors =  ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
            return new JsonResponse(['status'=>422,'message'=>  $errors->getMessage()]);
        }else {
            throw ValidationException::withMessages([
                $this->username() => [trans('auth.failed')],
            ]);
        }
    }

    public function validateLogin(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        if($validator->fails()){
            HelperModule::jsonResponse(422,'',$validator->errors());
        }
    }
}
