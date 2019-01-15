<!DOCTYPE html>
<html>
<head>
    @include('BE.layouts._meta')
    @include('BE.layouts._assets')
    @yield('scriptstop')
    {{--custom style--}}
    @yield('styles')
    {{--custom style--}}
</head>
<body>

<div id="wrapper">
@include("BE.layouts._header")
@include("BE.layouts._menu")

<!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container-fluid">
                @include("BE.layouts._breadcrumbs")

                @include('flash::message')
                @if($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-icon alert-danger alert-dismissible fade show" role="alert">
                            <button class="close" data-dismiss="alert" aria-label="Close">
                                ×
                            </button>
                            <i class="mdi mdi-block-helper"></i>
                            <strong>Error!</strong> {{ $error }}
                        </div>
                    @endforeach
                @endif
                @yield('content')
            </div> <!-- container -->

        </div> <!-- content -->

        {{--<footer class="footer text-right">--}}
        {{--2017 © Adminox. - Coderthemes.com--}}
        {{--</footer>--}}

    </div>


    <!-- ============================================================== -->
    <!-- End Right content here -->
    <!-- ============================================================== -->

</div>

<!-- global js -->
@include('BE.layouts._assets_footer')
@include('BE.layouts._script')
@yield('scripts')
</body>
</html>
