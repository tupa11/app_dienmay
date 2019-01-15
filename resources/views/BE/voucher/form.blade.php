<div class="tab-pane active" id="info">
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="form-group required {{ $errors->has('name') ? 'has-error' : '' }}">
                {!! Form::label('name', __($type.'.name'), array('class' => ' required')) !!}
                {!! Form::text('name', null, array('class' => 'form-control', 'required' => true,'placeholder'=>__($type.'.name'))) !!}
                <span class="help-block">{{ $errors->first('name', ':message') }}</span>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group required {{ $errors->has('title') ? 'has-error' : '' }}">
                {!! Form::label('title', __($type.'.title'), array('class' => ' required')) !!}
                {!! Form::text('title', null, array('class' => 'form-control', 'required' => true,'placeholder'=>__($type.'.title'))) !!}
                <span class="help-block">{{ $errors->first('title', ':message') }}</span>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="form-group required {{ $errors->has('manufacturer_id') ? 'has-error' : '' }}">
                {!! Form::label('manufacturer_id', __($type.'.manufacturer'), array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::select('manufacturer_id', $manufacturers_pluck, @$doc->manufacturer_id, ['class' => 'select2','style'=>'width:100%']) !!}
                    <span class="help-block">{{ $errors->first('manufacturer_id', ':message') }}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group required {{ $errors->has('time') ? 'has-error' : '' }}">
                {!! Form::label('time', __($type.'.title'), array('class' => ' required')) !!}
                {!! Form::text('timerange', null, array('class' => 'form-control input-daterange-datepicker', 'required' => true,'placeholder'=>__($type.'.timerange'))) !!}
                <span class="help-block">{{ $errors->first('time', ':message') }}</span>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group required {{ $errors->has('time_use') ? 'has-error' : '' }}">
                {!! Form::label('time_use', __($type.'.time_use')." (h)", array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::selectRange('time_use', 1,999, @$doc->time_use, ['class' => 'select2','style'=>'width:100%']) !!}
                    <span class="help-block">{{ $errors->first('time_use', ':message') }}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group required">
                {!! Form::label('number_code', __($type.'.number_code'), array('class' => ' required')) !!}
                {!! Form::number('number_code', null, array('class' => 'form-control', 'required' => true,'max'=>300,'min'=>1,'placeholder'=>__($type.'.number_code'))) !!}
            </div>
        </div>
        <div class="col-12">
            {!! Form::label('detail', __($type.'.detail'), array('class' => ' required')) !!}
            <div class="form-group {{ $errors->has('detail') ? 'has-error' : '' }}">
                {!! Form::textArea('detail', @$doc->detail, array('class' => 'form-control resize_vertical','id' => 'editor')) !!}
                <span class="help-block">{{ $errors->first('detail', ':message') }}</span>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="imgupload">
                <img class="imguploadfile" src="{{asset('uploads/voucher'). '/' . @$doc->img}}"
                     alt="Your image"/>
                <a href="#" class="btn btn-secondary waves-effect">{{ __('form.select_image') }}
                    <input type='file' onchange="readURL(this);" name="img" class="input_file_img"/>
                </a>
                <span class="help-block"
                      style="display: block;color: red">{{ $errors->first('img', ':message') }}</span>
            </div>
        </div>
    </div>
</div>

@include('BE.layouts._buttonsubmit')
