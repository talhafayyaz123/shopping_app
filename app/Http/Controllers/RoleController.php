<?php

namespace App\Http\Controllers;

use App\Helpers\HelperModule;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
class RoleController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:role-list');
        $this->middleware('permission:role-create', ['only' => ['create','store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = Role::all();

        if ($request->ajax()) {
            return Datatables::of($roles)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="'.route('roles.edit',[$row->id]).'" class="edit btn btn-primary btn-sm"><i class="flaticon-edit-1"></i></a>
                            <a href="javascript:void(0)" class="edit btn btn-danger btn-sm" id="'.$row->id.'" onclick="deleteRole(this)"><i class="la la-trash"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.create',compact('permissions'));
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
        $rules = array(
            'name' => "required",
//            'permission' => "required",
        );
        $validator = Validator::make($form_data, $rules);
        if ($validator->fails()) {
            return back()->with('error',$validator->errors()->first());
        }

        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission_id'));
        return redirect()->route('roles.index')
            ->with('success','Role created successfully');
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
        $role = Role::with('permissions')->find($id);
        $permissions = Permission::all();
        return view('admin.roles.edit',compact('role','permissions'));
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
        $rules = array(
            'name' => "required",
//            'permission' => "required",
        );
        $validator = Validator::make($form_data, $rules);
        if ($validator->fails()) {
            return back()->with('error',$validator->errors()->first());
        }

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
        $role->syncPermissions($request->input('permission_id'));
        return redirect()->route('roles.index')
            ->with('success','Role Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);
        if($role->delete()){
            return response()->json(['status' =>200,'message' => 'Role Deleted Successfully']);
        }else{
            return response()->json(['status' =>404,'message' => 'Role Not found']);
        }
    }
}
