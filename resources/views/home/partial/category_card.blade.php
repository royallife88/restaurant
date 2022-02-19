<a href="{{action('ProductController@getProductsByClass', 1)}}"
    class="flex-1 text-center w-4/5 xl:p-16 lg:p-8 md:p-2 sm:p-1">
    <div class="flex-col mx-auto">
        <div class="">
            <img src="{{asset('images/bg-1.jpg')}}"
                class="border-2 border-dark mx-auto my-4 md:h-72 sm:h-48 rounded-lg {{$border_round}}" alt="category-1">
        </div>
        <div class="h-10 w-32 bg-darkblue mx-auto text-center rounded-3xl">
            <h3 class="text-xl text-white font-semibold py-1">@lang('lang.tasty')</h3>
        </div>
    </div>
</a>
