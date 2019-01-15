<div class="tab-pane active" id="info">
    <div class="row">
        <div class="col-12 col-md-5">
            <div class="row">
                {{--<div class="col-12">--}}
                {{--<div class="form-group required {{ $errors->has('name') ? 'has-error' : '' }}">--}}
                {{--{!! Form::label('name', __($type.'.name'), array('class' => ' required')) !!}--}}
                {{--{!! Form::text('name', null, array('class' => 'form-control', 'required' => true,'placeholder'=>__($type.'.name'))) !!}--}}
                {{--<span class="help-block">{{ $errors->first('name', ':message') }}</span>--}}
                {{--</div>--}}
                {{--</div>--}}
                <div class="col-12">
                    <div class="form-group required {{ $errors->has('vocher_id') ? 'has-error' : '' }}">
                        {!! Form::label('vocher_id', __($type.'.vocher_id'), array('class' => ' required')) !!}
                        {!! Form::text('vocher_id', null, array('class' => 'form-control', 'required' => true,'placeholder'=>__($type.'.vocher_id'))) !!}
                        <span class="help-block">{{ $errors->first('vocher_id', ':message') }}</span>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group {{ $errors->has('active') ? 'has-error' : '' }}">
                        <input type="checkbox" name="active" id="active"
                               {{@$doc->active?'checked' : ''}} data-plugin="switchery"
                               data-color="#64b0f2" data-size="small"/>
                        <label for="active"> {{__($type.'.active')}} </label>
                        <span class="help-block">{{ $errors->first('active', ':message') }}</span>
                    </div>
                </div>
                <div class="col-12">
                    <div class="imgupload">
                        <img class="imguploadfile" src="{{asset('uploads/banner'). '/' . @$doc->img}}"
                             alt="Your image"/>
                        <a href="#" class="btn btn-secondary waves-effect">{{ __('form.select_image') }}
                            <input type='file' onchange="readURL(this);" name="banner_img" class="input_file_img"/>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-7">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="prebanner"
                         style="display: flex; flex-direction: column">
                        <img class="prebanner" src="{{asset('BE/images/be/topprebanner.png')}}" alt="prebanner"
                             style="width: 100%; height: 80px"/>
                        @if (!empty($doc->img))
                            <img class="imguploadfile"
                                 style="width: 100%;max-height: 200px;max-width: unset;border: solid 2px #7f8384"
                                 src="{{asset('uploads/banner'). '/' . @$doc->img}}">
                        @else
                            <img class="imguploadfile"
                                 style="width: 100%;max-height: 200px;max-width: unset;border: solid 2px #7f8384"
                                 src="{{asset('BE/images/be/centerprebanner.png')}}">
                        @endif

                        <img class="prebanner" src="{{asset('BE/images/be/botprebanner.png')}}" alt="prebanner"
                             style="width: 100%; height: 270px"/>
                    </div>

                </div>
            </div>
        </div>


    </div>


</div>

@include('BE.layouts._buttonsubmit')

