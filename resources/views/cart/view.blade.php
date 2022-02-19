@extends('layouts.app')
@section('content')

<div class="container mx-auto mt-14">
    <div class="flex mt-52 bg-red">
        <div class="relative overflow-hidden w-full h-48 ">
            <img src="{{asset('images/cart-top.png')}}" class="mx-auto w-full h-full object-cover " alt="cart-top">
            <div
                class="absolute w-full py-2.5 px-5 bottom-0 inset-x-0 text-white text-xs text-center leading-4 bg-gradient-to-t from-black">
                <p class="text-tiny font-semibold text-white py-10"></p>
            </div>

        </div>
    </div>
</div>

<div class="container mx-auto py-4">
    <div class="flex flex-row ">
        <div class="flex-1 px-32">
            <div class="form-group">
                <label class="font-semibold text-base text-dark" for="sales_note">@lang('lang.notes')</label>
                <textarea class="border-b border-dark rounded-lg w-full px-4" name="sales_note" id="sales_note"
                    rows="3"></textarea>
            </div>
            <div class="flex flex-row py-2 flow-root">
                <label class="font-semibold text-base text-dark pr-2 pt-1 float-left"
                    for="sales_note">@lang('lang.name')</label>
                <input type="text" class="border-b border-dark rounded-lg w-full px-4 w-3/5 float-right " value="">
            </div>
            <div class="flex flex-row py-2 flow-root">
                <label class="font-semibold text-base text-dark pr-2 pt-1 float-left"
                    for="sales_note">@lang('lang.phone_number')</label>
                <input type="text" class="border-b border-dark rounded-lg w-full px-4 w-3/5 float-right " value="">
            </div>


            <div class="flex  py-2 justify-center">
                <div class="flex-1">
                    <label class="order_now font-semibold text-base text-dark pr-2 pt-1 float-right"
                        for="sales_note">@lang('lang.order_now')</label>
                </div>
                <div class="flex w-16 justify-center">
                    <div class="mt-1">
                        <label for="order" class="flex relative items-center mb-4 cursor-pointer">
                            <input type="checkbox" id="order" value="1" class="sr-only">
                            <div
                                class="w-11 h-6 bg-gray-200 rounded-full border border-red toggle-bg dark:bg-gray-700 dark:border-gray-600">
                            </div>
                            <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300"></span>
                        </label>
                    </div>
                </div>
                <div class="flex-1">
                    <label class="order_later font-semibold text-base text-lightgrey pr-2 pt-1 float-left"
                        for="sales_note">@lang('lang.order_later')</label>
                </div>
            </div>
            <div class="flex flex-row justify-center order_later_div hidden ">
                <img class="h-8 w-12 px-2 mt-1" src="{{asset('images/calender-icon.png')}}" alt="">
                <select id="month" name="month"
                    class="w-16 mx-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @for ($i=1; $i <= 12; $i++) <option value="{{$i}}">{{$i}}</option>@endfor
                </select>
                <select id="day" name="day"
                    class="w-16 mx-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @for ($i=1; $i <= 31; $i++) <option value="{{$i}}">{{$i}}</option>@endfor
                </select>
                <img class="h-8 w-12 px-2 mt-1" src="{{asset('images/time-icon.png')}}" alt="">

                <input type="time" id="base-input"
                    class="w-32 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

            </div>


            <div class="flex flex-row py-2 justify-center">
                <div class="flex-1">
                    <label class="i_will_pick font-semibold text-base text-lightgrey pr-2 pt-1 float-right"
                        for="sales_note">@lang('lang.i_will_pick_it_up_my_self')</label>
                </div>
                <div class="flex w-16 justify-center">
                    <div class="mt-1">
                        <label for="delivery" class="flex relative items-center mb-4 cursor-pointer">
                            <input type="checkbox" id="delivery" checked value="1" class="sr-only">
                            <div
                                class="w-11 h-6 bg-gray-200 rounded-full border border-red toggle-bg dark:bg-gray-700 dark:border-gray-600">
                            </div>
                            <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300"></span>
                        </label>
                    </div>
                </div>
                <div class="flex-1">
                    <label class="home_delivery font-semibold text-base text-dark pr-2 pt-1 float-left"
                        for="sales_note">@lang('lang.home_delivery')</label>
                </div>
            </div>
            <div class="flex flex-row py-2  justify-center">
                <div class="flex-1">
                    <label class="pay_online font-semibold text-base text-lightgrey pr-2 pt-1 float-right"
                        for="sales_note">@lang('lang.pay_online')</label>
                </div>
                <div class="flex w-16 justify-center">
                    <div class="mt-1">
                        <label for="payment_type" class="flex relative items-center mb-4 cursor-pointer">
                            <input type="checkbox" id="payment_type" checked value="1" class="sr-only">
                            <div
                                class="w-11 h-6 bg-gray-200 rounded-full border border-red toggle-bg dark:bg-gray-700 dark:border-gray-600">
                            </div>
                            <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300"></span>
                        </label>
                    </div>
                </div>
                <div class="flex-1">
                    <label class="cash_on_delivery font-semibold text-base text-dark pr-2 pt-1 float-left"
                        for="sales_note">@lang('lang.cash_on_delivery')</label>
                </div>
            </div>
        </div>
        <div class="flex-1 px-32">
            <div class="flex-col justify-end">
                <h3 class="font-semibold text-lg text-dark">Product 1</h3>
                <p class="text-xs text-dark font-semibold">Lorem ipsum dolor sit amet</p>
                <h3 class="font-semibold text-lg text-dark py-2">@lang('lang.select_size')</h3>
                <div class="flex flex-row">
                    <div class="flex-1">
                        <div class="form-check">
                            <input
                                class="form-check-input appearance-none h-4 w-4 border border-red rounded-sm bg-white checked:bg-red checked:border-red focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label inline-block text-gray-800 font-semibold"
                                for="flexCheckDefault">
                                Medium
                            </label>
                        </div>
                    </div>
                    <div class="flex-1 text-base text-right font-semibold">
                        76<span class="font-bold"> TL</span>
                    </div>
                </div>
            </div>

            <h3 class="font-semibold text-lg text-dark pt-5">@lang('lang.extras')</h3>
            <div class="flex flex-row py-2">
                <div class="flex-1">
                    <div class="form-check">
                        <input
                            class="form-check-input appearance-none h-4 w-4 border border-red rounded-sm bg-white checked:bg-red checked:border-red focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                            type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label inline-block text-gray-800 font-semibold" for="flexCheckDefault">
                            Pepsi
                        </label>
                    </div>
                </div>
                <div class="flex-1 text-base text-right font-semibold">
                    23<span class="font-bold"> TL</span>
                </div>
            </div>
            <div class="flex flex-row py-2">
                <div class="flex-1">
                    <div class="form-check">
                        <input
                            class="form-check-input appearance-none h-4 w-4 border border-red rounded-sm bg-white checked:bg-red checked:border-red focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                            type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label inline-block text-gray-800 font-semibold" for="flexCheckDefault">
                            Fanta
                        </label>
                    </div>
                </div>
                <div class="flex-1 text-base text-right font-semibold">
                    33<span class="font-bold"> TL</span>
                </div>
            </div>
            <div class="flex flex-row py-2">
                <div class="flex-1">
                    <div class="form-check">
                        <input
                            class="form-check-input appearance-none h-4 w-4 border border-red rounded-sm bg-white checked:bg-red checked:border-red focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                            type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label inline-block text-gray-800 font-semibold" for="flexCheckDefault">
                            Salad
                        </label>
                    </div>
                </div>
                <div class="flex-1 text-base text-right font-semibold">
                    55<span class="font-bold"> TL</span>
                </div>
            </div>

        </div>
    </div>

    <div class="flex justify-center">
        <div class="">
            <div class="flex flex-row">
                <button
                    class="minus border-2 rounded-full text-lg text-center border-lightgrey text-lightgrey h-8 w-8">-</button>
                <input type="quantity" value="1" class="quantity text-center focus:outline-none text-lightgrey">
                <button
                    class="plus border-2 rounded-full text-lg text-center border-lightgrey text-lightgrey h-8 w-8">+</button>
            </div>
        </div>
    </div>
    <div class="flex justify-center">
        <button class="w-1/4 h-10 mt-4 rounded-lg  bg-red text-white">@lang('lang.send_the_order')</button>
    </div>
