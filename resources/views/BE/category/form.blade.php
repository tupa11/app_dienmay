<div class="tab-pane active" id="info">
    <div class="row">
        <div class="form-group col-xs-6 required {{ $errors->has('parent_id') ? 'has-error' : '' }}">
            {!! Form::label('parent_id', __('category.parent'), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::select('parent_id', $categories, isset($category) ? $category->parent_id : null, ['class' => 'select2','style'=>'width:100%']) !!}
                <span class="help-block">{{ $errors->first('parent_id', ':message') }}</span>
            </div>
        </div>
        <div class="form-group col-xs-6 required {{ $errors->has('name') ? 'has-error' : '' }}">
            {!! Form::label('name', __('category.name'), array('class' => 'control-label required')) !!}
            <div class="controls">
                {!! Form::text('name', null, array('class' => 'form-control', 'required' => true)) !!}
                <span class="help-block">{{ $errors->first('name', ':message') }}</span>
            </div>
        </div>
        <div class="clear"></div>
        <div class="form-group col-xs-6 {{ $errors->has('meta_title') ? 'has-error' : '' }}">
            {!! Form::label('meta_title', __('category.meta_title'), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('meta_title', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('meta_title', ':message') }}</span>
            </div>
        </div>
        <div class="form-group col-xs-6 {{ $errors->has('meta_description') ? 'has-error' : '' }}">
            {!! Form::label('meta_description', __('category.meta_description'), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('meta_description', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('meta_description', ':message') }}</span>
            </div>
        </div>
        <div class="clear"></div>

        <div
            class="form-group fileinput col-xs-6 fileinput-{{isset($category) && $category->image ? 'exists' : 'new' }}"
            data-provides="fileinput">
            <input type="hidden" id="image" name="image"
                   value="{{isset($category) && $category->image ? $category->image : ''}}">
            {!! Form::label('image', __('news.image'), array('class' => 'control-label')) !!}
            <div class="controls">
                <div class="fileinput-preview fileinput-exists thumbnail" style="width: 200px">
                    @if (isset($category) && $category->image)
                        <img src="{{asset('uploads/product_category'). '/' . $category->image}}"
                             width="200">
                    @endif
                </div>

                <div>
                    <span class="btn btn-default btn-file">
                        <span class="fileinput-new">{{ __('form.select_image') }}</span>
                        <span class="fileinput-exists">{{ __('form.change_image') }}</span>
                        <input type="file" name="image_file" {{ isset($category) ? '' : 'required' }}>
                    </span>
                    <span class="btn btn-default fileinput-exists"
                          data-dismiss="fileinput">{{ __('form.remote_image') }}</span>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>

@include('BE.layouts._buttonsubmit')

