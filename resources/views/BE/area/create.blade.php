@extends('BE.layouts.master')

@section('title')
    {{$title}}
@stop


@section('widget-body')
    @include('BE/'.$type.'/form')
@stop
