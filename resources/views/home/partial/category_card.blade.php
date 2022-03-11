<a href="{{ action('ProductController@getProductListByCategory', $category->id) }}"
    class="text-center w-1/4 xl:p-16 lg:p-8 md:p-2 xs:p-1">
    <div class="flex-col mx-auto">
        <div class="">
            <img src="{{ !empty($category->getFirstMediaUrl('product_class'))? $category->getFirstMediaUrl('product_class'): asset('uploads/' . session('logo')) }}"
                class="border-2 border-dark mx-auto my-4 xl:h-72 lg:h-72 md:h-64 sm:h-48 xs:h-36 rounded-lg {{ $border_round }}"
                alt="category-1">
        </div>
        <div class="h-10 md:w-32 xs:w-24 bg-darkblue mx-auto text-center rounded-3xl">
            <h3 class="md:text-xl xs:text-base text-white font-semibold py-1">{{ $category->name }}</h3>
        </div>
    </div>
</a>
