<div class="w-full flex flex-row bg-top-1 bg-blend-overlay bg-gray-600 bg-center bg-no-repeat bg-cover text-center items-center"
    style="height: 200px;">
    <div class="w-full">
        <div class="flex flex-row">
            <div class="flex-3 text-white text-4xl font-bold text-left">
                @include('layouts.partials.language_dropdown')
            </div>
            <div class="flex-1 mt-8 text-center">
                <p class="font-bold text-4xl text-white">Fast Food</p>
            </div>
            <div class="flex-3">
                <img src="{{asset('images/chat-icon.png')}}" alt="logo" class="m-auto w-10 h-10">
            </div>
        </div>

        <div class="container mx-auto mt-16">
            <div class="flex justify-end w-full">
                <a class="text-xl text-white font-semibold px-2"
                    href="{{action('HomeController@index')}}">@lang('lang.home')</a> <span
                    class="text-xl text-white font-semibold px-1">-</span>
                @if(request()->segment(1) =='cart')
                <a class="text-xl text-white font-semibold px-2"
                    href="{{action('CartController@view')}}">@lang('lang.cart')</a>
                @endif
            </div>
        </div>
    </div>
</div>
