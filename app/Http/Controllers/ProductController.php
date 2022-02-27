<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductColorSize;
use App\Models\ProductMultiple;
use App\Models\ProductVariant;
use App\Models\Size;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Response;
class   ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $products = Product::select('id','name','description','category_id','first_child_category','second_child_category')
                ->where('is_active',1)->get();
            if ($request->ajax()) {
                return Datatables::of($products)
                    ->addIndexColumn()
                    ->editColumn('category', function ($model) {
                        if($model->secondChildCategory != null){
                            return $model->secondChildCategory ? $model->secondChildCategory->name: 'N/A';
                        }
                        if($model->firstChildCategory != null){
                            return $model->firstChildCategory ? $model->firstChildCategory->name: 'N/A';
                        }
                        if($model->category != null){
                            return $model->category ? $model->category->name: 'N/A';
                        }
                    })
                    ->addColumn('variant_count', function ($model) {
                            return $model->variants->count();
                    })
                    ->addColumn('action', function($row){
                        $btn = '';
                        if(auth()->user()->hasPermissionTo('product-edit')){
                            $btn .= '<a href="'.route('products.edit',[$row->id]).'" class="edit btn btn-primary btn-sm edit_button" id="'.$row->id.'"><i class="flaticon-edit-1"></i></a>';
                        }
                        if(auth()->user()->hasPermissionTo('product-delete')){
                            $btn .= '<a href="javascript:void(0)" class="edit btn btn-danger btn-sm" id="'.$row->id.'" onclick="deleteColor(this)"><i class="la la-trash"></i></a>';
                        }
                        if(auth()->user()->hasPermissionTo('product-edit')){
                            $btn .= '<a href="'.route('get_product_variant',[$row->id]).'" title="Product Variants" class="edit btn btn-info btn-sm" id="'.$row->id.'"><i class="la la-arrows"></i></a>';
                        }
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('admin.products.index',compact('products'));
        }catch (\Exception $exception){
            dd($exception->getMessage(),$exception->getFile(), $exception->getLine());
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        $categories = Category::where('is_active',1)->get();
//        $colors = Color::where('is_active',1)->get();
//        $sizes  = Size::where('is_active',1)->get();
//        $vendors  = Vendor::where('is_active',1)->get();
//
//        return view('admin.products.create',compact('categories','colors','sizes','vendors'));


        $categories = Category::where('is_active', 1)->get();
        $colors = Color::where('is_active', 1)->get();
        $sizes = Size::where('is_active', 1)->get();
        $vendors = Vendor::where('is_active', 1)->get();
        $total_product_count = 0;
        return view('admin.products.product', compact('categories', 'colors', 'sizes', 'vendors', 'total_product_count'));

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
        dd($form_data);
        $riles =  [
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'color_id' => 'required',
            'size_id' => 'required',
            'purchase_date' => 'required',
//            'purchase_price' => 'required',
//            'selling_price' => 'required',
            'quantity' => 'required',
            'alert_quantity' => 'required',
            'images.*' => 'required',
        ];
        $validator = Validator::make($form_data, $riles);

        if ($validator->fails()) {
            dd($validator->errors()->first());
            return back()->with('error',$validator->errors()->first());
        }
        if(isset($form_data['is_active']) && $form_data['is_active'] == 'on'){
            $form_data['is_active'] = 1;
        }
        if(isset($form_data['is_new_arrival']) && $form_data['is_new_arrival'] == 'on'){
            $form_data['is_new_arrival'] = 1;
        }
        if(isset($form_data['is_discounted']) && $form_data['is_discounted'] == 'on'){
            $form_data['is_discounted'] = 1;
        }
        $product = Product::create($form_data);
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
                $upload_path = public_path('assets/uploads/products/');    //Creating Sub directory in Public folder to put image
                $image_url = $upload_path.$image_full_name;
                $success = $image->move($upload_path,$image_full_name);
                /*
                 * saving image to polymorphic table with model id
                 * */
                $model = new Image();
                $model->model_id = $product->id;
                $model->model_type = 'App\Models\Product';
                $model->image = $image_full_name;
                $model->save();
            }
        }
        return redirect('products')->with('success','Product added successfully');

    }

    public function storeProduct(Request $request)
    {
        $form_data = $request->all();
        if(isset($form_data['is_active']) && $form_data['is_active'] == 'on'){
            $form_data['is_active'] = 1;
        }
        if(isset($form_data['is_new_arrival']) && $form_data['is_new_arrival'] == 'on'){
            $form_data['is_new_arrival'] = 1;
        }
//        if(isset($form_data['is_discounted']) && $form_data['is_discounted'] == 'on'){
//            $form_data['is_discounted'] = 1;
//        }
        if(isset($form_data['second_child_category']) && $form_data['second_child_category'] != ''){
            $form_data['category_id'] = null;
            $form_data['first_child_category'] = null;
            $form_data['second_child_category'] = $request->get('second_child_category_id');
        }
        else if(isset($form_data['first_child_category']) && $form_data['first_child_category'] != ''){
            $form_data['category_id'] = null;
            $form_data['second_child_category'] = null;
            $form_data['first_child_category'] = $request->get('child_category_id');
        }
        elseif(isset($form_data['second_child_category']) && $form_data['second_child_category'] != ''){
            $form_data['category_id'] = $request->get('category_id');
            $form_data['first_child_category'] = null;
            $form_data['second_child_category'] = null;
        }

//        $form_data['category_id'] = $request->get('category_id');
//        $form_data['first_child_category'] = $request->get('child_category_id');
//        $form_data['second_child_category'] = $request->get('second_child_category_id');
        $form_data['account_id'] = 1;
        $product = Product::create($form_data);
        $counter =0;
        for ($idx = 1; $idx <= $request->total_product; $idx++) {
            $values = new ProductVariant();
            $values->product_id = $product->id;
            $values->color_id = $request->get('color_id_'.$idx);
            $values->length = $request->get('length_'.$idx);
            $values->height = $request->get('height_'.$idx);
            $values->weight = $request->get('weight_'.$idx);
            $values->width = $request->get('width'.$idx);
            $values->quantity = $request->get('quantity_'.$idx);
            $values->alert_quantity = $request->get('alert_quantity_'.$idx);
            $values->price = $request->get('selling_price_'.$idx);
            if(isset($form_data['is_discounted'][$counter]) && $form_data['is_discounted'][$counter] == 'on'){
                $values->is_discounted = 1;
                $values->discount_price = $request->discount_price[$counter];
                $values->discount_valid_till = $request->discount_valid_till[$counter];
            }

            if(isset($form_data['is_new_arrival'][$counter]) && $form_data['is_new_arrival'][$counter] == 'on'){
                $values->is_new_arrival = 1;
            }
            if(isset($form_data['is_featured'][$counter]) && $form_data['is_featured'][$counter] == 'on'){
                $values->is_featured = 1;
            }
            $values->save();
            $sizes = $request->get('size_id_'.$idx);
            foreach($sizes as $key => $size){
                $product_size = new ProductColorSize();
                $product_size->color_id = $request->get('color_id_'.$idx);
                $product_size->size_id = $size;
                $product_size->product_id = $product->id;
                $product_size->variant_id = $values->id;
                $product_size->save();
            }
            if($request->hasFile('images_'.$idx)){
                $images = $request->file('images_'.$idx);
                foreach ($images as $key => $image){
                    $image_name = Str::random(10);
                    $ext = strtolower($image->getClientOriginalExtension()); // You can use also getClientOriginalName()
                    $image_full_name = $image_name.'.'.$ext;
                    $upload_path = public_path('assets/uploads/products/');    //Creating Sub directory in Public folder to put image
                    $image_url = $upload_path.$image_full_name;
                    $success = $image->move($upload_path,$image_full_name);
                    /*
                     * saving image to polymorphic table with model id
                     * */
                    $model = new Image();
                    $model->model_id = $values->id;
                    $model->model_type = 'App\Models\ProductVariant';
                    $model->image = $image_full_name;
                    $model->save();
                }
            }
            $counter++;
        }
        return redirect('products')->with('success','Product added successfully');

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
        $categories = Category::where('is_active',1)->get();
        $vendors  = Vendor::where('is_active',1)->get();
        $product = Product::find($id);
        return view('admin.products.edit',compact('categories','vendors','product'));
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
        $riles =  [
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'color_id' => 'required',
            'size_id' => 'required',
            'purchase_date' => 'required',
            'purchase_price' => 'required',
            'selling_price' => 'required',
            'quantity' => 'required',
            'alert_quantity' => 'required',
            'photos' => 'required_without:old',
        ];
        $validator = Validator::make($form_data, $riles);

        if ($validator->fails()) {
//            dd($validator->errors()->first());
            return back()->with('error',$validator->errors()->first());
        }
        if(isset($form_data['is_active']) && $form_data['is_active'] == 'on'){
            $form_data['is_active'] = 1;
        }
        unset($form_data['product_id']);
        unset($form_data['_token']);
        unset($form_data['_method']);
        unset($form_data['old']);
        unset($form_data['photos']);
        $product = Product::where('id',$id)->update($form_data);

        return redirect()->route('products.index')->with('success','Product Update Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $product = Product::find($id);

//       $product->image->delete();
        $product->is_active = 0;
        if( $product->update()){
            return response()->json(['status' =>200,'message' => 'Product Deleted Successfully']);
        }else{
            return response()->json(['status' =>404,'message' => 'Product Not found']);
        }
    }

    public function getImages(Request $request){
       $variant_id = $request->id;
       $images = Image::where('model_id',$variant_id)
           ->where('model_type','App\Models\ProductVariant')->get()->toArray();
       $result = [];
       $path = url('assets/uploads/products').'/';
       foreach ($images as $key => $image){
           $result[$key]['id'] = $image['id'];
           $result[$key]['src'] = $path.$image['image'];

       }
//        $json=json_encode((object)$result,JSON_FORCE_OBJECT);
        return response()->json(['data' =>$result]);
//        return json_encode($result);

    }
    public function getFirstcategory(Request $request){

        $category_id = $request->category_id;

        $categories = Category::select('id','name')->where('parent_id',$category_id)->get();

         return Response::json($categories,200);

    }
    public function getSecondChildCategory(Request $request){

        $child_category_id = $request->child_category_id;

        $categories = Category::select('id','name')->where('parent_id',$child_category_id)->get();

         return Response::json($categories,200);

    }

    public function getProdcutVariant($product_id){
        $variants = ProductVariant::where('product_id',$product_id)->get();
        return view('admin.products.variant_listing',compact('variants'));
    }

    public function editVariant($variant_id){
        $variant = ProductVariant::find($variant_id);
        $colors = Color::where('is_active',1)->get();
        $sizes = Size::all();
        $variant_sizes = ProductColorSize::where('variant_id',$variant_id)->get()->pluck('size_id')->toArray();
        return view('admin.products.variant_edit',compact('variant','colors','sizes','variant_sizes'));
    }

    public function updateVariant(Request $request,$id){
        $form_data = $request->all();
//        dd($form_data);
        $riles =  [
            'color_id' => 'required',
            'size_id.*' => 'required',
            'purchase_date' => 'required',
            'purchase_price' => 'required',
            'selling_price' => 'required',
            'quantity' => 'required',
            'alert_quantity' => 'required',
            'photos' => 'required_without:old',
        ];
        $validator = Validator::make($form_data, $riles);

        if ($validator->fails()) {
//            dd($validator->errors()->first());
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $values = ProductVariant::find($id);
        $values->color_id = $request->get('color_id');
        $values->length = $request->get('length');
        $values->height = $request->get('height');
        $values->weight = $request->get('weight');
        $values->width = $request->get('width');
        $values->quantity = $request->get('quantity');
        $values->alert_quantity = $request->get('alert_quantity');
        $values->purchase_date = $request->get('purchase_date');
        $values->purchase_price = $request->get('purchase_price');
        $values->price = $request->get('selling_price');

        if(isset($form_data['is_discounted']) && $form_data['is_discounted'] == 'on'){
            $values->is_discounted = 1;
            $values->discount_price = $request->discount_price;
            $values->discount_valid_till = $request->discount_valid_till;
        }

        if(isset($form_data['is_new_arrival']) && $form_data['is_new_arrival'] == 'on'){
            $values->is_new_arrival = 1;
        }
        if(isset($form_data['is_featured']) && $form_data['is_featured'] == 'on'){
            $values->is_featureds = 1;
        }
        $values->update();
        $sizes = ProductColorSize::where('variant_id',$id)->delete();
        foreach($request->get('size_id') as $key => $size){
            $product_size = new ProductColorSize();
            $product_size->color_id = $request->get('color_id');
            $product_size->size_id = $size;
            $product_size->product_id = $request->product_id;
            $product_size->variant_id = $id;
            $product_size->save();
        }
        if(isset($request->old)){
            $images = Image::where('model_id',$id)->where('model_type','App\Models\ProductVariant')->pluck('id')->toArray();
            $image_ids_to_delete = array_diff($images,$request->get('old'));
            $delete = Image::whereIN('id',$image_ids_to_delete)->delete();
        }
        if($request->hasFile('photos')){
            $images = $request->file('photos');
            foreach ($images as $key => $image){
                $name = strtolower($image->getClientOriginalName()); // You can use also getClientOriginalName()
                $image_full_name = $name;
                $upload_path = public_path('assets/uploads/products/');    //Creating Sub directory in Public folder to put image
                $image_url = $upload_path.$image_full_name;
                $success = $image->move($upload_path,$image_full_name);
                /*
                 * saving image to polymorphic table with model id
                 * */
                $model = new Image();
                $model->model_id = $id;
                $model->model_type = 'App\Models\ProductVariant';
                $model->image = $image_full_name;
                $model->save();
            }
        }
        return redirect()->back()->with('success','Variant Update Successfully');
    }

    public function deleteVariant($id){
        $variant = ProductVariant::find($id);
//        $variant->image->delete();
        if($variant->delete()){
            return response()->json(['status' =>200,'message' => 'Product Deleted Successfully']);
        }else{
            return response()->json(['status' =>404,'message' => 'Product Not found']);
        }
    }
}
