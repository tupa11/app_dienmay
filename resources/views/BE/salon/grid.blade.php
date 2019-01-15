<div class="table-scrollable">
    <table class="table table-striped table-bordered table-hover">
        <thead class="">
        <tr>
            <th width="40" class="text-center">
                #
            </th>
            <th>
                {{__('salon.img')}}
            </th>
            <th>
                {{__('salon.name')}}
            </th>
            <th>
                {{__('salon.phone')}}
            </th>
            <th>
                {{__('salon.admin')}}
            </th>
            <th>
                {{__('salon.city')}}
            </th>
            <th>
                {{__('salon.district')}}
            </th>
            <th>
                {{__('salon.address')}}
            </th>
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
                    <td align="center" width="10px">
                        {{(++$key + $grid['limit'] * ($grid['page'] - 1))}}
                    </td>
                    <td align="center" width="100px">
                        @if (!empty($doc->img))
                            <img class="imgviewadmin" src="{{$doc->img}}" alt=""/>
                        @endif
                    </td>
                    <td>
                        {{$doc->name}}
                    </td>
                    <td>
                        {{$doc->phone}}
                    </td>
                    <td>
                        {{@$doc->admin->full_name}}
                    </td>
                    <td>
                        {{@$doc->city->name}}
                    </td>
                    <td>
                        {{@$doc->district->name}}
                    </td>
                    <td>
                        {{$doc->address}}
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
