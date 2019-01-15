@extends('BE.layouts.BE')

@section('content')
    <div class="portlet" style="border: solid 1px #71d1d2">
        <div class="portlet-heading bg-danger">
            <h3 class="portlet-title">
                @yield('widget-title')
            </h3>

            <div class="portlet-widgets">
                <a href="javascript:;" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                <a data-toggle="collapse" data-parent="#accordion1" href="#bg-danger" class="" aria-expanded="true"><i
                        class="mdi mdi-minus"></i></a>
                <a href="#" data-toggle="remove"><i class="mdi mdi-close"></i></a>
            </div>
            <div class="clearfix"></div>
        </div>
        <div id="bg-danger" class="panel-collapse in collapse show" aria-expanded="true" style="">
            <div class="portlet-body">
                @yield('widget-body')
            </div>
        </div>
    </div>
@stop

