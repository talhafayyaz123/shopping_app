<?php

namespace App\Http\Controllers;

use App\Http\Helper\HelperModule;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class OrderController extends Controller
{
    public function index(Request $request){
        $orders = OrderDetail::groupBy('order_id')->get();
        if ($request->ajax()) {
            return Datatables::of($orders)
                ->editColumn('customer',function ($row){
                    return $row->order->customer->f_name;
                })
                ->editColumn('product',function ($row){
                    return $row->product ? $row->product->name.' - '.$row->product->sku : '';
                })
                ->editColumn('variant',function ($row){
                    return $row->variant ? $row->variant->sku : '';
                })
                ->editColumn('price',function ($row){
                    return $row->discount_price ? $row->discount_price : '';
                })
                ->editColumn('status',function ($row){
                    return $row->order->status;
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm edit_button" id="'.$row->id.'" onclick="editOrder(this)"><i class="flaticon-edit-1"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.orders.index',get_defined_vars());
    }
    public function changeStatus($id){
        $order_meta = OrderDetail::find($id);
        $order_detail = Order::find($order_meta->order_id);
        return response()->json(['status' => 200,'message'=>'Oder Detail','data' => $order_detail]);
    }

    public function updateStatus(Request $request){
        try {
            $detail = OrderDetail::find($request->id);
            $order_detail = Order::find($detail->order_id);

            $order_detail->status = $request->get('status');
            $order_detail->save();
            return response()->json(['status' => 200, 'message'=> 'Order Updated','data'=> $order_detail]);
        }catch (\Exception $exception){
            return response()->json(['status' => 422, 'message'=> $exception->getMessage()]);

        }
    }
}
