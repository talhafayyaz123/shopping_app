<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $colors = Color::where('is_active',1)->get();
        if ($request->ajax()) {
            return Datatables::of($colors)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm edit_button" id="'.$row->id.'" onclick="editColor(this)"><i class="flaticon-edit-1"></i></a>
                            <a href="javascript:void(0)" class="edit btn btn-danger btn-sm" id="'.$row->id.'" onclick="deleteColor(this)"><i class="la la-trash"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.colors.index',compact('colors'));
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
        $this->validate($request, [
            'name' => 'required',
        ]);

        $input = $request->all();
        $input['type'] = $input['name'];
        $user = Color::create($input);
        return redirect()->route('colors.index')
            ->with('success','Color created successfully');
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
        try {
            $color = Color::find($id);
            return response()->json(['status' => 200, 'message'=> 'Color details','data'=> $color]);
        }catch (\Exception $exception){
            return response()->json(['status' => 422, 'message'=> $exception->getMessage()]);

        }
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
            $this->validate($request, [
                'name' => 'required',
            ]);
            $color = Color::find($id);
            $color->name = $request->get('name');
            $color->save();
            return response()->json(['status' => 200, 'message'=> 'Color Updated','data'=> $color]);
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
        $role = Color::find($id);
        if($role->delete()){
            return response()->json(['status' =>200,'message' => 'Color Deleted Successfully']);
        }else{
            return response()->json(['status' =>404,'message' => 'Color Not found']);
        }
    }
}
