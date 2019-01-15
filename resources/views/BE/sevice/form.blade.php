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
            <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">

                {!! Form::label('price', __($type.'.price'), array('class' => 'control-label')) !!}
                <div class="controls">
                    <input type="text" placeholder="{{__($type.'.price')}}" name="price" class="form-control autonumber"
                           data-a-sign="$ " data-a-sep="." data-a-dec="," required value="{{@$doc->price}}">
                    <span class="help-block">{{ $errors->first('price', ':message') }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-md-6">
            <div class="form-group required {{ $errors->has('title') ? 'has-error' : '' }}">
                {!! Form::label('title', __($type.'.title'), array('class' => ' required')) !!}
                <span class="input-icon icon-right">
                    {!! Form::text('title', null, array('class' => 'form-control', 'required' => true,'placeholder'=>__($type.'.title'))) !!}
                    <span class="help-block">{{ $errors->first('title', ':message') }}</span>
                </span>
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
            <div class="form-group required {{ $errors->has('type') ? 'has-error' : '' }}">
                {!! Form::label('type', __($type.'.type'), array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::select('type', $types, @$doc->type, ['class' => 'select2','style'=>'width:100%']) !!}
                    <span class="help-block">{{ $errors->first('type', ':message') }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="form-group password_field {{ $errors->has('note') ? 'has-error' : '' }}">
                {!! Form::label('note', __($type.'.note'), array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::textArea('note', @$doc->note, array('class' => 'form-control resize_vertical','id' => 'editornote')) !!}
                    <span class="help-block">{{ $errors->first('note', ':message') }}</span>
                </div>

            </div>
        </div>
    </div>

</div>

<div class="tab-pane" id="more">
    <div class="row">
        <div class="col-12">
            <div class="form-group password_field {{ $errors->has('more') ? 'has-error' : '' }}">
                {!! Form::textArea('more', @$doc->more, array('class' => 'form-control resize_vertical','id' => 'editor')) !!}
                <span class="help-block">{{ $errors->first('more', ':message') }}</span>
            </div>
        </div>
    </div>
</div>

<div class="tab-pane" id="images">
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <div class="imgupload">
                <img class="imguploadfile" src="{{asset('uploads/avatar'). '/' . @$doc->user_avatar}}"
                     alt="Your image"/>
                <a href="#" class="btn btn-secondary waves-effect">{{ __('form.select_image') }}
                    <input type='file' onchange="readURL(this);" name="avatar_file" class="input_file_img"/>
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
            <a href="javascript:void(0)" class="btn btn-primary prev_tab">
                <i class="fa fa-chevron-circle-left"></i> {{ __('tab.back') }}</a>
            <button type="submit" class="btn btn-success">
                <i class="fa fa-check-square-o"></i> {{__('table.ok')}}</button>
            <a href="javascript:void(0)" class="btn btn-primary next_tab">{{ __('tab.next') }}
                <i class="fa fa-chevron-circle-right"></i></a>
            @if(isset($doc))
                @include('BE.layouts._history', ['model' => $doc])
            @endif
        </div>
    </div>
</div>

