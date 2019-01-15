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
                <input name="name" type="text" placeholder="{{__('salon.name')}}"
                       class="form-control" value="{{@$grid['name']}}"/>
            </div>
            <div class="col-md-2">
                <input name="phone" type="text" placeholder="{{__('salon.phone')}}"
                       class="form-control" value="{{@$grid['phone']}}"/>
            </div>
            <div class="col-md-2">
                {!! Form::select('admin_id', $admins,@$grid['admin_id'], ['class' => 'select2','style'=>'width:100%','onchange'=>"$('#gridForm').submit()"]) !!}
            </div>
            <div class="col-md-2">
                {!! Form::select('city_id', $citys,@$grid['city_id'], ['class' => 'select2','style'=>'width:100%','onchange'=>"$('#gridForm').submit()"]) !!}
            </div>
        </div>

        <div id="gridTable"></div>

        @include('BE.common.gridLimit')

    </form>
@stop
