<a data-href="{{action('ProductController@show', $product->id)}}" class="product_card text-center md:w-1/4 xs:w-1/3 xl:p-16 lg:p-8 xs:p-1 sm:p-2">
    <div class="flex-col mx-auto">
        <div class="relative overflow-hidden w-full rounded-lg xl:72 lg:h-64 md:h-60 sm:h-48 xs:h-36 product_card">
            <img src="{{!empty($product->getFirstMediaUrl('product')) ? $product->getFirstMediaUrl('product') : asset('uploads/'. session('logo'))}}"
                class="border-2 border-dark mx-auto w-full h-full rounded-lg object-cover " alt="category-1">
            <div
                class="absolute w-full pb-2.5 pt-8 px-5 bottom-0 inset-x-0 text-white text-xs text-center leading-4 bg-gradient-to-t from-black">
                <p class="text-tiny font-semibold text-white py-0">{{$product->name}}</p>
                <p class="text-tiny font-semibold text-white py-0">{{$product->description}}</p>
                <p class="text-tiny font-semibold text-white py-0">TL {{@num_format($product->sell_price - $product->discount_value)}}</p>
            </div>
            <div class="absolute bottom-0 mx-auto w-full">
                <button data-product_id="{{$product->id}}" type="button"
                    class="bg-white text-red hover:bg-red hover:text-white transition-all duration-500 w-12 h-12 rounded-full mb-16 opacity-0 cart_button">
                    <i class=" fa fa-lg fa-cart-plus cart_icon"></i>
                </button>
            </div>
        </div>

    </div>
</a>
