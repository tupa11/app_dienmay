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
            <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                {!! Form::label('phone', __($type.'.phone'), array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::text('phone', null, array('class' => 'form-control','required' => true,'placeholder'=>__($type.'.phone'))) !!}
                    <span class="help-block">{{ $errors->first('phone', ':message') }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-md-6">
            <div class="form-group required {{ $errors->has('city_id') ? 'has-error' : '' }}">
                {!! Form::label('city', __($type.'.city'), array('class' => 'control-label')) !!}
                <div class="controls">
                    <select name="city_id" class="form-control" id="city">
                        @if(isset($doc) && $doc->city)
                            <option value="{{ $doc->city_id }}" selected="selected">{{ @$doc->city->name }}</option>
                        @endif
                    </select>
                    <span class="help-block">{{ $errors->first('city_id', ':message') }}</span>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
            <div class="form-group required {{ $errors->has('district_id') ? 'has-error' : '' }}">
                {!! Form::label('district', __($type.'.district'), array('class' => 'control-label')) !!}
                <div class="controls">
                    <select name="district_id" class="form-control" id="district">
                        @if(isset($doc) && $doc->district)
                            <option value="{{ $doc->district_id }}"
                                    selected="selected">{{ @$doc->district->name }}</option>
                        @endif
                    </select>
                    <span class="help-block">{{ $errors->first('district_id', ':message') }}</span>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12 col-md-6">
            <div class="form-group required {{ $errors->has('admin_id') ? 'has-error' : '' }}">
                {!! Form::label('admin', __($type.'.admin'), array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::select('admin_id', $admins, @$doc->admin_id, ['class' => 'select2','style'=>'width:100%']) !!}
                    <span class="help-block">{{ $errors->first('admin_id', ':message') }}</span>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
            <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                {!! Form::label('address', __($type.'.address')) !!}
                <span class="input-icon icon-right">
                    {!! Form::textarea('address',null, array('class' => 'form-control','placeholder'=>__($type.'.address'))) !!}
                    <span class="help-block">{{ $errors->first('address', ':message') }}</span>
                </span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <div class="imgupload">
                <img class="imguploadfile" src="{{asset('uploads/salon'). '/' . @$doc->img}}"
                     alt="Your image"/>
                <a href="#" class="btn btn-secondary waves-effect">{{ __('form.select_image') }}
                    <input type='file' onchange="readURL(this);" name="img" class="input_file_img"/>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="controls">
            <a href="{{ route('admin.'.$type.'.index') }}" class="btn btn-danger">
                <i class="fa fa-times"></i> {{__('table.back')}}</a>
            <button type="submit" class="btn btn-success">
                <i class="fa fa-check-square-o"></i> {{__('table.ok')}}</button>
            @if(isset($doc))
                @include('BE.layouts._history', ['model' => $doc])
            @endif
        </div>
    </div>
</div>

