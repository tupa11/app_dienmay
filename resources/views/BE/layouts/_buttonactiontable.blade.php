<a href="{{ route('admin.'.@$type.'.edit',@$doc->id) }}"
   class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> {{__('table.edit')}}</a>
<a href="javascript:void(0)" data-id="{{@$doc->id}}"
   class="btn btn-danger btn-xs delete_item"><i
        class="fa fa-trash-o"></i> {{__('table.delete')}}</a>
