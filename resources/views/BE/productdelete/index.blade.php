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
                <input name="name" type="text" placeholder="{{__("$type.name")}}"
                       class="form-control" value="{{@$grid['name']}}"/>
            </div>

            <div class="col-md-2">
                {!! Form::select('category_id', $categorys_pluck, @$grid['category_id'], ['class' => 'select2','style'=>'width:100%','onchange'=>"$('#gridForm').submit()"]) !!}
            </div>
            <div class="col-md-2" style="display: flex;align-items: flex-end;">
                <div class="checkbox checkbox-custom">
                    <input type="checkbox" id="active" name="active" value="1" {{@$grid['active']?'checked' : ''}}>
                    <label for="active"> {{__("$type.active")}} </label>
                </div>
            </div>
        </div>

        <div id="gridTable"></div>

        @include('BE.common.gridLimit')

    </form>

@stop
