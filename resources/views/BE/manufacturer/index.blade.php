@extends('BE.layouts.master')
@section('title')
    {{$title}}
@stop
@section('widget-title')
    {{__($type.'.index')}}
@stop

@section('widget-body')

    <form role="form" id="gridForm" method="post" action="{{$urlcurrent.'/grid'}}">
        <div class="row">
            <div class="col-md-2">
                <input name="name" onchange="$('#gridForm').submit()"
                       type="text" placeholder="{{ __($type.'.name')}}"
                       class="form-control" value="{{@$grid['name']}}"/>
            </div>
        </div>

        <div id="gridTable"></div>

        @include('BE.common.gridLimit')

    </form>

    <div class="modal fade form_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <form id="registrationForm" method="post" action="{{route('admin.'.$type.'.store')}}"
                  enctype="multipart/form-data"
                  data-bv-message="This value is not valid"
                  data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
                  data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
                  data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">
                <div class="modal-content">
                    <div class="modal-header">
                        @csrf
                        <input type="hidden" name="{{$type}}_id" id="{{$type}}_id" value="">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="mySmallModalLabel"></h4>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group required {{ $errors->has('name') ? 'has-error' : '' }}">
                                    {!! Form::label($type.'_name', __($type.'.name'), array('class' => 'control-label required')) !!}
                                    <div class="controls">
                                        <input type="text" name="name" id="{{$type}}_name" class="form-control"
                                               placeholder="{{__($type.'.name')}}"
                                               required data-bv-notempty="true"
                                               data-bv-notempty-message="The first name is required and cannot be empty">
                                        <span class="help-block">{{ $errors->first('name', ':message') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">

                                <div class="form-group required {{ $errors->has('logo') ? 'has-error' : '' }}">
                                    {!! Form::label($type.'_logo', __($type.'.logo'), array('class' => 'control-label required')) !!}
                                    <div class="imgupload">
                                        <img class="imguploadfile" src="" alt="Your image"/>
                                        <a href="#" class="btn btn-secondary waves-effect">{{ __('form.select_image') }}
                                            <input type='file' onchange="readURL(this);" name="logo_file"
                                                   class="input_file_img"/>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        @includeIf('BE.layouts._buttonsubmit',['modal'=>1,'button'=>0])
                    </div>
                </div>

            </form>
        </div>
    </div>

@stop

@section('scripts')
    <script src="{{asset('BE/plugins/validation/bootstrapValidator.js')}}"></script>
    <script>
        $(document).ready(function () {
            $("#registrationForm").bootstrapValidator();
        });

    </script>
@endsection
