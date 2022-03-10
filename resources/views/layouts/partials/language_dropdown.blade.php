<div x-data="{ dropdownOpen: false }" class="relative">
    <button @click="dropdownOpen = !dropdownOpen"
        class="relative z-10 block rounded-tr-full rounded-br-full bg-red p-2 focus:outline-none w-32 flex items-center">
        <img class="h-5 w-5 text-gray-800" src="{{ asset('images/' . app()->getLocale() . '-flag.png') }}" alt="">
        <p class="text-dark text-sm mx-2">
            @lang('lang.'.app()->getLocale())
        </p>
        <i class="fa fa-chevron-down text-base"></i>
    </button>
    <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10">
    </div>

    <div x-show="dropdownOpen" class="absolute left-0 mt-2 bg-red rounded-md shadow-lg overflow-hidden z-20 w-32">
        <div class="py-2">
            <a href="{{ url('/') .'/ar' }}" class="flex items-center px-4 py-1 -mx-2">
                <img class="h-5 w-5 rounded-full object-cover mx-1" src="{{ asset('images/ar-flag.png') }}"
                    alt="avatar">
                <p class="text-dark text-sm mx-2">
                    Arabic
                </p>
            </a>
            <div class="w-9/12 mx-auto" style="height: 1px; background-color: rgba(0,0,0, 0.5)"></div>
            <a href="{{ url('/') .'/nl' }}" class="flex items-center px-4 py-1 -mx-2">
                <img class="h-5 w-5 rounded-full object-cover mx-1" src="{{ asset('images/nl-flag.png') }}"
                    alt="avatar">
                <p class="text-dark text-sm mx-2">
                    Deutsch
                </p>
            </a>
            <div class="w-9/12 mx-auto" style="height: 1px; background-color: rgba(0,0,0, 0.5)"></div>
            <a href="{{ url('/') .'/en' }}"
                class="flex items-center px-4 py-1 -mx-2">
                <img class="h-5 w-5 rounded-full object-cover mx-1" src="{{ asset('images/en-flag.png') }}"
                    alt="avatar">
                <p class="text-dark text-sm mx-2">
                    English
                </p>
            </a>
            <div class="w-9/12 mx-auto" style="height: 1px; background-color: rgba(0,0,0, 0.5)"></div>
            <a href="{{ url('/') .'/tr' }}"
                class="flex items-center px-4 py-1 -mx-2">
                <img class="h-5 w-5 rounded-full object-cover mx-1" src="{{ asset('images/tr-flag.png') }}"
                    alt="avatar">
                <p class="text-dark text-sm mx-2">
                    Turkce
                </p>
            </a>
            <div class="w-9/12 mx-auto" style="height: 1px; background-color: rgba(0,0,0, 0.5)"></div>
            <a href="{{ url('/') .'/fa' }}"
                class="flex items-center px-4 py-1 -mx-2">
                <img class="h-5 w-5 rounded-full object-cover mx-1" src="{{ asset('images/fa-flag.png') }}"
                    alt="avatar">
                <p class="text-dark text-sm mx-2">
                    فارسی
                </p>
            </a>
        </div>
    </div>
</div>
