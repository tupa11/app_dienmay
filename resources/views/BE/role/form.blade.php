<div class="tab-pane active" id="info">
    <div class="row">
        <div class="col-12">
            <div class="form-group required {{ $errors->has('name') ? 'has-error' : '' }}">
                {!! Form::label('name', __($type.'.name'), array('class' => ' required')) !!}
                {!! Form::text('name', null, array('class' => 'form-control', 'required' => true,'placeholder'=>__($type.'.name'))) !!}
                <span class="help-block">{{ $errors->first('name', ':message') }}</span>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group required {{ $errors->has('description') ? 'has-error' : '' }}">
                {!! Form::label('description', __($type.'.description'), array('class' => ' required')) !!}
                {!! Form::text('description', null, array('class' => 'form-control', 'required' => true,'placeholder'=>__($type.'.description'))) !!}
                <span class="help-block">{{ $errors->first('description', ':message') }}</span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label class="control-label">{{ __('role.permission') }}</label>
                <div class="panel-content">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>{{ __('role.module') }}</th>
                            @foreach ($permission as $p)
                                <th style="text-transform: capitalize;">{{ $p }}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($module as $k => $m)
                            @if(is_array($m))
                                <tr>
                                    <td style="font-weight: bold; font-size: 14px">{{ __('menu.'.$k) }}</td>
                                    @foreach ($permission as $p)
                                        <td>
                                            @if ($p == 'list')
                                                <input type="checkbox" class="check group" id="group_{{$k}}"
                                                       name="permissions[]"
                                                       value="{{ $k.'.'.$p }}" {{ (isset($doc) && $doc->hasAccess($k.'.'.$p)) ? 'checked' : ''  }}>
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @endif
                            @if(is_array($m))
                                @foreach($m as $sm)
                                    <tr>
                                        <td>{{ __('menu.'.$sm) }}</td>
                                        @foreach ($permission as $p)
                                            <td><input type="checkbox"
                                                       class="check {{$p == 'list' ? 'item group_'.$k : ''}}"
                                                       {{$p == 'list' ? 'data-group='.$k : ''}} name="permissions[]"
                                                       value="{{ $sm.'.'.$p }}" {{ (isset($doc) && $doc->hasAccess($sm.'.'.$p)) ? 'checked' : ''  }}>
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td style="font-weight: bold; font-size: 14px">{{ __('menu.'.$m) }}</td>
                                    @foreach ($permission as $p)
                                        <td><input type="checkbox"
                                                   class="check {{$p == 'list' ? 'item group_'.$k : ''}}"
                                                   {{$p == 'list' ? 'data-group='.$k : ''}} name="permissions[]"
                                                   value="{{ $m.'.'.$p }}" {{ (isset($doc) && $doc->hasAccess($m.'.'.$p)) ? 'checked' : ''  }}>
                                        </td>
                                    @endforeach
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <div class="panel-content">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th colspan="2">{{ __('role.custom_permission') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($custom as $k => $c)
                            <tr>
                                <td>{{ $c }}</td>
                                <td><input type="checkbox" class="check" name="permissions[]"
                                           value="{{ $k }}" {{ (isset($current) && $current->hasAccess([$k])) ? 'checked' : ''  }}>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label class="control-label">{{ __('common.dashboard') }}</label>
                <select name="permissions[]" class="form-control">
                    @foreach($dashboard as $k => $d)
                        <option
                            value="{{$k}}" {{ (isset($current) && $current->hasAccess([$k])) ? 'selected' : '' }}>{{$d}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>

@include('BE.layouts._buttonsubmit')


<script>
    $('.group').on('ifToggled', function () {
        var group = $(this).attr('id');
        if ($(this).is(':checked')) {
            $('.' + group).iCheck('check');
        }
    });

    $('.item').on('ifToggled', function () {
        var group = $(this).data('group');
        if ($('.group_' + group).filter(':checked').length == $('.group_' + group).length) {
            $('#group_' + group).iCheck('check');
        }
    });

    $(document).ready(function () {
        $('.check').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
        });
    });
</script>

