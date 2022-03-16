@extends('layouts.app')

@section('content')
@include('layouts.partials.category-header')

<div class="container mx-auto mt-14">

    <div class="w-full mx-auto p-4">
        <div class="grid xs:grid-cols-3 md:grid-cols-4 xs:gap-2 md:gap-16 md:mt-12 xs:mt-6">
            @foreach ($products as $product)
            @include('home.partial.product_card', ['product' => $product])
            @endforeach
        </div>
    </div>


    {{-- @foreach ($products->chunk(4) as $product_chunk)
    <div class="flex flex-row flex-wrap justify-center">
        @foreach ($product_chunk as $product)
        @include('home.partial.product_card', ['product' => $product])
        @endforeach
    </div>
    @endforeach --}}


    @include('layouts.partials.cart-row')
</div>



@endsection

@section('javascript')
<script>
    $(document).on('click', '.product_card', function(e){
        if(!$(e.target).is('i.cart_icon') && !$(e.target).is('button.cart_button *')){
            window.location.href = $(this).data('href');
        }
    })
    $(document).on('click', '.cart_button, .cart_icon', function(){
        window.location.href = base_path + '/cart/add-to-cart/' + $(this).data('product_id');
    })
</script>

@endsection
