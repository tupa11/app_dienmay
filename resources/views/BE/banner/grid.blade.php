<div class="table-scrollable">
    <table class="table table-striped table-bordered table-hover">
        <thead class="">
        <tr>
            <th width="40" class="text-center">
                #
            </th>
            <th>{{__('banner.vocher')}}</th>
            <th>
                {{__('banner.active')}}
            </th>
            <th>
                {{__('banner.img')}}
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
                        {{@$doc->vocher->name}}
                    </td>
                    <td>
                        {{$doc->active== 1?'Show':'Hide'}}
                    </td>
                    <td class="center">
                        @if (!empty($doc->img))
                            <img class="imgbannergird" src="{{asset('uploads/banner'). '/' . $doc->img}}"
                                 alt="{{$doc->img}}"/>
                        @endif
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

<style>
    .imgbannergird {
        width: 500px;
        height: 120px;
    }
</style>

@include('BE.common.gridFooter')
