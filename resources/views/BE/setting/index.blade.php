@extends('BE.layouts.tabsform')
@section('title')
    {{$title}}
@stop
@section('form-title')
    {{__($type.'.index')}}
@stop

@section('form-nav')

    {{--@php--}}
    {{--$nav = array(--}}
    {{--'settings'=>'fa fa-empire',--}}
    {{--'config'=>'fa fa-wechat',--}}
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
@stop

@section('form-body')

    {!! Form::open(array('url' => $urlcurrent, 'method' => 'post', 'files'=> true)) !!}

    <div class="tab-content">
        @include('BE/'.$type.'/form')
    </div>

    {!! Form::close() !!}
@stop
