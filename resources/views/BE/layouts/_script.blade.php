<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    function prev_tab() {
        $('.nav-tabs > .nav-item > .active').parent().prev('li').find('a').trigger('click');
    }

    function next_tab() {
        $('.nav-tabs > .nav-item > .active').parent().next('li').find('a').trigger('click');
    }

    $('.prev_tab').click(function () {
        $('.nav-tabs > .nav-item > .active').parent().prev('li').find('a').trigger('click');
    });

    $('.next_tab').click(function () {
        $('.nav-tabs > .nav-item > .active').parent().next('li').find('a').trigger('click');
    });

    $('.submit').click(function () {
        let form = $('body').find('form');
        form.trigger('submit');
    });


    // delete an item
    @if(isset($title))
    $('body').on('click', '.delete_item', function () {
        var deletethis = this;
        var str = $(this).data('id');
        var title = $(this).data('title');
        if ($(this).data('name')) {
            str = $(this).data('name');
        }
        var text = `Delete {{ strtolower($title) }} ${str} ?`;
        if (title) {
            text = `${title} {{ strtolower($title) }} ${str} ?`;
        }
        swal({
            title: 'Are you sure?',
            text: text,
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes !',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger m-l-10',
            buttonsStyling: false
        }).then(function () {
            $.ajax({
                url: '{{ url($urlcurrent) }}/' + $(deletethis).data('id'),
                type: 'post',
                data: {
                    '_method': 'delete',
                    '_token': '{{ csrf_token() }}',
                },
                success: function (data) {
                    if (data == 1) {
                        // swal(
                        //     'Deleted!',
                        //     'Your file has been deleted.',
                        //     'success'
                        // );
                        location.reload();
                    } else {
                        swal(
                            'Cancelled',
                            "{{ __('message.cant_delete_item') }}",
                            'error'
                        )
                    }
                }
            })

        }, function (dismiss) {
            // dismiss can be 'cancel', 'overlay',
            // 'close', and 'timer'
            // if (dismiss === 'cancel') {
            //     swal(
            //         'Cancelled',
            //         'Your imaginary file is safe :)',
            //         'error'
            //     )
            // }
        })

    });
    @endif

    $(".imguploadfile").click(function () {
        $('.input_file_img').click();
    });
    $(".imguploadfile")
        .error(function () {
            $(this).attr("src", urlbase + "/uploads/no-image.png");
        });


    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.imguploadfile')
                    .attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function inputIfy(containter) {
        $(containter + ' input[type=number]').click(function () {
            if ($(this).val() == 0) {
                $(this).val('');
            }
        }).blur(function () {
            if ($(this).val() == '') {
                $(this).val(0);
            } else {
                $(this).val(parseFloat($(this).val()));
            }
        });
    }

    $(function () {
        $('.checkbox01').change(function () { // fomat form checkbox value 1 or 0
            this.value = this.checked ? 1 : 0;
        });
        inputs = $('.checkbox01');
        inputs.each(function () {
            this.value = this.checked ? 1 : 0;
        });

        $(".select2").select2({
            placeholder: "Select",
            allowClear: true
        });
    })

    $(function () {


        $("#gridForm").submit(function (e, page) {

            if (page == undefined)
                page = 1;
            $('input[name=page]').val(page);

            //ajax submit

            $('#gridTable').html('<div class="text-center"><i style="font-size: 100px;" class="fa fa-spinner fa-spin"></i></div>');
            $.post($(this).attr('action'), $(this).serialize(), function (data, status) {
                if (status == 'success') {
                    $('#gridTable').html(data);
                    inputIfy('#gridTable');
                    $('.loading-container')
                        .addClass('loading-inactive');
                }

            });
            return false;

        }).trigger("submit", [{{@$grid['page']}}]);
    });

    $('#gridForm input').on('change', function () {
        $('#gridForm').submit();
    });


    // validate form
    $('form').bootstrapValidator({
        excluded: [':disabled'],
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        }
    }).on('err.field.fv', function (e, data) {
        var $invalidFields = data.fv.getInvalidFields().eq(0);
        var $tabPane = $invalidFields.parents('.tab-pane'),
            invalidTabId = $tabPane.attr('id');
        if (!$tabPane.hasClass('active')) {
            $invalidFields.focus();
        }
    }).on('keyup keypress', function (e) {
        var code = e.keyCode || e.which;
        if (code == 13 && !$(e.target).is("textarea") && $(e.target).closest('form').attr('id') != 'search-form' && $(e.target).closest('form').attr('id') != 'filter-form') {
            e.preventDefault();
            return false;
        }
    });

    // select box data
    function ajaxData(url, placeholder = '{{ __('message.search') }}', multiple = false) {
        return {
            placeholder: placeholder,
            width: '100%',
            allowClear: true,
            ajax: {
                url: url,
                delay: 250,
                data: function (params) {
                    var query = {
                        q: params.term,
                        page: '{{isset($type) ? $type : null}}',
                        multiple: multiple,
                    };
                    return query;
                },
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.text,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            },
            language: {
                noResults: function () {
                    return '{{ __('message.no_match') }}';
                }
            },
            escapeMarkup: function (markup) {
                return markup;
            },
            // templateSelection: function (template) {
            //     var text = template.text;
            //     if (typeof $(template.element).data('img') !== 'undefined' && $(template.element).data('img') != '') {
            //         text = '<img src="' + $(template.element).data('img') + '" class="thumb-data" /> <span>' + text + '</span>';
            //     }
            //     return $('<div style="display: inline-flex; align-items: center;">' + text + '</div>');
            // },
        }
    }

    function upFile(selector, url, callSuccess, multiple = true, fileName = 'gallery') {
        return $(selector).uploadFile({
            url: url,
            fileName: fileName,
            formData: {'_token': '{{ csrf_token() }}', 'page': '{{@$type}}'},
            extraHTML: function () {
                return `@include('BE.layouts._file', ['page' => @$type])`;
            },
            autoSubmit: false,
            showStatusAfterSuccess: false,
            uploadStr: 'Select images',
            statusBarWidth: "100%",
            dragdropWidth: "100%",
            showPreview: true,
            previewWidth: "20%",
            maxFileSize: "10000000",
            maxFileCount: 5,
            acceptFiles: "image/*",
            allowedTypes: "jpg,jpeg,png,gif",
            showFileCounter: true,
            multiple: multiple,
            cancelStr: "Remove",
            onSuccess: function (files, data, xhr, pd) {
                callSuccess(files, data, xhr, pd);
            }
        });
    }

</script>
