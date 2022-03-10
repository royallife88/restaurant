@extends('layouts.admin')

@section('title', __('lang.message_settings'))

@section('content_header')
    <h1>@lang('lang.message_settings')</h1>
@stop

@section('main_content')
    {!! Form::open(['url' => action('Admin\MessageController@saveSetting'), 'method' => 'post', 'files' => true, 'id' => 'sms_form']) !!}

    <x-adminlte-card title="{{ __('lang.message_settings') }}" theme="{{ config('adminlte.right_sidebar_theme') }}"
        theme-mode="outline" icon="fas fa-file">

        <div class="row">
            <div class="col-md-12">
                <div class=" row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="sender_email">{{ __('lang.sender_email') }}:</label>
                            <input type="text" class="form-control" id="sender_email" name="sender_email" required
                                value="@if (!empty($settings['sender_email'])) {{ $settings['sender_email'] }} @endif">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </x-adminlte-card>

    <div class="col-md-12">
        <button type="submit" class="btn btn-primary pull-right" id="submit_btn">@lang('lang.save')</button>
    </div>
    {!! Form::close() !!}
@stop
@section('javascript')

@endsection
