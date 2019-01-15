@extends('BE.layouts.tabsform')

@section('title')
    {{$title}}
@stop
@section('form-title')
    {{__($type.'.new')}}
@stop

@section('form-body')

    @if (isset($doc))
        {!! Form::model($doc, array('url' => $linkedit, 'method' => 'put', 'files'=> true)) !!}
    @else
        {!! Form::open(array('url' => $linkadd, 'method' => 'post', 'files'=> true)) !!}
    @endif


    <div class="tab-content">
        @include('BE/'.$type.'/form')
    </div>

    {!! Form::close() !!}


    <script src="{{ asset('BE/plugins/ckeditor/ckeditor.js') }}"></script>

    <script>
        $(function () {
            CKEDITOR.replace('editor');

            $('.datepicker-autoclose1').datepicker({
                locale: {
                    format: '{{settings('jquery_date')}}'
                },
                format: "{{strtolower(settings('jquery_date'))}}",
                autoclose: true,
                todayHighlight: true
            });

            $('.datepicker-autoclose2').datepicker({
                locale: {
                    format: '{{settings('jquery_date')}}'
                },
                format: "{{strtolower(settings('jquery_date'))}}",
                autoclose: true,
                todayHighlight: true
            });
        });
    </script>
@stop

