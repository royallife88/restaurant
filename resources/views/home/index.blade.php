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
        @if (!empty($homepage_category_carousel))
            <div class="carosual">
                <div class="flex flex-row items-center">
                    <div class="flex-3 w-48">
                        <div class="owl-nav">
                            <div class="owl-next-custom-erp">
                                <img src="{{ asset('images/slider-arrow.png') }}" alt="" class="m-auto">
                            </div>
                        </div>
                    </div>
                    <div class="flex-1 w-96">
                        <div class="owl-carousel owl-carousel-erp owl-theme">
                            {{-- @foreach ($arr as $i)
                            <div>
                                <div class="flex-2 p-4 bg-lightgray">
                                    <div class="flex-col">
                                        <div class="py-6">
                                            <img class="w-full h-72" src="{{ $page_data['ready_made_erp_' . $i . '_image'] }}"
                                                alt="robot">
                                        </div>
                                        <div>
                                            <h4 class="xl:text-3xl lg:text-2xl text-darkblue font-bold">
                                                {{ $page_data['ready_made_erp_' . $i . '_heading'] }}</h4>
                                        </div>
                                        <div>
                                            <p class="text-dark text-sm  pb-4 pr-28">
                                                {{ $page_data['ready_made_erp_' . $i . '_text'] }}
                                            </p>
                                        </div>
                                        <div>
                                            <a class="text-darkblue text-sm underline "
                                                href="{{ $page_data['ready_made_erp_' . $i . '_link'] }}">@lang('lang.read_more')</a>
                                        </div>
                                        <div class="inline-flex items-center mt-12">
                                            <img class="mr-2 h-5" src="{{ asset('images/link-icon.png') }}" alt="link"><a
                                                class="text-lightblue text-lg"
                                                href="{{ $page_data['ready_made_erp_' . $i . '_link'] }}">{{ $page_data['ready_made_erp_' . $i . '_link'] }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endforeach --}}


                            @foreach ($categories as $category)
                                <div style="margin-left: 20px; margin-right: 20px;">
                                    @include('home.partial.category_card', [
                                        'category' => $category,
                                        'border_round' => '',
                                    ])
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="flex-3 w-48 justify-center">
                        <div class="owl-nav">
                            <div class="owl-prev-custom-erp">
                                <img src="{{ asset('images/slider-arrow.png') }}" alt="" class="m-auto">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            @php
                $chunk_count = 1;
            @endphp
            @foreach ($categories->chunk(4) as $categoryChunk)
                <div class="flex flex-row flex-wrap justify-center">
                    @foreach ($categoryChunk as $category)
                        @php
                            $border_round = '';
                            if ($loop->iteration == 1) {
                                $border_round = $chunk_count == 1 ? 'rounded-tl-3xl' : 'rounded-bl-3xl';
                            }
                            if ($loop->iteration == 4) {
                                $border_round = $chunk_count == 1 ? 'rounded-tr-3xl' : 'rounded-br-3xl';
                            }
                            if ($chunk_count == 2) {
                                $last_ele = $categoryChunk->last();
                                if ($last_ele->id == $category->id) {
                                    $border_round = 'rounded-br-3xl';
                                }
                            }
                        @endphp
                        @include('home.partial.category_card', [
                            'category' => $category,
                            'border_round' => $border_round,
                        ])
                    @endforeach
                </div>
                @php
                    $chunk_count++;
                @endphp
            @endforeach
        @endif
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
            @foreach ($offers_array as $offer)
                @include('home.partial.promotion_card', [
                    'offer' => $offer,
                ])
            @endforeach
        </div>

        <div class="container mx-auto">
            <div class="flex justify-end">
                <a href="{{ action('ProductController@getPromotionProducts') }}"
                    class="bg-red text-white font-semibold py-1 px-4 rounded-md mr-16 mt-8">@lang('lang.show_more')</a>
            </div>
        </div>

        @include('layouts.partials.cart-row')
    </div>
@endsection

@section('javascript')
@endsection
