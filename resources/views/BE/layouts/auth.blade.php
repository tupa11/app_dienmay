<!DOCTYPE html>
<html lang="en">
<head>
    @include('BE.layouts._meta')
    @include('BE.layouts._assets')
</head>

<body class="bg-accpunt-pages">
<!-- HOME -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">

                <div class="wrapper-page">
                    @yield('content')

                </div>

            </div>
        </div>
    </div>
</section>
<!-- END HOME -->
@include('BE.layouts._assets_footer')
</body>
</html>
