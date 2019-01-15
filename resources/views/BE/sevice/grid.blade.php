<div class="table-scrollable">
    <table class="table table-striped table-bordered table-hover">
        <thead class="">
        <tr>
            <th width="40" class="text-center">
                #
            </th>
            <th>{{ __($type.'.name')}}</th>
            <th>{{ __($type.'.parent')}}</th>
            <th>{{ __($type.'.meta_title')}}</th>
            <th>{{ __($type.'.meta_description')}}</th>
            <th width="130" class="text-center">
                <a href="{{route('admin.'.$type.'.create')}}" class="btn btn-success btn-xs">
                    <i class="fa fa-plus"></i> {{ __('table.new')}}</a>
            </th>
        </tr>
        </thead>
        <tbody>
        @if(count($docs))
            @foreach($docs as $key => $doc)
                <tr>
                    <td>
                        {{(++$key + $grid['limit'] * ($grid['page'] - 1))}}
                    </td>
                    <td>
                        {{$doc->name}}
                    </td>

                    <td align="center">
                        <a href="{{ route('admin.'.$type.'.edit',$doc->id) }}"
                           class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> {{__('table.edit')}}</a>
                        <a href="javascript:void(0)" data-id="{{$doc->id}}"
                           class="btn btn-danger btn-xs delete_item"><i
                                class="fa fa-trash-o"></i> {{__('table.delete')}}</a>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>

@include('BE.common.gridFooter')
