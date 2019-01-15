@extends('BE.layouts.BE')
@section('title')
    {{$title}}
@stop

@section('content')

    <div class="row">
        <div class="col-12 col-md-8">
            <div class="card-box">
                <form method="post" action="{{route('admin.profile.update',$user_data->id )}}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">

                        <div class="col d-flex justify-content-center">
                            <div class="imgupload" style="width: 400px;">
                                <img class="imguploadfile" src="{{@$user_data->avatar}}"
                                     alt="Your image"
                                     style="width: 100%;min-width: unset;max-width: unset"/>
                                <a href="#" class="btn btn-secondary waves-effect">{{ __('form.select_image') }}
                                    <input type='file' onchange="readURL(this);" name="avatar_file"
                                           class="input_file_img"/>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="name" class="control-label">{{__('admin.name')}}</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       placeholder="Nguyễn Văn A"
                                       value="{{$user_data->name}}">
                            </div>
                            <div class="form-group">
                                <label for="lang" class="control-label">{{__('admin.lang')}}</label>
                                {!! Form::select('lang', $lang, isset($user_data) ? $user_data->lang : null, ['class' => 'form-control','id'=>'lang']) !!}
                            </div>

                            <div class="row">
                                <div class="form-group col-5">
                                    <label for="phone" class="control-label">{{__('admin.phone')}}</label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                           placeholder="0987654321" value="{{$user_data->phone}}">
                                </div>

                                <div class="form-group col-7">
                                    <label for="gender" class="control-label">{{__('admin.gender')}}</label>
                                    <div>
                                        <div class=" radio radio-custom form-check-inline mt-2">
                                            <input type="radio" id="nam" value="1"
                                                   name="gender" {{$user_data->gender?"checked":""}}>
                                            <label for="nam"> Nam </label>
                                        </div>
                                        <div class="radio radio-custom form-check-inline mt-2">
                                            <input type="radio" id="nu" value="0"
                                                   name="gender" {{!$user_data->gender?"checked":""}}>
                                            <label for="nu"> Nữ </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="bank_account_no" class="control-label">{{__('admin.username')}}</label>
                                <input type="text" class="form-control" id="username" name="username"
                                       placeholder="{{__('admin.username')}}" readonly value="{{$user_data->username}}">
                            </div>
                            <div class="form-group">
                                <label for="address" class="control-label">{{__('admin.area')}}</label>
                                {!! Form::select('area_id', $areas_pluck, @$user_data->area_id, ['class' => 'select2','style'=>'width:100%']) !!}
                            </div>

                            <div class="form-group d-flex justify-content-end">
                                <button class="btn btn-custom" type="submit">Cập nhật</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card-box">
                <h5 class="card-title">Đổi mật khẩu</h5>
                <p class="text-custom">{{@$messupdatepass}}</p>
                <form method="post" action="{{route('admin.profile.update',$user_data->id )}}">
                    <input type="hidden" value="changepass" name="changepass">
                    @csrf
                    @method('put')
                    <div class="row ">
                        <div class="col">
                            <div class="form-group">
                                <label for="name" class="control-label">Nhập mật khẩu cũ</label>
                                <input type="password" class="form-control" id="oldPass" name="oldPass"
                                       value="{{old('oldPass')}}">
                                <p class="text-danger">{{ $errors->first('oldPass', ':message') }}</p>
                            </div>

                            <div class="form-group">
                                <label for="email" class="control-label">Nhập mật khẩu mới</label>
                                <input type="password" class="form-control" id="newPass" name="newPass"
                                       value="{{old('newPass')}}">
                                <p class="text-danger">{{@$errors->first('newPass',':message')}}</p>
                            </div>

                            <div class="form-group">
                                <label for="confNewPass" class="control-label">Nhập lại mật khẩu mới</label>
                                <input type="password" class="form-control" id="confNewPass" name="confNewPass"
                                       value="{{old('confNewPass')}}">
                                <p class="text-danger">{{@$errors->first('confNewPass',':message')}}</p>
                            </div>
                            <div class="form-group d-flex justify-content-end">
                                <button class="btn btn-custom" type="submit">Cập nhật</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $('input').on('change', () => {
            console.log($(this).parent().find('p'));
            $(this).parent().filter("p:first").first().text();
        })
    </script>
@endsection
