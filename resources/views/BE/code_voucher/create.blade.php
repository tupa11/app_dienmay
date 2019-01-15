@extends('BE.layouts.tabsform')

@section('title')
    {{$title}}
@stop
@section('form-title')
    {{__($type.'.new')}}
@stop


@section('form-body')

    {!! Form::open(array('url' => $linkadd, 'method' => 'post', 'files'=> true)) !!}

    <div class="tab-content">
        @include('BE/'.$type.'/form')
    </div>

    {!! Form::close() !!}

@stop

