@extends('BE.layouts.BE')

@section('styles')
    <link href="{{ asset('BE/plugins/switchery/switchery.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('BE/plugins/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('BE/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet"
          type="text/css"/>
@endsection

@section('scriptstop')
    <script src="{{ asset('BE/plugins/moment/moment.js') }}"></script>
    <script src="{{ asset('BE/plugins/switchery/switchery.min.js') }}"></script>
    <script src="{{ asset('BE/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('BE/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
@endsection

@section('content')
    <div class="portlet" style="border: solid 1px #b37d43">
        <div class="portlet-heading bg-danger">
            <h3 class="portlet-title">
                @yield('form-title')
            </h3>

            <div class="portlet-widgets">
                <buttonnav id="buttonnav"></buttonnav>
                <button class="btn btn-success waves-effect waves-light btn-xs submit">{{ __('table.ok') }}</button>
                <script>
                    $(function () {
                        var numberli = $(".nav-tabs").find("li").length;
                        if (numberli > 1) {
                            $("#buttonnav").append(`
                            <button class="btn btn-xs" onclick='prev_tab()'>{{ __('tab.back') }}</button>
                            <button class="btn btn-xs" onclick='next_tab()'>{{ __('tab.next') }}</button>
                            `)
                        }
                    })
                </script>
                <a href="javascript:" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                <a data-toggle="collapse" href="#bg-danger" class="" aria-expanded="true"><i
                        class="mdi mdi-minus"></i></a>
                <a href="#" data-toggle="remove"><i class="mdi mdi-close"></i></a>
            </div>
            <div class="clearfix"></div>
        </div>
        <div id="bg-danger" class="panel-collapse in collapse show" aria-expanded="true" style="">
            <div class="portlet-body">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        @yield('form-nav')
                    </ul>
                    @yield('form-body')
                </div>
            </div>
        </div>
    </div>
@stop

