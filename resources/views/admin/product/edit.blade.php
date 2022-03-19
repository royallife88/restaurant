@extends('layouts.admin')

@section('title', __('lang.edit_product'))

@section('content_header')
    <h1>@lang('lang.edit_product')</h1>
@stop

@section('main_content')
    {!! Form::open(['url' => action('Admin\ProductController@update', $product->id), 'method' => 'put', 'files' => true, 'id' => 'product_form']) !!}
    <x-adminlte-card title="{{ __('lang.edit_product') }}" theme="{{ config('adminlte.right_sidebar_theme') }}"
        theme-mode="outline" icon="fas fa-file">

        <div class="row">
            <div class="col-md-4">
                {!! Form::label('product_class_id', __('lang.category') . ' *', []) !!}

                <div class="input-group my-group">
                    {!! Form::select('product_class_id', $categories, $product->product_class_id, ['class' => 'form-control select2', 'style' => 'width: 80%', 'placeholder' => __('lang.please_select'), 'required']) !!}
                    <span class="input-group-btn">
                        @can('categories.create')
                            <button class="btn-modal btn btn-default bg-white btn-flat"
                                data-href="{{ action('Admin\ProductClassController@create') }}?quick_add=1"
                                data-container=".view_modal"><i class="fa fa-plus-circle text-primary fa-lg"></i></button>
                        @endcan
                    </span>
                </div>
                <div class="error-msg text-red"></div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('name', __('lang.name') . ' *', []) !!}
                    {!! Form::text('name', $product->name, ['class' => 'form-control', 'required', 'placeholder' => __('lang.name')]) !!}
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('image', __('lang.image'), []) !!}
                    <x-adminlte-input-file name="image" multiple placeholder="{{ __('lang.choose_a_file') }}">
                        <x-slot name="prependSlot">
                            <div class="input-group-text bg-lightblue">
                                <i class="fas fa-upload"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input-file>
                </div>
            </div>
            @include('layouts.partials.image_crop')
            <div class="col-md-12 mt-3">
                <div class="row">
                    @if (!empty($product->getMedia('product')))
                        @foreach ($product->getMedia('product') as $image)
                            <div class="images_div">

                                <img src="@if (!empty($image->getUrl())) {{ $image->getUrl() }}@else{{ asset('/uploads/' . session('logo')) }} @endif"
                                    alt="photo" style="width: 250px; height: 200px; padding: 10px;">
                                <button type="button" class="delete-image btn btn-danger btn-xs"
                                    data-href="{{ action('Admin\ProductController@deleteProductImage', $image->id) }}"
                                    style="padding: 0 5px; border-radius: 50%; margin-top: -150px; margin-left: -35px;"><i
                                        class="fa fa-times"></i></button>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>


            <div class="col-md-12">
                <div class="form-group">
                    {!! Form::label('product_details', __('lang.description'), []) !!}
                    @php
                        $config = config('adminlte.editor');
                    @endphp
                    <x-adminlte-text-editor name="product_details" :config="$config">
                        {{ $product->product_details }}
                    </x-adminlte-text-editor>
                </div>
            </div>


            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('purchase_price', __('lang.cost') . ' *', []) !!}
                    {!! Form::text('purchase_price', @num_format($product->purchase_price), ['class' => 'form-control', 'placeholder' => session('system_mode') == 'pos' || session('system_mode') == 'garments' || session('system_mode') == 'supermarket' ? __('lang.purchase_price') : __('lang.cost'), 'required']) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('sell_price', __('lang.sell_price') . ' *', []) !!}
                    {!! Form::text('sell_price', @num_format($product->sell_price), ['class' => 'form-control', 'placeholder' => __('lang.sell_price'), 'required']) !!}
                </div>
            </div>

            <div class="clearfix"></div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('discount_type', __('lang.discount_type'), []) !!}
                    {!! Form::select('discount_type', ['fixed' => __('lang.fixed'), 'percentage' => __('lang.percentage')], $product->discount_type, ['class' => 'selectpicker form-control', 'style' => 'width: 80%', 'placeholder' => __('lang.please_select')]) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('discount', __('lang.discount'), []) !!}
                    {!! Form::text('discount', @num_format($product->discount), ['class' => 'form-control', 'placeholder' => __('lang.discount')]) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('discount_start_date', __('lang.discount_start_date'), []) !!}
                    {!! Form::text('discount_start_date', !empty($product->discount_start_date) ? @format_date($product->discount_start_date) : null, ['class' => 'form-control datepicker', 'placeholder' => __('lang.discount_start_date')]) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('discount_end_date', __('lang.discount_end_date'), []) !!}
                    {!! Form::text('discount_end_date', !empty($product->discount_end_date) ? @format_date($product->discount_end_date) : null, ['class' => 'form-control datepicker', 'placeholder' => __('lang.discount_end_date')]) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('active', __('lang.status'), []) !!} <br>
                    {!! Form::checkbox('active', 1, $product->active ? true : false, ['class']) !!}
                </div>
            </div>

            <div class="col-md-12" style="margin-top: 10px">
                <div class="i-checks">
                    <input id="this_product_have_variant" name="this_product_have_variant" type="checkbox"
                        @if ($product->type == 'variable') checked @endif value="1" class="form-control-custom">
                    <label for="this_product_have_variant"><strong>@lang('lang.this_product_have_variant')</strong></label>
                </div>
            </div>

            <div class="col-md-12 this_product_have_variant_div">
                <table class="table" id="variation_table">
                    <thead>
                        <tr>
                            <th>@lang('lang.name')</th>
                            <th>@lang('lang.size')</th>
                            <th>@lang('lang.cost')</th>
                            <th>@lang('lang.sell_price')</th>
                            <th><button type="button" class="btn btn-success btn-xs add_row mt-2"><i
                                        class="fa fa-plus"></i></button></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($product->variations as $item)
                            @include(
                                'admin.product.partial.edit_variation_row',
                                ['row_id' => $loop->index, 'item' => $item]
                            )
                        @endforeach
                    </tbody>
                </table>
            </div>
            <input type="hidden" name="row_id" id="row_id" value="{{ $product->variations->count() }}">
        </div>



    </x-adminlte-card>

    <div class="col-md-12">
        <button type="button" class="btn btn-primary pull-right" id="submit_btn">@lang('lang.update')</button>
    </div>
    {!! Form::close() !!}
@stop
@section('javascript')
    <script src="{{ asset('admin/js/product.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#this_product_have_variant').change();
        })
    </script>
@endsection
