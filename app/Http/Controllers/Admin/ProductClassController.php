<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductClass;
use App\Utils\DatatableUtil;
use App\Utils\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ProductClassController extends Controller
{
    /**
     * All Utils instance.
     *
     */
    protected $commonUtil;
    protected $datatableUtil;


    /**
     * Constructor
     *
     * @param ProductUtils $product
     * @return void
     */
    public function __construct(Util $commonUtil, DatatableUtil $datatableUtil)
    {
        $this->commonUtil = $commonUtil;
        $this->datatableUtil = $datatableUtil;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->can('category.view')) {
            abort(403, __('lang.not_authorized'));
        }

        if (request()->ajax()) {

            $product_classes = ProductClass::orderBy('sort', 'asc');


            $product_classes = $product_classes->select(
                'product_classes.*',

            );

            return DataTables::of($product_classes)
                ->addColumn('image', function ($row) {
                    $image = $row->getFirstMediaUrl('product_class');
                    if (!empty($image)) {
                        return '<img src="' . $image . '" height="50px" width="50px">';
                    } else {
                        return '<img src="' . asset('/uploads/' . session('logo')) . '" height="50px" width="50px">';
                    }
                })
                ->addColumn(
                    'action',
                    function ($row) {
                        $html =
                            '<div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">' . __('lang.action') .
                            '<span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">';

                        $html .= '<li class="divider"></li>';
                        if (auth()->user()->can('category.edit')) {
                            $html .=
                                '<li><a data-href="' . action('Admin\ProductClassController@edit', $row->id) . '" data-container=".view_modal" class="btn btn-modal"
                            target="_blank"><i class="fas fa-edit"></i> ' . __('lang.edit') . '</a></li>';
                        }

                        $html .= '<li class="divider"></li>';
                        if (auth()->user()->can('category.delete')) {
                            $html .=
                                '<li>
                            <a data-href="' . action('Admin\ProductClassController@destroy', $row->id) . '"
                                data-check_password="' . action('Admin\UserController@checkPassword', Auth::user()->id) . '"
                                class="btn text-red delete_item"><i class="fa fa-trash"></i>
                                ' . __('lang.delete') . '</a>
                        </li>';
                        }

                        $html .= '</ul></div>';

                        return $html;
                    }
                )

                ->rawColumns([
                    'image',
                    'action',
                ])
                ->make(true);
        }


        return view('admin.product_class.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->can('category.create')) {
            abort(403, __('lang.not_authorized'));
        }
        $quick_add = request()->quick_add ?? null;

        return view('admin.product_class.create')->with(compact(
            'quick_add'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->can('category.create')) {
            abort(403, __('lang.not_authorized'));
        }
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'max:255', 'unique:product_classes,name']
        ]);
        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(array(
                    'success' => false,
                    'message' => 'There are incorect values in the form!',
                    'msg' => $validator->getMessageBag()->first()
                ));
            }
        }
        try {
            $data = $request->except('_token', 'quick_add');

            $class = ProductClass::create($data);

            if ($request->has('image')) {
                $class->addMedia($request->image)->toMediaCollection('product_class');
                $data['image'] = $class->getFirstMediaUrl('product_class');
            }

            $this->commonUtil->addSyncDataWithPos('ProductClass', $class, $data, 'POST', 'product-class');

            $output = [
                'success' => true,
                'id' => $class->id,
                'msg' => __('lang.success')
            ];
        } catch (\Exception $e) {
            Log::emergency('File: ' . $e->getFile() . 'Line: ' . $e->getLine() . 'Message: ' . $e->getMessage());
            $output = [
                'success' => false,
                'msg' => __('lang.something_went_wrong')
            ];
        }


        if ($request->quick_add) {
            return $output;
        }

        return redirect()->back()->with('status', $output);
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
        if (!auth()->user()->can('category.edit')) {
            abort(403, __('lang.not_authorized'));
        }

        $product_class = ProductClass::find($id);

        return view('admin.product_class.edit')->with(compact(
            'product_class'
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
        if (!auth()->user()->can('category.edit')) {
            abort(403, __('lang.not_authorized'));
        }

        $this->validate(
            $request,
            ['name' => ['required', 'max:255']]
        );

        try {
            $data = $request->only('name', 'description', 'sort');
            $class = ProductClass::where('id', $id)->first();
            $class->update($data);

            if ($request->has('image')) {
                $class->clearMediaCollection('product_class');
                $class->addMedia($request->image)->toMediaCollection('product_class');
                $data['image'] = $class->getFirstMediaUrl('product_class');
            }

            $this->commonUtil->addSyncDataWithPos('ProductClass', $class, $data, 'PUT', 'product-class');

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
        if (!auth()->user()->can('category.delete')) {
            abort(403, __('lang.not_authorized'));
        }
        try {

            $class = ProductClass::find($id);

            $this->commonUtil->addSyncDataWithPos('ProductClass', $class, null, 'DELETE', 'product-class');
            $class->delete();
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

    public function getDropdown()
    {
        $product_classes = ProductClass::orderBy('name', 'asc')->pluck('name', 'id');
        $product_classes_dp = $this->commonUtil->createDropdownHtml($product_classes, __('lang.please_select'));

        return $product_classes_dp;
    }
}
