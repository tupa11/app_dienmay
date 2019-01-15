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
                            <img class="imgviewadmin" src="{{asset('uploads/member/'.@$doc->avatar)}}" alt=""/>
                        @endif
                    </td>
                    <td>
                        {{__("$type.id")}}: <strong>{{$doc->id}}</strong> - {{$doc->name}}<br>
                        {{__("$type.level")}}: <strong>{{$doc->level}}</strong><br>

                        @if(!empty($doc->dateofbirth))
                            {{__("$type.dateofbirth")}}: {{$doc->dateofbirth}}<br>
                        @endif
                        @if(!empty($doc->last_login))
                            {{__("$type.last_login")}}: {{$doc->last_login}}<br>
                        @endif
                        {{__("$type.admin_manager")}}: <strong>{{@$doc->admin->name}}</strong><br>
                    </td>
                    <td>
                        {{__("$type.phone")}}: <strong>{{$doc->phone}}</strong><br>
                        @if(!empty($doc->email))
                            {{__("$type.email")}}: <strong>{{$doc->email}}</strong><br>
                        @endif
                        {{__("$type.gender")}}: <strong><?= ($doc->gender) ? 'Nam' : 'Nữ'; ?></strong><br>
                        {{__("$type.area")}}: <strong>{{@$doc->area->name_address}}</strong><br>
                        {{__("$type.address")}}: <strong>{{@$doc->address}}</strong>
                    </td>
                    <td class="center">
                        {{$doc->active== 1?'Đang hoạt động':'Dừng hoạt động'}}<br>

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
