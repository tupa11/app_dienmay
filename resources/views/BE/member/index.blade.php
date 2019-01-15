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
                <input name="username" type="text" placeholder="{{__("$type.username")}}"
                       class="form-control" value="{{@$grid['username']}}"/>
            </div>
            <div class="col-md-2">
                <select class="form-control" name="group" onchange="$('#gridForm').submit()">
                    <option value="">-- {{__("$type.group")}} --</option>
                    <option
                        <?= isset($grid['group']) ? ($grid['group'] == 'manager' ? 'selected' : '') : '' ?> value="manager">
                        Mamnager
                    </option>
                    <option
                        <?= isset($grid['group']) ? ($grid['group'] == 'admin' ? 'selected' : '') : '' ?> value="admin">
                        ADMIN
                    </option>
                </select>
            </div>
            <div class="col-md-4">
                {!! Form::select('area_id', $areas_pluck, @$grid['area_id'], ['class' => 'select2','style'=>'width:100%','onchange'=>"$('#gridForm').submit()"]) !!}
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
