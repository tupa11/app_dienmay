@extends('BE.layouts.master')
@section('title')
    {{$title}}
@stop
@section('widget-title')
    {{__($type.'.index')}}
@stop

@section('widget-body')

    <link href="{{ asset('BE/plugins/lightbox/css/lightbox.min.css') }}" rel="stylesheet" type="text/css"/>
    <script src="{{ asset('BE/plugins/lightbox/js/lightbox.min.js') }}"></script>

    <style>
        .img-box {
            position: relative;
            margin-top: 10px
        }

        .img-toolbox {
            position: absolute;
            bottom: 0;
            display: block;
            background-color: #25211d8c;
        }

        .img-box img {
            width: 100%;
            height: 270px;
            object-fit: cover;
        }
    </style>

    <form role="form" id="gridForm" method="post" action="{{$urlcurrent.'/grid'}}">

        <div class="row">
            <div class="col-md-2">
                <input name="name" type="text" placeholder="{{__("$type.name")}}"
                       class="form-control" value="{{@$grid['name']}}"/>
            </div>
            {{--<div class="col-md-2">--}}
            {{--<input name="path" type="text" placeholder="{{__("$type.path")}}"--}}
            {{--class="form-control" value="{{@$grid['path']}}"/>--}}
            {{--</div>--}}

            <div class="col-md-2">
                <button type="button" data-toggle="modal" data-target="#newModal" class="btn btn-primary"><i
                        class="fa fa-plus-circle"></i> New
                </button>
            </div>
        </div>


        <div id="gridTable"></div>

        @include('BE.common.gridLimit')

    </form>


    <div id="newModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{ __('image.title') }}</h4>
                </div>
                <div class="modal-body">
                    <div id="fileuploader"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"
                            id="gallery_close">{{ __('form.start_upload') }}</button>
                </div>
            </div>
        </div>
    </div>

    <div id="editModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editForm" method="POST">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">{{ __('image.title') }}</h4>
                    </div>
                    <div class="modal-body">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group required">
                            {!! Form::label('name', __('image.name'), array('class' => 'control-label required')) !!}
                            <div class="controls">
                                {!! Form::text('name', null, array('class' => 'form-control', 'id' => 'name', 'required' => true)) !!}
                                <span class="help-block">{{ $errors->first('name', ':message') }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('title', __('image.img_title'), array('class' => 'control-label')) !!}
                            <div class="controls">
                                {!! Form::text('title', null, array('class' => 'form-control', 'id' => 'title')) !!}
                                <span class="help-block">{{ $errors->first('title', ':message') }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('alt', __('image.img_alt'), array('class' => 'control-label')) !!}
                            <div class="controls">
                                {!! Form::text('alt', null, array('class' => 'form-control', 'id' => 'alt')) !!}
                                <span class="help-block">{{ $errors->first('alt', ':message') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">{{__('table.ok')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@stop

@section('scripts')
    <script src="{{ asset('BE/plugins/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('BE/js/BE/jquery.uploadfile.min.js') }}"></script>

    <link href="{{ asset('BE/css/uploadfile.css') }}" rel="stylesheet"
          type="text/css"/>

@endsection
