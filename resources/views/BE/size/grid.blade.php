<div class="table-scrollable">
    <table class="table table-striped table-bordered table-hover">
        <thead class="">
        <tr>
            <th width="40" class="text-center">
                #
            </th>
            <th>{{__("$type.id")}}</th>
            <th>
                {{__("$type.code")}}
            </th>
            <th>
                {{__("$type.value")}}
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
                    <td align="center" width="80px">
                        {{$doc->id}}
                    </td>
                    <td>
                        {{$doc->code}}
                    </td>
                    <td>
                        {{$doc->value}}
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
