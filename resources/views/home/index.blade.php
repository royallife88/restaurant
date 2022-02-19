@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="flex">
        <div class="flex-1">
            <div class="w-1/2 h-10 bg-red text-white mx-auto text-center -mt-5 rounded-xl">
                <h3 class="text-2xl text-white font-semibold py-1">@lang('lang.categories')</h3>
            </div>
        </div>
    </div>
</div>
<div class="container mx-auto mt-14">
    <div class="flex flex-row flex-wrap justify-center">
        @include('home.partial.category_card', ['border_round' => 'rounded-tl-3xl'])
        @include('home.partial.category_card', ['border_round' => ''])
        @include('home.partial.category_card', ['border_round' => ''])
        @include('home.partial.category_card', ['border_round' => 'rounded-tr-3xl'])
    </div>
</div>
<div class="container mx-auto">
    <div class="flex">
        <div class="flex-1">
            <div class="w-1/2 h-10 bg-red text-white mx-auto text-center mt-14 rounded-xl">
                <h3 class="text-2xl text-white font-semibold py-1">@lang('lang.promotions')</h3>
            </div>
        </div>
    </div>
</div>
<div class="container mx-auto mt-14">
    <div class="flex flex-row flex-wrap justify-center">
        @include('home.partial.promotion_card')
        @include('home.partial.promotion_card')
        @include('home.partial.promotion_card')
        @include('home.partial.promotion_card')
    </div>

    <div class="container mx-auto">
        <div class="flex justify-end">
            <button
                class="bg-red text-white font-semibold py-1 px-4 rounded-md mr-16 mt-8">@lang('lang.show_more')</button>
        </div>
    </div>

    @include('layouts.partials.cart-row')
</div>
@endsection

@section('javascript')


@endsection
