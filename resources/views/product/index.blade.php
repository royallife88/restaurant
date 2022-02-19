@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-14">
    <div class="flex flex-row flex-wrap justify-center">
        @include('home.partial.product_card')
        @include('home.partial.product_card')
        @include('home.partial.product_card')
        @include('home.partial.product_card')
    </div>
    <div class="flex flex-row flex-wrap justify-center">
        @include('home.partial.product_card')
        @include('home.partial.product_card')
        @include('home.partial.product_card')
        @include('home.partial.product_card')
    </div>

    @include('layouts.partials.cart-row')
</div>



@endsection

@section('javascript')


@endsection
