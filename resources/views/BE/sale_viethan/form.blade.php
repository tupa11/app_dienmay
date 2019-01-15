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
    </div>

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="form-group required {{ $errors->has('time_start') ? 'has-error' : '' }}">
                {!! Form::label('time_start', __($type.'.time_start'),array('class' => ' required')) !!}
                <div class="input-group">
                    {!! Form::text('time_start', null, array('class' => 'form-control datepicker-autoclose1','placeholder'=> settings('jquery_date'))) !!}
                    <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar text-white"></i></span>
                    <span class="help-block">{{ $errors->first('time_start', ':message') }}</span>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="form-group required {{ $errors->has('time_end') ? 'has-error' : '' }}">
                {!! Form::label('time_end', __($type.'.time_end'),array('class' => ' required')) !!}
                <div class="input-group">
                    {!! Form::text('time_end', null, array('class' => 'form-control datepicker-autoclose2','placeholder'=> settings('jquery_date'))) !!}
                    <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar text-white"></i></span>
                    <span class="help-block">{{ $errors->first('time_end', ':message') }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
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
                {!! Form::label('img', __($type.'.img'),array('class' => ' required')) !!}
                <img class="imguploadfile" src="{{asset('uploads/sale_viethan'). '/' . @$doc->img}}"
                     alt="Your image"/>
                <a href="#" class="btn btn-secondary waves-effect">{{ __('form.select_image') }}
                    <input type='file' onchange="readURL(this);" name="img_file" class="input_file_img"/>
                </a>
                <span class="help-block"
                      style="display: block;color: red">{{ $errors->first('img_file', ':message') }}</span>
            </div>
        </div>
    </div>
</div>

@include('BE.layouts._buttonsubmit')
