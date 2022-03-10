<a href="{{action('ProductController@getProductListByCategory', $category->id)}}"
    class="text-center w-1/4 xl:p-16 lg:p-8 md:p-2 sm:p-1">
    <div class="flex-col mx-auto">
        <div class="">
            <img src="{{!empty($category->getFirstMediaUrl('product_class')) ? $category->getFirstMediaUrl('product_class') : asset('uploads/'. session('logo'))}}"
                class="border-2 border-dark mx-auto my-4 md:h-72 sm:h-48 rounded-lg {{$border_round}}" alt="category-1">
        </div>
        <div class="h-10 w-32 bg-darkblue mx-auto text-center rounded-3xl">
            <h3 class="text-xl text-white font-semibold py-1">{{$category->name}}</h3>
        </div>
    </div>
</a>
