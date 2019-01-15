<div class="table-scrollable">
    <table class="table table-striped table-bordered table-hover">
        <thead class="">
        <tr>
            <th width="40" class="text-center">
                #
            </th>
            <th>{{__("$type.vocher")}}</th>
            <th>{{__("$type.code")}}</th>
            <th>{{__("$type.member")}}</th>
            <th>{{__("$type.manufacturer")}}</th>
            <th width="130" class="text-center">
                <a href="{{route("admin.$type.create")}}" class="btn btn-success btn-xs">
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
                    <td> {{@$doc->voucher->name}} </td>
                    <td> {{$doc->code}} </td>
                    <td> {{@$doc->member->name}} </td>
                    <td> {{@$doc->manufacturer->name}} </td>
                    <td align="center">
                        <a href="javascript:void(0)" data-id="{{$doc->code}}"
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
