<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class CustomerController extends Controller
{
    public function updateProfile(Request $request){

      $this->validate($request, [
          'f_name' => 'required|min:3|max:50',
          'l_name' => 'required|min:3|max:50',
          'email' => 'required|email',
          'password' => 'required_if:old_password,!null',
      ]);
      $user = Auth::user();
      $user->f_name = $request->f_name;
      $user->l_name = $request->l_name;
//      $user->phone_no = $request->phone_no;
      if(isset($request->password)){
          $check_old_pass = Hash::check($request->old_password,$user->password);
          if($check_old_pass){
              $user->password = Hash::make($request->password);
          }else{
              return back()->with('error','Old password does not matched');
          }
      }
      $user->update();
      return back()->with('success','User detial updated successfully');
    }
}
