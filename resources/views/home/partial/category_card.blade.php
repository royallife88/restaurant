<a href="{{ action('ProductController@getProductListByCategory', $category->id) }}" class="w-full h-0 shadow-lg pb-full rounded-xl bg-yellow-300 bg-center bg-no-repeat bg-cover relative mb:mb-8 xs:mb-16"
    style="background-image: url('{{ !empty($category->getFirstMediaUrl('product_class'))? $category->getFirstMediaUrl('product_class'): asset('uploads/' . session('logo')) }}')">
    <div class="flex absolute md:-bottom-16 xs:-bottom-10 w-full">
        <div class="md:h-10 xs:h-8 md:w-32 xs:w-24 bg-darkblue mx-auto text-center rounded-3xl">
            <h3 class="md:text-xl xs:text-sm text-white font-semibold py-1">{{ $category->name }}</h3>
        </div>
    </div>
</a>

