<div class="tab-pane active" id="info">
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="form-group required {{ $errors->has('number_code') ? 'has-error' : '' }}">
                {!! Form::label('number_code', __($type.'.number_code'), array('class' => ' required')) !!}
                {!! Form::text('number_code', null, array('class' => 'form-control', 'required' => true,'placeholder'=>__($type.'.number_code'))) !!}
                <span class="help-block">{{ $errors->first('number_code', ':message') }}</span>
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
            <div class="form-group required {{ $errors->has('voucher_id') ? 'has-error' : '' }}">
                {!! Form::label('voucher_id', __($type.'.voucher'), array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::select('voucher_id', $vouchers_pluck, @$doc->voucher_id, ['class' => 'select2','style'=>'width:100%']) !!}
                    <span class="help-block">{{ $errors->first('voucher_id', ':message') }}</span>
                </div>
            </div>
        </div>
    </div>

</div>

@include('BE.layouts._buttonsubmit')

