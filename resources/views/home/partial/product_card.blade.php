<a href="{{ action('ProductController@show', $product->id) }}"
    class="w-full h-0 shadow-lg pb-full rounded-xl bg-center bg-no-repeat bg-cover relative mb:mb-8 xs:mb-16 border-2 border-dark product_card"
    style="background-image: url('{{ !empty($product->getFirstMediaUrl('product'))? $product->getFirstMediaUrl('product'): asset('uploads/' . session('logo')) }}')">
    <div
        class="absolute w-full pb-2.5 pt-8 px-5 bottom-0 inset-x-0 text-white text-xs text-center leading-4 bg-gradient-to-t from-black">
        <p class="text-tiny font-semibold text-white py-0">{{ $product->name }}</p>
        <p class="text-tiny font-semibold text-white py-0">{{ $product->description }}</p>
        <p class="text-tiny font-semibold text-white py-0">TL
            {{ @num_format($product->sell_price - $product->discount_value) }}</p>
    </div>
    <div class="flex  w-full text-center">
        <div class="absolute bottom-0 mx-auto w-full">
            <button data-product_id="{{ $product->id }}" type="button"
                class="bg-white text-red hover:bg-red hover:text-white transition-all duration-500 w-12 h-12 rounded-full mb-16 opacity-0 cart_button">
                <i class=" fa fa-lg fa-cart-plus cart_icon"></i>
            </button>
        </div>
    </div>
</a>
