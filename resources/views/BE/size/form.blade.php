<div class="tab-pane active" id="info">
    <div class="row">
        <div class="col-12 col-md-4">
            <div class="form-group required {{ $errors->has('code') ? 'has-error' : '' }}">
                {!! Form::label('code', __($type.'.code'), array('class' => ' required')) !!}
                {!! Form::text('code', null, array('class' => 'form-control', 'required' => true,'placeholder'=>__($type.'.code'))) !!}
                <span class="help-block">{{ $errors->first('code', ':message') }}</span>
            </div>
        </div>
        <div class="col-12 col-md-8">
            <div class="form-group required {{ $errors->has('value') ? 'has-error' : '' }}">
                {!! Form::label('value', __($type.'.value'), array('class' => ' required')) !!}
                {!! Form::text('value', null, array('class' => 'form-control', 'required' => true,'placeholder'=>__($type.'.value'))) !!}
                <span class="help-block">{{ $errors->first('value', ':message') }}</span>
            </div>
        </div>

    </div>
</div>

@include('BE.layouts._buttonsubmit')

