@extends('BE.layouts.master')
@section('title')
    {{@$title}}
@stop
@section('widget-title')
    {{__($type.'.index')}}
@stop

@section('widget-body')

    <form role="form" id="gridForm" method="post" action="{{$urlcurrent.'/grid'}}">

        <div class="row">
            <div class="col-md-2">
                <input name="name" onchange="$('#gridForm').submit()" type="text" placeholder="{{ __('category.name')}}"
                       class="form-control" value="<?=!empty($grid['name']) ? $grid['name'] : ''?>"/>
            </div>
        </div>

        <div id="gridTable"></div>

        @include('BE.common.gridLimit')

    </form>

@stop
