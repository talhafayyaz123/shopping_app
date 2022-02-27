<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Helper\HelperModule;
use App\Models\Coupon;
use App\Models\Role;
use App\Models\UserCoupon;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $validator =  Validator::make($data, [
            'f_name' => ['required', 'string', 'max:255'],
            'l_name' => ['required', 'string', 'max:255'],
            'phone_no' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        if($validator->fails()){
            HelperModule::jsonResponse(422,'',$validator->errors());
        }
    }

    protected function register(Request $request){
        $this->validator($request->all());

        event(new Registered($user = $this->create($request->all())));
        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }
        if($request->ajax()){
            return response()->json(['status' =>200,'message'=>'Registration Successful' ,'redirct_url' => url('/home')]);
        }else{
            return redirect()->intended($this->redirectPath());
        }
//        return $request->wantsJson()
//            ? new JsonResponse([], 201)
//            : redirect($this->redirectPath());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user_array['f_name'] = $data['f_name'] ;
        $user_array['l_name'] = $data['l_name'] ;
        $user_array['phone_no'] = $data['phone_no'] ;
        $user_array['gender'] = $data['gender'] ;
        $user_array['email'] = $data['email'];
        $user_array['password'] = Hash::make($data['password']);
        $user =  User::create($user_array);
        $role_id = Role::where('name','customer')->pluck('id')->first();
        $user->assignRole($role_id);
        $coupon = Coupon::where('type',1)->where('is_active',1)->first();
        $user_coupon = new UserCoupon();
        $user_coupon->user_id = $user->id;
        $user_coupon->coupon_id = $coupon->id;
        $coupon->save();
        return $user;
//        return User::create([
//            'f_name' => $data['name'],
//            'email' => $data['email'],
//            'password' => Hash::make($data['password']),
//        ]);
    }
}
