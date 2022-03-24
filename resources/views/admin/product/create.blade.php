@extends('layouts.admin')

@section('title', __('lang.add_product'))

@section('content_header')
    <h1>@lang('lang.add_product')</h1>
@stop

@section('main_content')
    {!! Form::open(['url' => action('Admin\ProductController@store'), 'method' => 'post', 'files' => true, 'id' => 'product_form']) !!}
    <x-adminlte-card title="{{ __('lang.add_product') }}" theme="{{ config('adminlte.right_sidebar_theme') }}"
        theme-mode="outline" icon="fas fa-file">

        <div class="row">
            <div class="col-md-4">
                {!! Form::label('product_class_id', __('lang.category') . ' *', []) !!}

                <div class="input-group my-group">
                    {!! Form::select('product_class_id', $categories, false, ['class' => 'select2 form-control', 'style' => 'width: 80%', 'placeholder' => __('lang.please_select'), 'required']) !!}
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
                    <x-adminlte-input name="name" label="{{ __('lang.name') }}" placeholder="{{ __('lang.name') }}"
                        enable-old-support>
                        <x-slot name="appendSlot">
                            <div class="input-group-text text-primary translation_btn">
                                <i class="fas fa-globe"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>
                @include('admin.partial.translation_inputs', [
                    'attribute' => 'name',
                    'translations' => [],
                ])
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('image', __('lang.image'), []) !!}
                    <x-adminlte-input-file name="image" placeholder="{{ __('lang.choose_a_file') }}">
                        <x-slot name="prependSlot">
                            <div class="input-group-text bg-lightblue">
                                <i class="fas fa-upload"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input-file>
                </div>
            </div>
            @include('layouts.partials.image_crop')

            <div class="col-md-12">
                <div class="form-group">
                    {!! Form::label('product_details', __('lang.description'), []) !!} <button type="button" class="translation_textarea_btn btn btn-sm text-primary"> <i class="fas fa-globe"></i></button>
                    @php
                        $config = config('adminlte.editor');
                    @endphp
                    <x-adminlte-text-editor name="product_details" :config="$config" />

                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-4">
                    @include('admin.partial.translation_textarea', [
                        'attribute' => 'product_details',
                        'translations' => [],
                    ])
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('purchase_price', __('lang.cost') . ' *', []) !!}
                    {!! Form::text('purchase_price', null, ['class' => 'form-control', 'placeholder' => session('system_mode') == 'pos' || session('system_mode') == 'garments' || session('system_mode') == 'supermarket' ? __('lang.purchase_price') : __('lang.cost'), 'required']) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('sell_price', __('lang.sell_price') . ' *', []) !!}
                    {!! Form::text('sell_price', null, ['class' => 'form-control', 'placeholder' => __('lang.sell_price'), 'required']) !!}
                </div>
            </div>

            <div class="clearfix"></div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('discount_type', __('lang.discount_type'), []) !!}
                    {!! Form::select('discount_type', ['fixed' => __('lang.fixed'), 'percentage' => __('lang.percentage')], 'fixed', ['class' => 'form-control', 'style' => 'width: 80%', 'placeholder' => __('lang.please_select')]) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('discount', __('lang.discount'), []) !!}
                    {!! Form::text('discount', null, ['class' => 'form-control', 'placeholder' => __('lang.discount')]) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('discount_start_date', __('lang.discount_start_date'), []) !!}
                    {!! Form::text('discount_start_date', null, ['class' => 'form-control datepicker', 'placeholder' => __('lang.discount_start_date')]) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('discount_end_date', __('lang.discount_end_date'), []) !!}
                    {!! Form::text('discount_end_date', null, ['class' => 'form-control datepicker', 'placeholder' => __('lang.discount_end_date')]) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('active', __('lang.status'), []) !!} <br>
                    {!! Form::checkbox('active', 1, true, ['class']) !!}
                </div>
            </div>

            <div class="col-md-12" style="margin-top: 10px">
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="this_product_have_variant">
                    <label for="this_product_have_variant"
                        class="custom-control-label">@lang('lang.this_product_have_variant')</label>
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

                    </tbody>
                </table>
            </div>
            <input type="hidden" name="row_id" id="row_id" value="0">
        </div>

    </x-adminlte-card>

    <div class="col-md-12">
        <button type="button" class="btn btn-primary pull-right" id="submit_btn">@lang('lang.save')</button>
    </div>
    {!! Form::close() !!}
@stop
@section('javascript')
    <script src="{{ asset('admin/js/product.js') }}"></script>

@endsection
