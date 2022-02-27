<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\CouponType;
use App\Models\User;
use App\Models\UserCoupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::where('is_active',1)->get();
        $types = CouponType::where('is_active',1)->get();
        return  view('admin.coupons.index',compact('coupons','types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form_data = $request->all();
        $rules =  [
            'code' => 'required',
            'type' => 'required',
            'expired_date' => 'required',
        ];
        $validator = Validator::make($form_data, $rules);
        if ($validator->fails()) {
            return back()->with('error',$validator->errors()->first());
        }
//        $form_data['user_id'] = auth()->user()->id;
        $form_data['is_active'] = 1;
        $coupon = Coupon::create($form_data);
        return redirect('coupons')->with('success','Coupons added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coupon = Coupon::find($id);
        $types = CouponType::where('is_active',1)->get();
        $html = view('admin.coupons.edit',compact('coupon','types'))->render();

        return response()->json(['status'=> true,'message'=>'Details' , 'data' => $html]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $form_data = $request->all();
            unset($form_data['_method']);
            unset($form_data['_token']);

            $settings = Coupon::where('id',$id)->update($form_data);
            return redirect('coupons')->with('success','Updated Successfully');
        }catch (\Exception $exception){
            return response()->json(['status' => 422, 'message'=> $exception->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coupon = Coupon::find($id);
        $coupon->is_active = 0;
        if($coupon->update()){
            return response()->json(['status' =>200,'message' => 'Coupon Inactive Successfully']);
        }else{
            return response()->json(['status' =>404,'message' => 'Coupon Not found']);
        }
    }

    public function assignCouponsList(){
        return view('admin.coupons.assign_coupon');
    }

    public function searchCustomer(Request $request){
        $customer = User::with('coupons')->where('email', $request->get('email'))->first();
        return view('admin.coupons.assign_coupon',get_defined_vars());
    }

    public function getRemainingCouponsToAssign(Request $request){
        $customer_id = $request->get('customer_id');
        $user_assing_coupon_ids = UserCoupon::where('user_id',$customer_id)->get()->pluck('coupon_id')->toArray();
        $remaining_coupons = Coupon::whereNotIn('id',$user_assing_coupon_ids)->
            where('expired_date','>', date('Y-m-d'))->get();
        $html = view('admin.coupons.remaining_coupon',get_defined_vars())->render();
        return response()->json(['status'=>200,'data'=> $html]);
    }

    public function assignCouponToCustomer(Request $request){
        try {
            $customer_id = $request->get('customer_id');
            $coupos = $request->get('coupon_id');

            foreach ($coupos as $key => $coupon){
                $obj = new UserCoupon();
                $obj->coupon_id = $coupon;
                $obj->user_id = $customer_id;
                $obj->is_active = 1;
                $obj->save();
                return response()->json(['status'=> true, 'message'=> 'Coupon Assigned Successfully']);
            }
        }catch (\Exception $exception){
            return response()->json(['status'=> false, 'message'=> $exception->getMessage()]);
        }

    }
}
