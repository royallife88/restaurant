<div class="w-full flex flex-row  bg-blend-overlay bg-gray-600 bg-center bg-no-repeat bg-cover text-center items-center"
    style="height: 542px; background-image: url('{{ asset('uploads/' . session('home_background_image')) }}')">
    <div class="w-full">
        <div class="flex flex-row">
            <div class="flex-3 text-white text-4xl font-bold text-left w-32">
                @include('layouts.partials.language_dropdown')
            </div>
            <div class="flex-1  mt-8">
                <img src="{{ asset('uploads/' . session('logo')) }}" alt="logo" class="mx-auto md:w-56 md:h-56 md:w-40 md:h-40">
            </div>
            <div class="flex-3 w-32 items-end">
                <a href="https://api.whatsapp.com/send?phone={{ App\Models\System::getProperty('whatsapp') }}"
                    class="absolute right-0">
                    <img src="{{ asset('images/chat-icon.png') }}" alt="chat-icon" class=" w-10 h-10 ">
                </a>
            </div>
        </div>

    </div>
</div>
