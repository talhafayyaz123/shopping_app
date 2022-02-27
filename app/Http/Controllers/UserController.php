<?php

namespace App\Http\Controllers;

use App\Http\Helper\HelperModule;
use App\Models\Coupon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;
use Response;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::all();
        $roles = Role::all();
        if ($request->ajax()) {
            return Datatables::of($users)
                ->addIndexColumn()
                ->editColumn('name', function ($model) {
                    return $model->f_name.' '.$model->l_name;
                })
                ->editColumn('role', function ($model) {
                    return 'N/A';
                })
                ->addColumn('action', function($row){

                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm edit_button"
                    id="'.$row->id.'" onclick="editUser(this)" data-edit="'.route('users.edit',[$row->id]).'"><i class="flaticon-edit-1"></i></a>
                            <a href="javascript:void(0)" class="edit btn btn-danger btn-sm" id="'.$row->id.'" onclick="deleteUser(this)"><i class="la la-trash"></i></a>';
                    return $btn;


                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.users.index',compact('roles'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $this->validate($request, [
            'f_name' => 'required',
            'l_name' => 'required',
            'phone_no' => 'required',
            'gender' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'role_id' => 'required'
        ]);

        $input = $request->all();

        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('role_id'));
        return redirect()->route('users.index')
            ->with('success','User created successfully');
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
        $user = User::find($id);
        $roles = Role::all();
        $coupons = Coupon::all();
        $user_coupon = $user->coupons->where('is_active',1)->first();
//        $html = view('admin.users.edit',compact('user','roles','coupons'))->render();
        $html = view('admin.users.edit',get_defined_vars())->render();
        return response ::json(['status'=>'success','data'=>$html]);

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
        $form_data = $request->all();
        unset($form_data['_token']);
        unset($form_data['_method']);
        unset($form_data['_method']);
        unset($form_data['role_id']);
        $user = User::where('id',$id)->update($form_data);
        if($user){
            DB::table('model_has_roles')->where('model_id',$id)->delete();
            $user = User::find($id);


            $user->assignRole($request->input('role_id'));
            return response()->json(['status' => true,'message'=>'Updated Successfully','data'=> $user]);
        }else{
            return response()->json(['status' => false,'message'=>'Something Went wrong']);

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
        $user = User::find($id);
        $user->is_active = 0;

        if($user->update()){
            return response()->json(['status' =>200,'message' => 'User Deleted Successfully']);
        }else{
            return response()->json(['status' =>404,'message' => 'User Not found']);
        }
    }

    public function adminProfile(){
        $user = auth()->user();
        return view('admin.users.profile',compact('user'));
    }
}
