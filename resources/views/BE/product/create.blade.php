@extends('BE.layouts.tabsform')

@section('title')
    {{$title}}
@stop
@section('form-title')
    {{__($type.'.new')}} {{@$doc->name}}
@stop

@section('form-nav')

    @php
        $nav = array(
        'info'=>'fa fa-empire',
        'price'=>'fa fa-empire',
        'file'=>'fa fa-empire',
        );
    @endphp

    @foreach($nav as $k=>$v)
        <li class="nav-item">
            <a class=" nav-link {{@$loop->first?'active':''}}" href="#{{$k}}" data-toggle="tab"
               title="{{ __("tab.$k") }}">
                <i class="{{$v}}"> {{ __("tab.$k") }}</i>
            </a>
        </li>
    @endforeach
@stop

@section('form-body')


    @if (isset($doc))
        {!! Form::model($doc, array('url' => $linkedit, 'method' => 'put', 'files'=> true)) !!}
        <input type="hidden" value="{{ $doc->id }}" name="id">
    @else
        {!! Form::open(array('url' => $linkadd, 'method' => 'post', 'files'=> true)) !!}
    @endif


    <div class="tab-content">
        @include('BE/'.$type.'/form')
    </div>

    {!! Form::close() !!}

@stop

@section('scripts')
    <script src="{{ asset('BE/plugins/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('BE/js/BE/jquery.uploadfile.min.js') }}"></script>

    <link href="{{ asset('BE/css/uploadfile.css') }}" rel="stylesheet"
          type="text/css"/>

    <script>

        function mainImage() {
            if (!$('input[name="product_image"]:checked').length) {
                // $('input[name="product_image"]:first').iCheck('check');
            }
        }

        function doSuccess(files, data, xhr, pd) {
            $("#product_image").append(`<tr class="remove_tr">
            <input type="hidden" name="image_gallery[]" value="${data.id}">
            <td><a href="{{ url('uploads/products') }}/${data.name}" target="_blank"><img src="{{ url('uploads/products/thumb_') }}${data.name}"></a></td>
            <td><a href="{{ url('uploads/products') }}/${data.name}" target="_blank">${data.name}</a></td>
            <td>${data.title}</td><td>${data.alt}</td>
            <td><input type="radio" class="product_image" name="product_image" value="${data.id}"><br></td>
            <td><a href="javascript:void(0)" class="removeclass"><i class="fa fa-fw fa-times fa-lg text-danger"></i></a></td>
            </tr>`);
            mainImage();
            $(window).bind('beforeunload', function () {
                return true;
            });
        }

        $('body').on("click", ".removeclass", function (e) {
            $(this).parent().parent().remove();
            mainImage();
            $(window).bind('beforeunload', function () {
                return true;
            });
        });

        var galleryObj = upFile("#fileuploader", "{{ route('admin.product.upload') }}", doSuccess);

        $("#gallery_close").click(function (e) {
            galleryObj.startUpload();
            {{--if ($('#url-upload').val()) {--}}
            {{--$.ajax({--}}
            {{--url: '{{ url('product/upload-from-url') }}',--}}
            {{--data: {--}}
            {{--_token: '{{ csrf_token() }}',--}}
            {{--url: $('#url-upload').val(),--}}
            {{--title: $('#url-title').val(),--}}
            {{--alt: $('#url-alt').val()--}}
            {{--},--}}
            {{--type: 'POST',--}}
            {{--success: function (data) {--}}
            {{--if (data) {--}}
            {{--doSuccess(null, data, null, null);--}}
            {{--$('#url-upload').val('');--}}
            {{--$('#url-title').val('');--}}
            {{--$('#url-alt').val('');--}}
            {{--}--}}
            {{--}--}}
            {{--});--}}
            {{--}--}}
        });

        $(function () {
            CKEDITOR.replace('editor');

            $('.datepicker-autoclose1').datepicker({
                locale: {
                    format: '{{settings('jquery_date')}}'
                },
                format: "{{strtolower(settings('jquery_date'))}}",
                autoclose: true,
                todayHighlight: true
            });

            $('.datepicker-autoclose2').datepicker({
                locale: {
                    format: '{{settings('jquery_date')}}'
                },
                format: "{{strtolower(settings('jquery_date'))}}",
                autoclose: true,
                todayHighlight: true
            });

        })
    </script>
@endsection
