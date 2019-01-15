<div class="table-scrollable">
    <table class="table table-bordered">
        <thead class="">
        <tr>
            <th width="40" class="text-center">
                #
            </th>
            <th> {{__($type.'.name')}}</th>
            <th> {{__($type.'.title')}}</th>
            <th> {{__($type.'.time_start')}}</th>
            <th> {{__($type.'.time_end')}}</th>
            <th> {{__($type.'.img')}}</th>
            <th> {{__($type.'.detail')}}</th>
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
                        {{$doc->name}}
                    </td>
                    <td>
                        {{$doc->title}}
                    </td>
                    <td> {{$doc->time_start}} </td>
                    <td> {{$doc->time_end}} </td>
                    <td class="center">
                        @if (!empty($doc->img))
                            <img class="imgbannergird" src="{{asset('uploads/sale_viethan'). '/thumb_' . $doc->img}}"
                                 alt="{{$doc->img}}"/>
                        @endif
                    </td>
                    <td> {{$doc->detail}} </td>
                    <td align="center">
                        @include('BE.layouts._buttonactiontable',['doc'=>$doc])
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>

<style>
    .imgbannergird {
        width: 80px;
        height: 60px;
    }
</style>

@include('BE.common.gridFooter')
