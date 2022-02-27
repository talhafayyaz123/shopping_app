<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $parent_Cats = Category::whereNotNull('parent_id')->get();
        $categories = Category::with('parentCategory')->get();
        if ($request->ajax()) {
            return Datatables::of($categories)
                ->addIndexColumn()
                ->editColumn('parent_cat', function ($model) {
                    return $model->parentCategory ? $model->parentCategory->name: 'N/A';
                })
                ->addColumn('action', function($row){
                    $btn = '';
                    if(auth()->user()->hasPermissionTo('category-edit')){
                        $btn .= '<a href="'.route('categories.edit',[$row->id]).'" class="edit btn btn-primary btn-sm edit_button" id="'.$row->id.'"><i class="flaticon-edit-1"></i></a>';
                    }
                    if(auth()->user()->hasPermissionTo('category-delete')){
                        $btn .= '<a href="javascript:void(0)" class="edit btn btn-danger btn-sm" id="'.$row->id.'" onclick="deleteColor(this)"><i class="la la-trash"></i></a>';
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.categories.index',compact('categories'));
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
        try {
            $form_data = $request->all();
            $riles =  [
                'name' => 'required',
            ];
            $validator = Validator::make($form_data, $riles);

            if ($validator->fails()) {
                dd($validator->errors()->first());
                return back()->with('error',$validator->errors()->first());
            }

            $form_data['slug'] = $form_data['name'];
            $form_data['created_by'] = auth()->user()->id;
            $category = Category::create($form_data);
            if ($request->hasFile('images')) {
                $images = $request->file('images');
                foreach ($images as $key => $image){
                    $fileExtension = substr(strrchr($image->getClientOriginalName(), '.'), 1);
                    if ($fileExtension != 'jpg' && $fileExtension != 'jpeg' && $fileExtension != 'png' && $fileExtension != 'gif') {
                        continue;
                    }
                    $filesize = \File::size($image);
                    if ($filesize >= 1024 * 1024 * 10) {
                        continue;
                    }
                }
            }
            if($request->hasFile('images')){
                $images = $request->file('images');
                foreach ($images as $key => $image){
                    $image_name = Str::random(10);
                    $ext = strtolower($image->getClientOriginalExtension()); // You can use also getClientOriginalName()
                    $image_full_name = $image_name.'.'.$ext;
                    $upload_path = public_path('assets/uploads/categories/');    //Creating Sub directory in Public folder to put image
                    $image_url = $upload_path.$image_full_name;
                    $success = $image->move($upload_path,$image_full_name);
                    /*
                     * saving image to polymorphic table with model id
                     * */
                    $model = new Image();
                    $model->model_id = $category->id;
                    $model->model_type = 'App\Models\Category';
                    $model->image = $image_full_name;
                    $model->save();
                }
            }
            return redirect()->route('categories.index')
                ->with('success','Category created successfully');
        }catch (\Exception $exception){
            return back()->with('error',$exception->getMessage());
        }
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
            $category = Category::with('parentCategory')->find($id);
            $categories = Category::with('parentCategory')->get();
            return view('admin.categories.edit',compact('category','categories'));
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
            $form_data = $request->all();
            unset($form_data['_method']);
            $rules =  [
                'name' => 'required',
            ];
            $validator = Validator::make($form_data, $rules);

            if ($validator->fails()) {
                return back()->with('error',$validator->errors()->first());
            }

            $form_data['slug'] = $form_data['name'];
            $form_data['created_by'] = auth()->user()->id;
            unset($form_data['old']);
            unset($form_data['_token']);
            unset($form_data['_method']);
            $category = Category::where('id',$id)->update($form_data);
            if(isset($request->old)){
                $images = Image::where('model_id',$id)->where('model_type','App\Models\Category')->pluck('id')->toArray();
                $image_ids_to_delete = array_diff($images,$request->get('old'));
                $delete = Image::whereIN('id',$image_ids_to_delete)->delete();
            }
            if($request->hasFile('photos')){
                $images = $request->file('photos');
                foreach ($images as $key => $image){
                    $name = strtolower($image->getClientOriginalName()); // You can use also getClientOriginalName()
                    $image_full_name = $name;
                    $upload_path = public_path('assets/uploads/categories/');    //Creating Sub directory in Public folder to put image
                    $image_url = $upload_path.$image_full_name;
                    $success = $image->move($upload_path,$image_full_name);
                    /*
                     * saving image to polymorphic table with model id
                     * */
                    $model = new Image();
                    $model->model_id = $id;
                    $model->model_type = 'App\Models\Category';
                    $model->image = $image_full_name;
                    $model->save();
                }
            }
//            return response()->json(['status' => 200, 'message'=> 'Category Updated','data'=> $category]);
            return redirect()->to('categories')->with('Success','Category Updated Successfully');
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
        $role = Category::find($id);
        if($role->delete()){
            return response()->json(['status' =>200,'message' => 'Category Deleted Successfully']);
        }else{
            return response()->json(['status' =>404,'message' => 'Category Not found']);
        }
    }
    public function getCategoryImages(Request $request){
        $category_id = $request->id;
        $images = Image::where('model_id',$category_id)
            ->where('model_type','App\Models\Category')->get()->toArray();
        $result = [];
        $path = url('assets/uploads/categories').'/';
        foreach ($images as $key => $image){
            $result[$key]['id'] = $image['id'];
            $result[$key]['src'] = $path.$image['image'];

        }
//        $json=json_encode((object)$result,JSON_FORCE_OBJECT);
        return response()->json(['data' =>$result]);
//        return json_encode($result);

    }
}
