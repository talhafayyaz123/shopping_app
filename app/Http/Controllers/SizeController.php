<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Size;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sizes = Size::where('is_active',1)->get();
        if ($request->ajax()) {
            return Datatables::of($sizes)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm edit_button" id="'.$row->id.'" onclick="editData(this)"><i class="flaticon-edit-1"></i></a>
                            <a href="javascript:void(0)" class="edit btn btn-danger btn-sm" id="'.$row->id.'" onclick="deleteColor(this)"><i class="la la-trash"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.sizes.index',compact('sizes'));
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
        $user = Size::create($input);
        return redirect()->route('sizes.index')
            ->with('success','Size created successfully');
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
            $color = Size::find($id);
            return response()->json(['status' => 200, 'message'=> 'Size details','data'=> $color]);
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
            $color = Size::find($id);
            $color->name = $request->get('name');
            $color->save();
            return response()->json(['status' => 200, 'message'=> 'Size Updated','data'=> $color]);
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
        $role = Size::find($id);
        if($role->delete()){
            return response()->json(['status' =>200,'message' => 'Size Deleted Successfully']);
        }else{
            return response()->json(['status' =>404,'message' => 'Size Not found']);
        }
    }
}
