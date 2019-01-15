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
            <div class="form-group required {{ $errors->has('category') ? 'has-error' : '' }}">
                {!! Form::label('category_id', __($type.'.category'), array('class' => 'required')) !!}
                <div class="controls">
                    {!! Form::select('category_id', $categorys_pluck, @$doc->category_id, ['class' => 'select2','style'=>'width:100%']) !!}
                    <span class="help-block">{{ $errors->first('category', ':message') }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-md-6">
            <div class="form-group required {{ $errors->has('color_id') ? 'has-error' : '' }}">
                {!! Form::label('color_id', __($type.'.color'), array('class' => 'required')) !!}
                <div class="controls">
                    {!! Form::select('color_id', $colors_pluck, @$doc->color_id, ['class' => 'select2','style'=>'width:100%']) !!}
                    <span class="help-block">{{ $errors->first('color_id', ':message') }}</span>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
            <div class="form-group required {{ $errors->has('size_id') ? 'has-error' : '' }}">
                {!! Form::label('size_id', __($type.'.size'), array('class' => 'required')) !!}
                <div class="controls">
                    {!! Form::select('size_id', $sizes_pluck, @$doc->size_id, ['class' => 'select2','style'=>'width:100%']) !!}
                    <span class="help-block">{{ $errors->first('size_id', ':message') }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            {!! Form::label('detail', __($type.'.details'), array('class' => ' required')) !!}
            <div class="form-group {{ $errors->has('details') ? 'has-error' : '' }}">
                {!! Form::textArea('details', @$doc->detail, array('class' => 'form-control','id' => 'editor')) !!}
                <span class="help-block">{{ $errors->first('details', ':message') }}</span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-3">
            <div class="checkbox checkbox-custom">
                <input type="checkbox" id="show_pass" class="checkbox01">
                <label for="show_pass"> {{ __("$type.is_main") }} </label>
            </div>
        </div>
        <div class="form-group col-md-3 {{ $errors->has('active') ? 'has-error' : '' }}">
            <div class="checkbox checkbox-custom">
                <input type="checkbox" id="active" name="active" class="checkbox01"
                    {{!isset($doc)?'checked':($doc->active?'checked' : '')}}>
                <label for="active"> {{__("$type.active")}} </label>
                <span class="help-block">{{ $errors->first('active', ':message') }}</span>
            </div>
        </div>

    </div>
</div>

<div class="tab-pane " id="price">
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="form-group required {{ $errors->has('price') ? 'has-error' : '' }}">
                {!! Form::label('price', __($type.'.price'), array('class' => ' required')) !!}
                <span class="input-icon icon-right">
                    {!! Form::text('price', null, array('class' => 'form-control', 'required' => true,'placeholder'=>__($type.'.price'))) !!}
                    <span class="help-block">{{ $errors->first('price', ':message') }}</span>
                </span>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="form-group required {{ $errors->has('price_new') ? 'has-error' : '' }}">
                {!! Form::label('price_new', __($type.'.price_new')) !!}
                <span class="input-icon icon-right">
                    {!! Form::text('price_new', null, array('class' => 'form-control', 'placeholder'=>__($type.'.price_new'))) !!}
                    <span class="help-block">{{ $errors->first('price_new', ':message') }}</span>
                </span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="form-group required {{ $errors->has('sale_from') ? 'has-error' : '' }}">
                {!! Form::label('sale_from', __($type.'.sale_from')) !!}
                <div class="input-group">
                    {!! Form::text('sale_from', null, array('class' => 'form-control datepicker-autoclose1','placeholder'=> settings('jquery_date'))) !!}
                    <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar text-white"></i></span>
                    <span class="help-block">{{ $errors->first('sale_from', ':message') }}</span>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="form-group required {{ $errors->has('sale_to') ? 'has-error' : '' }}">
                {!! Form::label('sale_to', __($type.'.sale_to')) !!}
                <div class="input-group">
                    {!! Form::text('sale_to', null, array('class' => 'form-control datepicker-autoclose2','placeholder'=> settings('jquery_date'))) !!}
                    <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar text-white"></i></span>
                    <span class="help-block">{{ $errors->first('sale_to', ':message') }}</span>
                </div>
            </div>
        </div>
    </div>

</div>


<div class="tab-pane " id="file">
    <div class="row">
        <div class="col-12">
            <label class="control-label">{{__("$type.img")}}</label>
            <table class="table table-bordered">
                <thead>
                <tr style="font-size: 12px;">
                    <th>Preview</th>
                    <th>Image Name</th>
                    <th>Image Title</th>
                    <th>Image Alt</th>
                    <th>Main image</th>
                    <th></th>
                </tr>
                </thead>
                <tbody id="product_image">
                @if (isset($productGallery))
                    @foreach ($productGallery as $item)
                        <tr class="remove_tr">
                            <input type="hidden" name="image_gallery[]" value="{{ $item->id }}">
                            <td><a href="{{ url('uploads/products/' . $item->name) }}"
                                   target="_blank"><img
                                        src="{{ url('uploads/products/thumb_'. $item->name) }}"></a>
                            </td>
                            <td><a href="{{ url('uploads/products/' . $item->name) }}"
                                   target="_blank">{{ $item->name }}</a></td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->alt }}</td>
                            <td>
                                <div class="radio radio-success">
                                    <input type="radio" id="inlineRadio{{$item->id}}" value="{{ $item->id }}"
                                           name="product_image" {{ $item->id == $doc->product_image ? 'checked' : '' }}>
                                    <label for="inlineRadio{{$item->id}}">
                                        {{$item->id}} choose
                                    </label>
                                </div>
                            </td>

                            <td><a href="javascript:void(0)" class="removeclass"><i
                                        class="fa fa-fw fa-times fa-lg text-danger"></i></a></td>
                        </tr>
                    @endforeach
                @endif

                </tbody>
            </table>
            <button type="button" data-toggle="modal" data-target="#galleryModal" class="btn btn-primary">Upload
            </button>
        </div>
    </div>

</div>


<div id="galleryModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{ __('product.image_gallery') }}</h4>
            </div>
            <div class="modal-body">

                <div class="p-20 p-b-0">
                    <div class="form-group clearfix">
                        <div id="fileuploader"></div>
                    </div>
                </div>

                <table id="url">
                    <tr>
                        <td colspan="2"><h4>{{ __('product.upload_from_url') }}</h4></td>
                    </tr>
                    <tr>
                        <td><label>{{__('table.image_url')}}</label></td>
                        <td><input type="text" id="url-upload" size="35"></td>
                    </tr>
                    <tr>
                        <td><label>{{__('table.image_title')}}</label></td>
                        <td><input type="text" id="url-title" size="35"></td>
                    </tr>
                    <tr>
                        <td><label>{{__('table.image_alt')}}</label></td>
                        <td><input type="text" id="url-alt" size="35"></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal"
                        id="gallery_close">{{ __('form.start_upload') }}</button>
            </div>
        </div>
    </div>
</div>

@include('BE.layouts._buttonsubmit')
