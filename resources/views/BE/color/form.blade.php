<div class="tab-pane active" id="info">
    <div class="row">
        <div class="col-12 col-md-4">
            <div class="form-group required {{ $errors->has('color') ? 'has-error' : '' }}">
                {!! Form::label('color', __($type.'.color'), array('class' => ' required')) !!}
                {!! Form::text('color', null, array('class' => 'form-control', 'required' => true,'placeholder'=>__($type.'.color'))) !!}
                <span class="help-block">{{ $errors->first('color', ':message') }}</span>
            </div>
        </div>
        <div class="col-12 col-md-8">
            <div class="form-group required {{ $errors->has('value') ? 'has-error' : '' }}">
                {!! Form::label('value', __($type.'.value'), array('class' => ' required')) !!}
                <input type="text" class="jscolor form-control" value="{{@$doc->value}}" name="value">
                <span class="help-block">{{ $errors->first('value', ':message') }}</span>
            </div>
        </div>

    </div>
</div>

@include('BE.layouts._buttonsubmit')

