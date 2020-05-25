<!DOCTYPE html>
<html>
<head>
    @include('layouts.head')
</head>
<body>
    <div class="top-navbar">
        @include('layouts.navbar')
    </div>

    <div class="main clearfix">
        <div class="left-main col-2">
            @include('layouts.leftsidebar')
        </div>
        <div class="right-main col-10">
            <div class="content">
                @yield('content')
            </div>
        </div>
    </div>

    <div class="footer">
        @include('layouts.footer')
    </div>

    @include('layouts.script')
</body>
</html>
