<div class="table-scrollable">
    <table class="table table-bordered">
        <thead class="">
        <tr>
            <th width="40" class="text-center">
                #
            </th>
            <th> {{__($type.'.name')}}</th>
            <th> {{__($type.'.title')}}</th>
            <th> {{__($type.'.manufacturer')}}</th>
            <th> {{__($type.'.time_use')}}</th>
            <th> {{__($type.'.number_code')}}</th>
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
                    <td> {{@$doc->manufacturer->name}} </td>
                    <td> {{$doc->time_use}} </td>
                    <td> {{count(@$doc->codevocherokes)}} using / {{$doc->number_code}}</td>
                    <td> {{@date(settings('date_format'),$doc->time_start)}} </td>
                    <td> {{@date(settings('date_format'),$doc->time_end)}} </td>
                    <td class="center">
                        @if (!empty($doc->img))
                            <img class="imgbannergird" src="{{asset('uploads/voucher'). '/thumb_' . $doc->img}}"
                                 alt="{{$doc->img}}"/>
                        @endif
                    </td>
                    <td> {{$doc->detail}} </td>
                    <td align="center">
                        < @include('BE.layouts._buttonactiontable',['doc'=>$doc])
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