</div>


@endsection

@section('javascript')
<script>
    $(document).on('click', '.plus', function(){
        let quantity = __read_number($('.quantity'));
        $('.quantity').val(quantity + 1);
    })
    $(document).on('click', '.minus', function(){
        let quantity = __read_number($('.quantity'));
        if(quantity > 1){
            $('.quantity').val(quantity - 1);
        }
    })

    $(document).on('change', '#order', function(){
        if($(this).prop('checked') == true){
            $('.order_now').removeClass('text-dark');
            $('.order_now').addClass('text-lightgrey');

            $('.order_later').addClass('text-dark');
            $('.order_later').removeClass('text-lightgrey');
            $('.order_later_div').removeClass('hidden');
        }else{
            $('.order_now').addClass('text-dark');
            $('.order_now').removeClass('text-lightgrey');

            $('.order_later').removeClass('text-dark');
            $('.order_later').addClass('text-lightgrey');
            $('.order_later_div').addClass('hidden');
        }
    })

    $(document).on('change', '#delivery', function(){
        if($(this).prop('checked') == true){
            $('.i_will_pick').removeClass('text-dark');
            $('.i_will_pick').addClass('text-lightgrey');

            $('.home_delivery').addClass('text-dark');
            $('.home_delivery').removeClass('text-lightgrey');
        }else{
            $('.i_will_pick').addClass('text-dark');
            $('.i_will_pick').removeClass('text-lightgrey');

            $('.home_delivery').removeClass('text-dark');
            $('.home_delivery').addClass('text-lightgrey');
        }
    })

    $(document).on('change', '#payment_type', function(){
        if($(this).prop('checked') == true){
            $('.pay_online').removeClass('text-dark');
            $('.pay_online').addClass('text-lightgrey');

            $('.cash_on_delivery').addClass('text-dark');
            $('.cash_on_delivery').removeClass('text-lightgrey');
        }else{
            $('.pay_online').addClass('text-dark');
            $('.pay_online').removeClass('text-lightgrey');

            $('.cash_on_delivery').removeClass('text-dark');
            $('.cash_on_delivery').addClass('text-lightgrey');
        }
    })

    // const datepickerEl = document.getElementById('datepicker');
    // new Datepicker(datepickerEl, {
    //     // options
    // });
</script>

@endsection
