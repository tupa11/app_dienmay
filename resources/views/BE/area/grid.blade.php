<div class="table-scrollable">
    <table class="table table-striped table-bordered table-hover">
        <thead class="">
        <tr>
            <th width="40" class="text-center">
                #
            </th>
            <th>{{ __("$type.name")}}</th>
            <th>{{ __("$type.address")}}</th>
            <th width="130" class="text-center">
                <a href="#" class="btn btn-success btn-xs" onclick="editCity()">
                    <i class="fa fa-plus"></i> {{ __('table.new')}}</a>
            </th>
        </tr>
        </thead>
        <tbody>
        @if(count($docs))
            @foreach($docs as $key => $doc)
                <tr>
                    <td align="center">
                        {{(++$key + $grid['limit'] * ($grid['page'] - 1))}}
                    </td>
                    <td>
                        {{$doc->name}}
                    </td>
                    <td>
                        {{@$doc->address}}
                    </td>
                    <td align="center" width="150">
                        <a href="#" class="btn btn-primary btn-xs" onclick="editCity('{{$doc->id}}')">
                            <i class="fa fa-edit"></i> {{__('table.edit')}}</a>
                        <a href="javascript:void(0)" data-id="{{$doc->id}}"
                           class="btn btn-danger btn-xs delete_item"><i
                                class="fa fa-trash-o"></i> {{__('table.delete')}}
                        </a>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>
<script>
    function editCity(id) {
        $(".form_modal").modal('show');
        $("#area_id").val(id);
        $("#mySmallModalLabel").text("{{__("$type.new")}}");
        if (id) {
            $("#mySmallModalLabel").text("{{__("$type.edit")}}");
            var urledit = '{{$type}}/' + id;
            $.ajax({
                url: urledit,
                type: 'GET',
                success: function (data) {
                    if (data) {
                        $("#{{$type}}_name").val(data.name);
                        $("#{{$type}}_address").val(data.address);
                    }
                }
            });
        }
    }
</script>
@include('BE.common.gridFooter')

