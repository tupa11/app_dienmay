<div class="row" style="margin-top: 10px">
    <div class="col-12">
        <div class="form-group">
            <a href="{{ route('admin.'.$type.'.index') }}" class="btn btn-danger" {{@$modal?'data-dismiss=modal':''}}>
                <i class="fa fa-times"></i> {{__('table.back')}}</a>
            <button type="{{@$button?'button':'submit'}}" class="btn btn-success" id="button_submit">
                <i class="fa fa-check-square-o"></i> {{__('table.ok')}}</button>
        </div>
    </div>
</div>
