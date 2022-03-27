<div class="modal-dialog" role="document">
    <div class="modal-content">

        {!! Form::open(['url' => action('Admin\ProductClassController@update', $product_class->id), 'method' => 'put', 'id' => 'product_class_add_form', 'files' => true]) !!}

        <div class="modal-header">

            <h4 class="modal-title">@lang( 'lang.edit_category' )</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
        </div>

        <div class="modal-body">
            <div class="form-group">
                <x-adminlte-input name="name" label="{{ __('lang.name') }}" placeholder="{{ __('lang.name') }}"
                    value="{{ $product_class->name }}" enable-old-support>
                    <x-slot name="appendSlot">
                        <div class="input-group-text text-primary translation_btn" data-type="product_class">
                            <i class="fas fa-globe"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
            </div>
            @include('admin.partial.translation_inputs', [
                'attribute' => 'name',
                'translations' => $product_class->translations,
                'type' => 'product_class',
            ])
            <div class="form-group">
                {!! Form::label('description', __('lang.description') . ':') !!}
                {!! Form::text('description', $product_class->description, ['class' => 'form-control', 'placeholder' => __('lang.description')]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('sort', __('lang.sort') . ':*') !!}
                {!! Form::number('sort', $product_class->sort, ['class' => 'form-control', 'placeholder' => __('lang.sort'), 'required']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('image', __('lang.image'), []) !!}
                <x-adminlte-input-file name="image" placeholder="Choose a file...">
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-lightblue">
                            <i class="fas fa-upload"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input-file>
            </div>
            @include('layouts.partials.image_crop')
            <div class="form-group">
                {!! Form::label('status', __('lang.status'), []) !!}
                {!! Form::checkbox('status', 1, $product_class->status ? true : false, ['class']) !!}
            </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">@lang( 'lang.update' )</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'lang.close' )</button>
        </div>

        {!! Form::close() !!}

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
<script>
    $("[name='status']").bootstrapSwitch();
</script>
