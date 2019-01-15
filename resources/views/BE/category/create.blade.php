@extends('BE.layouts.tabsform')

@section('title')
    {{$title}}
@stop
@section('form-title')
    {{__($type.'.new')}}
@stop

{{--@section('form-nav')--}}

{{--@php--}}
{{--$nav = array(--}}
{{--'info'=>'fa fa-empire'--}}
{{--);--}}
{{--@endphp--}}

{{--@foreach($nav as $k=>$v)--}}
{{--<li class="nav-item">--}}
{{--<a class=" nav-link {{@$loop->first?'active':''}}" href="#{{$k}}" data-toggle="tab"--}}
{{--title="{{ __("tab.$k") }}">--}}
{{--<i class="{{$v}}"> {{ __("tab.$k") }}</i>--}}
{{--</a>--}}
{{--</li>--}}
{{--@endforeach--}}
{{--@stop--}}

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

