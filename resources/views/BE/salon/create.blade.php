@extends('BE.layouts.tabsform')

@section('title')
    {{$title}}
@stop
@section('form-title')
    {{__($type.'.new')}} {{@$doc->full_name}}
@stop

@section('form-nav')

    @php
        $nav = array(
        'info'=>'fa fa-empire',
        );
    @endphp

    @foreach($nav as $k=>$v)
        <li class="nav-item">
            <a class=" nav-link {{@$loop->first?'active':''}}" href="#{{$k}}" data-toggle="tab"
               title="{{ __("tab.$k") }}">
                <i class="{{$v}}"> {{ __("tab.$k") }}</i>
            </a>
        </li>
    @endforeach
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


        $('#city').change(function () {
            $('#district').select2(ajaxData('{{ url('ajax/district') }}/' + $(this).val(), 'Select district')).val('').trigger('change');
        });

        $(document).ready(function () {
            $('#city').select2(ajaxData('{{ url('ajax/city') }}', 'Select city'));
            $('#request_product').select2(ajaxData('{{ url('ajax/product') }}'));
            @if(isset($doc) && $doc->city)
            $('#district').select2(ajaxData('{{ url('ajax/district') . '/' . $doc->city_id }}', 'Select district'));
            @else
            $('#district').select2(ajaxData('{{ url('ajax/district') . '/0' }}', 'Select district'));
            @endif
        })

    </script>

@endsection
