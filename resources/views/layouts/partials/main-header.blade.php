<div class="w-full flex flex-row bg-center bg-no-repeat bg-cover text-center items-center"
    style="height: 542px; background-image: url('@if (!empty(session('home_background_image'))) {{ asset('uploads/' . session('home_background_image')) }}@else{{ asset('images/default-home-bg.png') }} @endif')">
    <div class="w-full">
        <div class="flex flex-row">
            <div class="flex-3 text-white text-4xl font-bold text-left w-48">
                @include('layouts.partials.language_dropdown')
            </div>
            <div class="flex-1">
            </div>
            <div class="flex-3 w-48 items-end">
                @include('layouts.partials.social_icons')
            </div>
        </div>
        <div class="flex flex-row mt-2">
            <img src="{{ asset('uploads/' . session('logo')) }}" alt="logo"
                class="mx-auto md:w-56 md:h-56 xs:w-40 xs:h-40">

        </div>

    </div>
</div>
