@extends('BE.layouts.auth')
@section('content')

    <div class="account-pages">
        <div class="account-box">
            <div class="account-logo-box">
                <h2 class="text-uppercase text-center">
                    <a href="{{url('')}}" class="text-success">
                        <span><img src="{{asset('BE/images/logo_dark.png')}}" alt="" height="30"></span>
                    </a>
                </h2>
                <h5 class="text-uppercase font-bold m-b-5 m-t-50">{{__('auth.sign_account')}}</h5>
                @include('flash::message')

            </div>
            <div class="account-content">
                {!! Form::open(array('url' => url('login'), 'method' => 'post', 'name' => 'form','class'=>'form-horizontal')) !!}

                <div class="form-group m-b-20 row">
                    <div class="col-12">
                        <label for="username">{{__('auth.username')}}</label>
                        {!! Form::text('username', null, array('class' => 'form-control','id' => 'username','autofocus' => true, 'placeholder'=>'Username', 'required'=>'required')) !!}
                    </div>
                </div>

                <div class="form-group row m-b-20">
                    <div class="col-12">
                        <label for="password">{{__('auth.password')}}</label>
                        {!! Form::password('password', array('class' => 'form-control','id' => 'password', 'placeholder'=>'Password', 'required'=>'required')) !!}
                    </div>
                </div>

                <div class="form-group row m-b-20">
                    <div class="col-12">

                        <div class="checkbox checkbox-success">
                            <input id="remember" type="checkbox" value="1" name="remember">
                            <label for="remember">
                                {{__('auth.remember')}}
                            </label>
                        </div>

                    </div>
                </div>

                <div class="form-group row text-center m-t-10">
                    <div class="col-12">
                        <button class="btn btn-md btn-block btn-primary waves-effect waves-light"
                                type="submit">{{__('auth.sign')}}
                        </button>
                    </div>
                </div>
                {!! Form::close() !!}

            </div>
        </div>
    </div>

@stop
