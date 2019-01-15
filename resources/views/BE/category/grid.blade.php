<div class="table-scrollable">
    <table class="table table-striped table-bordered table-hover">
        <thead class="">
        <tr>
            <th width="40" class="text-center">
                #
            </th>
            <th>{{__("$type.name")}}</th>
            <th>
                {{__("$type.parent")}}
            </th>
            <th>
                {{__("$type.meta_title")}}
            </th>
            <th>
                {{__("$type.meta_description")}}
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
                    <td>
                        {{@$doc->name}}
                    </td>
                    <td>
                        {{ $doc->parent_id ? @$doc->parent->name : 'Root Category' }}
                    </td>
                    <td>
                        {{$doc->meta_title}}
                    </td>
                    <td>
                        {{$doc->meta_description}}
                    </td>
                    <td align="center">
                        @include('BE.layouts._buttonactiontable',['doc'=>$doc])
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>

@include('BE.common.gridFooter')
