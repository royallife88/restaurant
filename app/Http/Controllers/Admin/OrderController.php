<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Utils\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    /**
     * All Utils instance.
     *
     */
    protected $commonUtil;

    /**
     * Constructor
     *
     * @param Util $commonUtil
     * @return void
     */
    public function __construct(Util $commonUtil)
    {
        $this->commonUtil = $commonUtil;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->can('order.view')) {
            abort(403, __('lang.not_authorized'));
        }
        if (request()->ajax()) {

            $orders = Order::where('id', '>', 0);

            $orders = $orders->select(
                'orders.*'
            )->orderBy('created_at', 'desc');

            return DataTables::of($orders)
                ->addColumn('count', function ($row) {
                    return $row->order_details->count();
                })
                ->editColumn('status', '{{ucfirst($status)}}')
                ->editColumn('delivery_status', '{{ucfirst($delivery_status)}}')
                ->editColumn('created_at', '@if(!empty($created_at)){{@format_datetime($created_at)}}@endif')
                ->editColumn('final_total', '@if(!empty($final_total)){{@num_format($final_total)}}@endif')
                ->editColumn('delivery_type', function ($row) {
                    if ($row->delivery_type == "home_delivery") {
                        return __('lang.home_delivery');
                    }
                    if ($row->delivery_type == "i_will_pick_it_up_my_self") {
                        return __('lang.i_will_pick_it_up_my_self');
                    }
                })
                ->editColumn('order_type', function ($row) {
                    if ($row->order_type == "order_later") {
                        return __('lang.order_later');
                    }
                    if ($row->order_type == "order_now") {
                        return __('lang.order_now');
                    }
                })
                ->editColumn('payment_type', function ($row) {
                    if ($row->payment_type == "cash_on_delivery") {
                        return __('lang.cash_on_delivery');
                    }
                    if ($row->payment_type == "pay_online") {
                        return __('lang.pay_online');
                    }
                })
                ->editColumn('out_of_restaurant', function ($row) {
                    if ($row->out_of_restaurant == "out_of_restaurant") {
                        return __('lang.out_of_restaurant');
                    }
                    if ($row->out_of_restaurant == "in_restaurant") {
                        return __('lang.in_restaurant');
                    }
                })
                ->addColumn(
                    'action',
                    function ($row) {
                        $html = '';

                        if (auth()->user()->can('order.view')) {
                            $html .=
                                '<a href="' . action('Admin\OrderController@show', $row->id) . '"
                                class="btn btn-xs btn-primary"><i class="fa fa-eye"></i>
                                ' . __('lang.view') . '</a>';
                        }

                        if (auth()->user()->can('order.create_and_edit')) {
                            $html .=
                                '<a data-href="' . action('Admin\OrderController@edit', $row->id) . '" data-container=".view_modal" class="btn btn-modal btn-xs btn-danger"
                                ><i class="fa fa-edit"></i> ' . __('lang.edit') . '</a>';
                        }

                        // if (auth()->user()->can('order.delete')) {
                        //     $html .=
                        //         '<li>
                        //     <a data-href="' . action('Admin\OrderController@destroy', $row->id) . '"
                        //         data-check_password="' . action('Admin\UserController@checkPassword', Auth::user()->id) . '"
                        //         class="btn text-red delete_item"><i class="fa fa-trash"></i>
                        //         ' . __('lang.delete') . '</a>
                        // </li>';
                        // }
                        return $html;
                    }
                )


                ->rawColumns([
                    'image',
                    'product_details',
                    'discount_start_date',
                    'discount_end_date',
                    'action',
                ])
                ->make(true);
        }

        return view('admin.order.index');

        return view('admin.order.index')->with(compact(
            'categories',
        ));
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
       //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!auth()->user()->can('order.view')) {
            abort(403, __('lang.not_authorized'));
        }

        $order = Order::find($id);

        return view('admin.order.show')->with(compact(
            'order',
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!auth()->user()->can('order.edit')) {
            abort(403, __('lang.not_authorized'));
        }

        $order = Order::find($id);

        return view('admin.order.edit')->with(compact(
            'order',
        ));
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

            $order = Order::find($id);
            $order->customer_name = $request->customer_name;
            $order->phone_number = $request->phone_number;
            $order->sales_note = $request->sales_note;
            $order->payment_type = $request->payment_type;
            $order->delivery_type = $request->delivery_type;
            $order->status = $request->status;
            $order->delivery_status = $request->delivery_status;
            $order->save();

            DB::commit();
            $output = [
                'success' => true,
                'msg' => __('lang.success')
            ];
        } catch (\Exception $e) {
            Log::emergency('File: ' . $e->getFile() . 'Line: ' . $e->getLine() . 'Message: ' . $e->getMessage());
            $output = [
                'success' => false,
                'msg' => __('lang.something_went_wrong')
            ];
        }

        return redirect()->back()->with('status', $output);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Order::find($id)->delete();
            $output = [
                'success' => true,
                'msg' => __('lang.success')
            ];
        } catch (\Exception $e) {
            Log::emergency('File: ' . $e->getFile() . 'Line: ' . $e->getLine() . 'Message: ' . $e->getMessage());
            $output = [
                'success' => false,
                'msg' => __('lang.something_went_wrong')
            ];
        }

        return $output;
    }
}
