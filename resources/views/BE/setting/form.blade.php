<div class="tab-pane active" id="settings">
    <div class="form-group required {{ $errors->has('site_name') ? 'has-error' : '' }}">
        {!! Form::label('site_name', __('setting.site_name'), array('class' => 'control-label')) !!}
        <div class="controls">
            {!! Form::text('site_name', old('site_name', settings('site_name')), array('class' =>
            'form-control')) !!}
            <span class="help-block">{{ $errors->first('site_name', ':message') }}</span>
        </div>
    </div>
    <div class="form-group required {{ $errors->has('site_email') ? 'has-error' : '' }}">
        {!! Form::label('site_email', __('setting.site_email'), array('class' => 'control-label')) !!}
        <div class="controls">
            {!! Form::text('site_email', old('site_email', settings('site_email')), array('class'
            => 'form-control')) !!}
            <span class="help-block">{{ $errors->first('site_email', ':message') }}</span>
        </div>
    </div>
    <div class="form-group required {{ $errors->has('hotline') ? 'has-error' : '' }}">
        {!! Form::label('hotline', __('setting.hotline'), array('class' => 'control-label')) !!}
        <div class="controls">
            {!! Form::text('hotline', old('hotline', settings('hotline')), array('class' =>
            'form-control')) !!}
            <span class="help-block">{{ $errors->first('hotline', ':message') }}</span>
        </div>
    </div>
    <div class="form-group required {{ $errors->has('address') ? 'has-error' : '' }}">
        {!! Form::label('address', __('setting.address'), array('class' => 'control-label')) !!}
        <div class="controls">
            {!! Form::text('address', old('address', settings('address')), array('class' =>
            'form-control')) !!}
            <span class="help-block">{{ $errors->first('address', ':message') }}</span>
        </div>
    </div>
    <div class="form-group required {{ $errors->has('slogan') ? 'has-error' : '' }}">
        {!! Form::label('slogan', __('setting.slogan'), array('class' => 'control-label')) !!}
        <div class="controls">
            {!! Form::text('slogan', old('slogan', settings('slogan')), array('class' =>
            'form-control')) !!}
            <span class="help-block">{{ $errors->first('slogan', ':message') }}</span>
        </div>
    </div>
    <div class="imgupload">
        <img class="imguploadfile" src="{{asset('uploads/site'). '/' . settings('site_logo')}}" alt="Your image"/>
        <a href="#" class="btn btn-secondary waves-effect">{{ __('form.select_image') }}
            <input type='file' onchange="readURL(this);" name="site_logo_file" class="input_file_img"/>
        </a>
    </div>

    <div class="form-group required {{ $errors->has('date_format') ? 'has-error' : '' }}">
        {!! Form::label('date_format', __('setting.date_format'), array('class' => 'control-label')) !!}
        <div class="controls">
            <div class="radio radio-success">
                <input type="radio" name="date_format" id="radio1"
                       value="F j,Y" {{(settings('date_format')=='F j,Y')?'checked':''}}>
                <label for="radio1">
                    {{date('F j,Y')}}
                </label>
            </div>

            <div class="radio radio-success">
                <input type="radio" name="date_format" id="radio2"
                       value="Y-d-m" {{(settings('date_format')=='Y-d-m')?'checked':''}}>
                <label for="radio2">
                    {{date('Y-d-m')}}
                </label>
            </div>
            <div class="radio radio-success">
                <input type="radio" name="date_format" id="radio3"
                       value="d.m.Y" {{(settings('date_format')=='d.m.Y')?'checked':''}}>
                <label for="radio3">
                    {{date('d.m.Y')}}
                </label>
            </div>
            <div class="radio radio-success">
                <input type="radio" name="date_format" id="radio4"
                       value="d/m/Y" {{(settings('date_format')=='d/m/Y')?'checked':''}}>
                <label for="radio4">
                    {{date('d/m/Y')}}
                </label>
            </div>
            <div class="radio radio-success">
                <input type="radio" name="date_format" id="radio5"
                       value="m/d/Y" {{(settings('date_format')=='m/d/Y')?'checked':''}}>
                <label for="radio5">
                    {{date('m/d/Y')}}
                </label>
            </div>
        </div>
        <span class="help-block">{{ $errors->first('date_format', ':message') }}</span>
    </div>
    <div class="form-group required {{ $errors->has('time_format') ? 'has-error' : '' }}">
        {!! Form::label('time_format', __('setting.time_format'), array('class' => 'control-label'))
        !!}
        <div class="controls">
            <div class="radio radio-success">
                <input type="radio" name="time_format" id="radiotime1"
                       value="g:i a" {{(settings('time_format')=='g:i a')?'checked':''}}>
                <label for="radiotime1">
                    {{date('g:i a')}}
                </label>
            </div>
            <div class="radio radio-success">
                <input type="radio" name="time_format" id="radiotime2"
                       value="g:i A" {{(settings('time_format')=='g:i A')?'checked':''}}>
                <label for="radiotime2">
                    {{date('g:i A')}}
                </label>
            </div>
            <div class="radio radio-success">
                <input type="radio" name="time_format" id="radiotime3"
                       value="H:i" {{(settings('time_format')=='H:i')?'checked':''}}>
                <label for="radiotime3">
                    {{date('H:i')}}
                </label>
            </div>
        </div>
        <span class="help-block">{{ $errors->first('date_format', ':message') }}</span>
    </div>
</div>

{{--<div class="tab-pane" id="config">--}}
{{--aaaaaaaa--}}
{{--</div>--}}

<div class="row">
    <div class="form-group col-xs-12">
        <div class="controls">
            <a href="{{ route('admin.setting.update') }}" class="btn btn-danger">
                <i class="fa fa-times"></i> {{__('table.back')}}</a>
            <a href="javascript:void(0)" class="btn btn-primary prev_tab">
                <i class="fa fa-chevron-circle-left"></i> {{ __('tab.back') }}</a>
            <button type="submit" class="btn btn-success">
                <i class="fa fa-check-square-o"></i> {{__('table.ok')}}</button>
            <a href="javascript:void(0)" class="btn btn-primary next_tab">{{ __('tab.next') }}
                <i class="fa fa-chevron-circle-right"></i></a>
        </div>
    </div>
</div>
