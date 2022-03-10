<div class="w-full flex flex-row bg-blend-overlay bg-dark bg-no-repeat bg-center bg-cover text-center items-center"
    style="height: 200px; background-image: url('{{ asset('uploads/' . session('breadcrumb_background_image')) }}');">
    <div class="w-full">
        <div class="flex flex-row">
            <div class="flex-3 text-white text-4xl font-bold text-left">
                @include('layouts.partials.language_dropdown')
            </div>
            <div class="flex-1 mt-8 text-center">
                <p class="font-bold text-4xl text-white">{{ $product->name }}</p>
            </div>
            <div class="flex-3">
                <a href="https://api.whatsapp.com/send?phone={{ App\Models\System::getProperty('whatsapp') }}">
                    <img src="{{ asset('images/chat-icon.png') }}" alt="chat-icon" class="m-auto w-10 h-10">
                </a>
            </div>
        </div>

        <div class="container mx-auto mt-16">
            <div class="flex justify-end w-full">
                <a class="text-xl text-white font-semibold px-2"
                    href="{{ action('HomeController@index') }}">@lang('lang.home')</a>
                <span class="text-xl text-white font-semibold px-1">-</span>
                <a class="text-xl text-white font-semibold px-2"
                    href="{{ action('ProductController@getProductListByCategory', $product->category->id) }}">{{ $product->category->name }}</a>
                <span class="text-xl text-white font-semibold px-1">-</span>
                <a class="text-xl text-white font-semibold px-2"
                    href="{{ action('ProductController@show', $product->id) }}">{{ $product->name }}</a>
            </div>
        </div>
    </div>
</div>
