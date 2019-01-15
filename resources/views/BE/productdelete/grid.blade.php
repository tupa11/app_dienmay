<div class="table-scrollable">
    <table class="table table-bordered">
        <thead class="">
        <tr>
            <th width="40" class="text-center">
                #
            </th>
            <th>{{__("$type.name")}}</th>
            <th>{{__("$type.price")}}</th>
            <th>{{__("$type.category")}}</th>
            <th>{{__("$type.image")}}</th>
            <th>{{__("$type.active")}}</th>
            <th width="130" class="text-center">
                {{ __('product.restore')}}
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
                    <td> {{$doc->name}} </td>
                    <td> {{number_format($doc->price)}} </td>
                    <td> {{@$doc->category->name}} </td>
                    <td>
                        @if($doc->product_image && isset($doc->image->name) && $doc->image->name)
                            <img width="70" src="{{$doc->image->thumb_path}}"/>
                        @endif </td>
                    <td>
                        <label class="label label-{{ $doc->active ? 'success' : 'warning' }}">
                            {{ $doc->active ? 'Active' : 'Inactive' }}</label>
                    </td>
                    <td align="center">
                        <a href="javascript:void(0)" data-id="{{@$doc->id}}"
                           class="btn btn-danger btn-xs delete_item" data-title="restore"><i
                                class="fa fa-trash-o"></i> {{__('productdelete.restore')}}</a>

                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>

@include('BE.common.gridFooter')
