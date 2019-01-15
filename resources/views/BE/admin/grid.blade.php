<div class="table-scrollable">
    <table class="table table-striped table-bordered table-hover">
        <thead class="">
        <tr>
            <th width="40" class="text-center">
                #
            </th>
            <th>{{__("$type.avatar")}}</th>
            <th>{{__("$type.name")}}</th>
            <th>{{__("$type.info")}}</th>
            <th>{{__("$type.active")}}</th>
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
                        @if (!empty($doc->avatar))
                            <img class="imgviewadmin" src="{{$doc->avatar}}" alt=""/>
                        @endif
                    </td>
                    <td>
                        {{__("$type.id")}}: <strong>{{$doc->id}}</strong><br>
                        {{$doc->name}}
                    </td>
                    <td>
                        {{__("$type.phone")}}: <strong>{{$doc->phone}}</strong><br>
                        {{__("$type.gender")}}: <strong><?= ($doc->gender) ? 'Nam' : 'Nữ'; ?></strong><br>
                        {{__("$type.address")}}: <strong>{{@$doc->area->name_address}}</strong><br>
                        @if(!empty($doc->last_login))
                            {{__("$type.last_login")}}: {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $doc->last_login)
                            ->format('H:i:s - '.@settings('date_format'))}}
                        @endif
                    </td>
                    <td class="center">
                        {{$doc->active== 1?'Đang hoạt động':'Dừng hoạt động'}}<br>
                        {{__("$type.role")}}: <strong>{{@$doc->role->name}}</strong>
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
