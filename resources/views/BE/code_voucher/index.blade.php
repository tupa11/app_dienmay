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
                {!! Form::select('voucher_id', $vouchers_pluck, @$grid['voucher_id'], ['class' => 'select2','style'=>'width:100%','onchange'=>"$('#gridForm').submit()"]) !!}
            </div>
            <div class="col-md-2">
                {!! Form::select('manufacturer_id', $manufacturers_pluck, @$grid['manufacturer_id'], ['class' => 'select2','style'=>'width:100%','onchange'=>"$('#gridForm').submit()"]) !!}
            </div>
            <div class="col-md-2" style="display: flex;align-items: flex-end;">
                <div class="checkbox checkbox-custom">
                    <input type="checkbox" id="status" name="status" value="1" {{@$grid['status']?'checked' : ''}}>
                    <label for="status"> {{__("$type.member")}} null </label>
                </div>
            </div>
        </div>

        <div id="gridTable"></div>

        @include('BE.common.gridLimit')

    </form>

@stop
