<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Offer;
use App\Models\Product;
use App\Models\Variation;
use App\Utils\CartUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * All Utils instance.
     *
     */
    protected $cartUtil;

    /**
     * Constructor
     *
     * @param Util $cartUtil
     * @return void
     */
    public function __construct(CartUtil $cartUtil)
    {
        $this->cartUtil = $cartUtil;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        $user_id = Session::get('user_id');

        $cart_content = \Cart::session($user_id)->getContent()->sortBy('name');

        $extras = Product::leftjoin('product_classes', 'products.product_class_id', 'product_classes.id')
            ->where('product_classes.name', 'Extras')
            ->where('active', 1)
            ->select('products.*')
            ->get();

        $total = \Cart::session($user_id)->getTotal();

        return view('cart.view')->with(compact(
            'extras',
            'total',
            'cart_content'
        ));
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * add the resource to cart
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addToCartExtra($id)
    {
        try {
            $quantity = !empty(request()->quantity) ? request()->quantity : 1;
            $product = Product::find($id);
            $variation = Variation::where('product_id', $id)->first();


            $user_id = Session::get('user_id');
            \Cart::session($user_id)->add(array(
                'id' => $product->id,
                'name' => $product->name,
                'price' => $variation->default_sell_price,
                'quantity' => $quantity,
                'attributes' => [
                    'variation_id' => $variation->id,
                    'extra' => true
                ],
                'associatedModel' => $product
            ));

            $this->cartUtil->createOrUpdateCart($user_id);

            $output = [
                'success' => 1,
                'msg' => __('lang.success')
            ];
        } catch (\Exception $e) {
            Log::emergency('File: ' . $e->getFile() . 'Line: ' . $e->getLine() . 'Message: ' . $e->getMessage());
            $output = [
                'success' => 0,
                'msg' => __('lang.something_went_wrong')
            ];
        }

        return redirect()->back()->with('status', $output);
    }

    /**
     * add the resource to cart
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addToCart($id)
    {
        // try {
        $quantity = !empty(request()->quantity) ? request()->quantity : 1;
        $product = Product::find($id);
        $variation = Variation::where('product_id', $id)->first();

        $user_id = Session::get('user_id');
        $price = $variation->default_sell_price;

        $offers = Offer::whereDate('start_date', '<=', date('Y-m-d'))->whereDate('end_date', '>=', date('Y-m-d'))->whereJsonContains('product_ids', (string) $id)->where('status', 1)->first();
        if (!empty($offers)) {
            $price = $price - $offers->discount_value;
        } else {
            $price = $price - $product->discount_value;
        }
        $item_exist = \Cart::session($user_id)->get($product->id);


        if (!empty($item_exist)) {
            \Cart::session($user_id)->update($product->id, array(
                'quantity' =>  array(
                    'relative' => false,
                    'value' => $item_exist->quantity + 1
                ),
            ));
        } else {
            \Cart::session($user_id)->add(array(
                'id' => $product->id,
                'name' => $product->name,
                'price' => $price,
                'quantity' =>  $quantity,
                'attributes' => [
                    'variation_id' => $variation->id,
                    'extra' => false,
                    'discount' => $product->discount_value
                ],
                'associatedModel' => $product
            ));
        }

        $this->cartUtil->createOrUpdateCart($user_id);

        $output = [
            'success' => 1,
            'msg' => __('lang.success')
        ];
        // } catch (\Exception $e) {
        //     Log::emergency('File: ' . $e->getFile() . 'Line: ' . $e->getLine() . 'Message: ' . $e->getMessage());
        //     $output = [
        //         'success' => false,
        //         'msg' => __('lang.something_went_wrong')
        //     ];
        // }

        return redirect()->back()->with('status', $output);
    }
    /**
     * remove product from cart
     *
     * @param int $product_id
     * @return void
     */
    public function removeProduct($product_id)
    {
        try {
            $user_id = Session::get('user_id');
            \Cart::session($user_id)->remove($product_id);

            $this->cartUtil->createOrUpdateCart($user_id);

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
     * update product variation
     *
     * @return void
     */
    public function updateProductQuantity($product_id, $quantity)
    {
        try {
            $user_id = Session::get('user_id');


            \Cart::session($user_id)->update($product_id, array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $quantity
                ),
            ));

            $this->cartUtil->createOrUpdateCart($user_id);

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
     * update product variation
     *
     * @return void
     */
    public function updateProductVariation($product_id, $variation_id)
    {
        try {
            $user_id = Session::get('user_id');

            $product = Product::find($product_id);
            $variation = Variation::where('id', $variation_id)->first();



            \Cart::session($user_id)->update($product->id, array(
                'price' => $variation->default_sell_price,
                'attributes' => [
                    'variation_id' => $variation->id,
                ],
            ));

            $this->cartUtil->createOrUpdateCart($user_id);

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
    public function clearCart()
    {
        try {
            $user_id = Session::get('user_id');

            \Cart::session($user_id)->clear();

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
}
