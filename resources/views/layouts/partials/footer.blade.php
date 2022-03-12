<div class="footer w-full bg-dark h-60 ">
    <div class=" mx-auto">
        <div class="flex flex-row">
            <div class="w-3/4 text-right">
                <div class="flex-col mt-6">
                    <div class="pr-4 pt-2 font-semibold text-lg text-white">@lang('lang.about_us')</div>
                    <div class="pr-4 pt-2 font-semibold md:text-base xs:text-sm text-white">
                        <a href="{{ action('AboutUsController@index') }}">
                            {{ App\Models\System::getProperty('about_us_footer') }}
                        </a>
                    </div>
                    <div class="pr-4 pt-2 mt-8">
                        <a href="{{ action('AboutUsController@index') }}"
                            class="bg-red text-white md:text-base xs:text-sm font-bold px-4 py-2 border-2 border-white rounded-lg">@lang('lang.show_more')
                        </a>
                    </div>
                </div>
            </div>
            <div class="w-1/4 text-center md:block xs:hidden">
                <div class="font-semibold text-white mt-8">{{ App\Models\System::getProperty('site_title') }}</div>
            </div>
            <div class="w-1/4 text-left">
                <img src="{{ asset('uploads/' . session('logo')) }}" alt="logo" class="mt-8 w-24 h-24">
            </div>

        </div>
    </div>
</div>
