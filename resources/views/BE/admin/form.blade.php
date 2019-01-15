<div class="tab-pane active" id="info">
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <div class="form-group required {{ $errors->has('name') ? 'has-error' : '' }}">
                {!! Form::label('name', __($type.'.name'), array('class' => ' required')) !!}
                <span class="input-icon icon-right">
                    {!! Form::text('name', null, array('class' => 'form-control', 'required' => true,'placeholder'=>__($type.'.name'))) !!}
                    <span class="help-block">{{ $errors->first('name', ':message') }}</span>
                </span>
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
            <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
                {!! Form::label('username', __($type.'.username'), array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::text('username', null, array('class' => 'form-control','required' => true,'placeholder'=>__($type.'.username'))) !!}
                    <span class="help-block">{{ $errors->first('username', ':message') }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-md-6">
            <div class="form-group required {{ $errors->has('phone') ? 'has-error' : '' }}">
                {!! Form::label('phone', __($type.'.phone'), array('class' => ' required')) !!}
                <span class="input-icon icon-right">
                    {!! Form::text('phone', null, array('class' => 'form-control', 'required' => true,'placeholder'=>__($type.'.phone'))) !!}
                    <span class="help-block">{{ $errors->first('phone', ':message') }}</span>
                </span>
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
            <div class="form-group required {{ $errors->has('role_id') ? 'has-error' : '' }}">
                {!! Form::label('role_id', __($type.'.role'), array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::select('role_id', $roles_pluck, @$doc->role_id, ['class' => 'select2','style'=>'width:100%']) !!}
                    <span class="help-block">{{ $errors->first('role_id', ':message') }}</span>
                </div>
            </div>
        </div>
    </div>

    @if (isset($doc))
        <div class="row">
            <div class="form-group col-md-3">
                <div class="checkbox checkbox-custom">
                    <input type="checkbox" id="show_pass">
                    <label for="show_pass"> {{ __('admin.change_password') }} </label>
                </div>
            </div>
            <div class="form-group col-md-3 {{ $errors->has('active') ? 'has-error' : '' }}">
                <div class="checkbox checkbox-custom">
                    <input type="checkbox" id="active" name="active" {{@$doc->active?'checked' : ''}}>
                    <label for="active"> {{__($type.'.active')}} </label>
                    <span class="help-block">{{ $errors->first('active', ':message') }}</span>
                </div>
            </div>
            <div class="col-xs-12 col-md-6">
                <div class="form-group required {{ $errors->has('area_id') ? 'has-error' : '' }}">
                    {!! Form::label('area_id', __($type.'.area'), array('class' => 'control-label')) !!}
                    <div class="controls">
                        {!! Form::select('area_id', $areas_pluck, @$doc->area_id, ['class' => 'select2','style'=>'width:100%']) !!}
                        <span class="help-block">{{ $errors->first('area_id', ':message') }}</span>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <div class="form-group password_field {{ $errors->has('password') ? 'has-error' : '' }}">
                {!! Form::label('password', __($type.'.password')) !!}
                <span class="input-icon icon-right">
                    {!! Form::password('password', array('class' => 'form-control','placeholder'=>__($type.'.password'))) !!}
                    <span class="help-block">{{ $errors->first('password', ':message') }}</span>
                </span>
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
            <div
                class="form-group password_field {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                {!! Form::label('password_confirmation', __($type.'.password_confirmation')) !!}
                <span class="input-icon icon-right">
                    {!! Form::password('password_confirmation', array('class' => 'form-control','placeholder'=>__($type.'.password_confirmation'))) !!}
                    <span
                        class="help-block">{{ $errors->first('password_confirmation', ':message') }}</span>
                </span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-md-6">
            <div class="imgupload">
                <img class="imguploadfile" src="{{@$doc->avatar}}"
                     alt="Your image"/>
                <a href="#" class="btn btn-secondary waves-effect">{{ __('form.select_image') }}
                    <input type='file' onchange="readURL(this);" name="avatar_file" class="input_file_img"/>
                </a>
            </div>
        </div>
    </div>
</div>


@include('BE.layouts._buttonsubmit')
