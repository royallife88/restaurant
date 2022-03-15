<a href="{{action('ProductController@show', $offer['product_id'])}}" class="text-center w-1/4 xl:p-16 lg:p-8 md:p-2 sm:p-1">
    <div class="flex-col h-78 mx-auto rounded-tl-lg rounded-tr-lg border-2 border-lightblue bg-white">
        <div class="w-full md:h-48 sm:h-24 rounded-tl-lg rounded-tr-lg">
            <img src="{{!empty($offer['image']) ? $offer['image'] : asset('uploads/'. session('logo'))}}" class="mx-auto md:h-48 sm:h-24 rounded-tr-lg rounded-tl-lg w-full"
                alt="offer">
        </div>
        <div class="h-10 w-full mx-auto text-center px-4 sm:px-1">
            <h3 class="text-base font-semibold text-dark sm:text-sm">{{$offer['product_name']}}</h3>
            <h3 class="text-base font-semibold text-dark sm:text-sm">{!!$offer['product_details']!!}</h3>
        </div>
        <div class="flex flex-row px-4">
            <div class="flex-1 text-base font-semibold pt-1 text-left">{{@num_format($offer['discount_price'])}}TL</div>
            <div class="flex-1 text-base font-semibold pt-1 text-right"><span
                    class="strikethrough">{{@num_format($offer['sell_price'])}}TL</span></div>
        </div>
        <div class=" text-center w-full">
            <h3 class="md:text-lg sm:text-base py-4 font-bold">@lang('lang.order_now') <i class="fa fa-angle-right"></i>
            </h3>
        </div>
    </div>
</a>
