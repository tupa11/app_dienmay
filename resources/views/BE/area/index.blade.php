@extends('BE.layouts.master')
@section('title')
    {{$title}}
@stop
@section('widget-title')
    {{__("$type.index")}}
@stop

@section('widget-body')

    <form role="form" id="gridForm" method="post" action="{{$urlcurrent.'/grid'}}">
        <div class="row">
            <div class="col-md-2">
                <input name="name" onchange="$('#gridForm').submit()"
                       type="text" placeholder="{{ __("$type.name")}}"
                       class="form-control" value="{{@$grid['name']}}"/>
            </div>
            <div class="col-md-2">
                <input name="address" onchange="$('#gridForm').submit()"
                       type="text" placeholder="{{ __("$type.address")}}"
                       class="form-control" value="{{@$grid['address']}}"/>
            </div>
        </div>

        <div id="gridTable"></div>

        @include('BE.common.gridLimit')

    </form>

    <div class="modal fade form_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <form id="registrationForm" method="post" action="{{route('admin.'.$type.'.store')}}"
                  data-bv-message="This value is not valid"
                  data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
                  data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
                  data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">
                <div class="modal-content">
                    <div class="modal-header">
                        @csrf
                        <input type="hidden" name="area_id" id="area_id" value="">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="mySmallModalLabel"></h4>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group required {{ $errors->has('name') ? 'has-error' : '' }}">
                                    {!! Form::label('{{$type}}_name', __("$type.name"), array('class' => 'control-label required')) !!}
                                    <div class="controls">
                                        <input type="text" name="name" id="area_name" class="form-control"
                                               placeholder="{{__("$type.name")}}"
                                               required data-bv-notempty="true"
                                               data-bv-notempty-message="The name is required and cannot be empty">
                                        <span class="help-block">{{ $errors->first('name', ':message') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group required {{ $errors->has('address') ? 'has-error' : '' }}">
                                    {!! Form::label('{{$type}}_address', __("$type.address"), array('class' => 'control-label required')) !!}
                                    <div class="controls">
                                        <input type="text" name="address" id="area_address" class="form-control"
                                               placeholder="{{__("$type.address")}}"
                                               required data-bv-notempty="true"
                                               data-bv-notempty-message="The address is required and cannot be empty">
                                        <span class="help-block">{{ $errors->first('address', ':message') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        @includeIf('BE.layouts._buttonsubmit',['modal'=>1,'button'=>1])
                    </div>
                </div>

            </form>
        </div>
    </div>


@stop

@section('scripts')

    <script>
        $(document).ready(function () {
            $("#registrationForm").bootstrapValidator();
        });

        $("#button_submit").click(function (e) {
            $('#registrationForm').bootstrapValidator('validate');
            var id = $("#area_id").val();
            if (id) {
                var urledit = 'area/' + id;
                $.ajax({
                    headers: {
                        'store': 'store'
                    },
                    url: urledit,
                    type: 'PUT',
                    data: {'name': $("#area_name").val(), 'address': $("#area_address").val()},
                    success: function (data) {
                        if (data == 1) {
                            $(".form_modal").modal('hide');
                            $("#gridForm").trigger('submit');
                        }
                    }
                });
            } else {
                $.ajax({
                    headers: {
                        'store': 'store'
                    },
                    url: '{{route('admin.'.$type.'.store')}}',
                    type: 'POST',
                    data: {'name': $("#area_name").val(), 'address': $("#area_address").val()},
                    success: function (data) {
                        if (data == 1) {
                            $(".form_modal").modal('hide');
                            swal(
                                {
                                    title: "{{__('swal.success')}}",
                                    text: "{{__('flash.create_success')}}",
                                    type: 'success',
                                    confirmButtonColor: '#4fa7f3'
                                }
                            );
                            $("#gridForm").trigger('submit');
                        }
                    }
                });
            }
        })
    </script>
@endsection
