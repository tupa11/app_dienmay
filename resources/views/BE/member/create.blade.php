@extends('BE.layouts.tabsform')

@section('title')
    {{$title}}
@stop
@section('form-title')
    {{__($type.'.new')}} {{@$doc->full_name}}
@stop

@section('form-body')

    @if (isset($doc))
        {!! Form::model($doc, array('url' => $linkedit, 'method' => 'put', 'files'=> true)) !!}
        <input type="hidden" value="{{ $doc->id }}" name="id">
    @else
        {!! Form::open(array('url' => $linkadd, 'method' => 'post', 'files'=> true)) !!}
    @endif


    <div class="tab-content">
        @include('BE/'.$type.'/form')
    </div>

    {!! Form::close() !!}

@stop

@section('scripts')
    <script>
        @if (isset($doc))
        if ($(".password_field").hasClass('has-error')) {
            $(".password_field").show();
        } else {
            $(".password_field").hide();
        }
        $("#show_pass").on('change', function () {
            if ($("#show_pass").is(':checked')) {
                $(".password_field").show();
            } else {
                $(".password_field").hide();
            }
        });
        @endif

        $('#dateofbirth').datepicker({
            locale: {
                format: '{{settings('jquery_date')}}'
            },
            format: "{{strtolower(settings('jquery_date'))}}",
            autoclose: true,
            todayHighlight: true
        });


    </script>
@endsection
