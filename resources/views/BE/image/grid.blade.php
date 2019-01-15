@if(count($docs))
    @foreach($docs->chunk(4) as $chunk)
        <div class="row">
            @foreach ($chunk as $doc)
                <div class="img-box col-sm-3">
                    <a href="{{ $doc->full_path }}" data-lightbox="gallery-set"
                       data-title="{{ $doc->name }}">
                        <img src="{{ $doc->full_path }}" alt="" class="img-fluid"/>
                    </a>
                    <div class="img-toolbox">
                        <a class="edit-item" href="javascript:void(0)"
                           data-url="{{ url('admin/image/' . $doc->id.'/edit' ) }}"
                           title="{{ __('table.edit') }}"><i class="fa fa-fw fa-pencil text-warning"></i> </a>
                        <a href="javascript:void(0)" class="delete_item" data-name="{{ $doc->name }}"
                           data-id="{{$doc->id}}" title="{{ __('table.delete') }}"><i
                                class="fa fa-fw fa-times text-danger"></i></a>
                    </div>
                </div>
            @endforeach

        </div>
    @endforeach
@endif
<script>

    var galleryObj = upFile("#fileuploader", "{{ url('admin/image') }}", function (files, data, xhr, pd) {
        location.reload();
    }, false);

    $("#gallery_close").click(function (e) {
        galleryObj.startUpload();
    });

    $('.edit-item').click(function (e) {
        var url = $(this).data('url');
        var url2 = url.replace("/edit", "");
        $.ajax({
            url: url,
            type: 'GET',
            success: function (data) {
                $('#name').val(data.file_name);
                $('#title').val(data.title);
                $('#alt').val(data.alt);
                $('#editForm').attr('action', url2);
                $('#editModal').modal('show');
            }
        });
    })
</script>

@include('BE.common.gridFooter')
