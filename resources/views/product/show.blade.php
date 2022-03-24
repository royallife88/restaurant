@extends('layouts.app')

@section('content')
    @include('layouts.partials.product-header')

    <div class="container mx-auto mt-14">
        <div class="flex flex-row flex-wrap h-96 min-h-full">
            <div class="flex-1 xs:w-full lg:w-1/2 px-16">
                <div class="flex flex-row justify-center items-center">
                    <div class="w-32">
                        <div class="owl-nav">
                            <div class="owl-next-custom-erp text-center text-gray-600 md:text-4xl xs:text-sm">
                                <i class="fa fa-angle-left"></i>
                            </div>
                        </div>
                    </div>
                    <div class="w-full">
                        <div class="owl-carousel owl-carousel-product owl-theme ">
                            @forelse ($product->getMedia('product') as $image)
                                <div style="margin-left: 20px; margin-right: 20px;">
                                    <img src="@if (!empty($image->getUrl())) {{ $image->getUrl() }}@else{{ asset('uploads/' . session('logo')) }} @endif"
                                        class="aspect-square" alt="" style="">
                                </div>
                            @empty
                                <div style="margin-left: 20px; margin-right: 20px;">
                                    <img src="{{ asset('uploads/' . session('logo')) }}" class="aspect-square" alt=""
                                        style="">
                                </div>
                            @endforelse
                        </div>
                    </div>
                    <div class="w-32">
                        <div class="owl-nav">
                            <div class="owl-next-custom-erp text-center  text-gray-600 md:text-4xl xs:text-sm">
                                <i class="fa fa-angle-right text-grey-500"></i>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="flex-1 xs:w-full lg:w-1/2 px-16">
                <div class="flex flex-col">
                    <div class="flex-1">
                        <h1 class="text-2xl font-bold">{{ $product->name }}</h1>
                        <p class="py-2 text-gray-600">{!! $product->product_details !!}</p>
                    </div>
                    <div class="flex-1 pt-4">
                        <div class="flex flex-col">
                            <div class="flex-1">
                                <h2 class="text-xl font-bold">
                                    @if (!empty($product->discount_value) && $product->discount_value > 0)
                                        <span
                                            class="strikethrough text-gray-600 mr-4">{{ @num_format($product->sell_price) }}
                                            TL
                                    @endif
                                    </span> {{ @num_format($product->sell_price - $product->discount_value) }} TL
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="flex-1 pt-4">
                        <div class="flex flex-col">
                            <div class="flex-1">
                                <div class="flex flex-row">
                                    <button
                                        class="minus border-2 rounded-full text-lg text-center border-dark text-dark h-8 w-8">-</button>
                                    <input type="quantity" value="1"
                                        class="quantity text-center focus:outline-none text-dark bg-transparent w-16">
                                    <button
                                        class="plus border-2 rounded-full text-lg text-center border-dark text-dark h-8 w-8">+</button>
                                </div>
                                <div class="flex">
                                    <a href="{{ action('CartController@addToCart', $product->id) }}"
                                        class="add_to_cart_btn bg-red text-white font-semibold rounded-lg px-4 py-2 mt-4 ">@lang('lang.add_to_cart')</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.partials.cart-row')
    </div>
@endsection

@section('javascript')
    <script>
        $(document).on('click', '.plus', function() {
            let quantity = __read_number($('.quantity'));
            $('.quantity').val(quantity + 1);
            $('.quantity').change();
        })
        $(document).on('click', '.minus', function() {
            let quantity = __read_number($('.quantity'));
            if (quantity > 1) {
                $('.quantity').val(quantity - 1);
                $('.quantity').change();
            }
        })
        $(document).on('change', '.quantity', function() {
            $('.add_to_cart_btn').attr('href',
                '{{ action('CartController@addToCart', $product->id) }}?quantity=' +
                $(this).val());
        })

        $(document).ready(function() {
            var owl_erp = $(".owl-carousel-product");
            owl_erp.owlCarousel({
                loop: false,
                dots: false,
                items: 1,
                singleItem: true,
                autoHeight: false,
            });

            $(".owl-next-custom-erp").click(function() {
                owl_erp.trigger("next.owl.carousel");
            });
            $(".owl-prev-custom-erp").click(function() {
                owl_erp.trigger("prev.owl.carousel");
            });
        });
    </script>
@endsection
