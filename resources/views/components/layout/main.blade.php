<!doctype html>
<html lang="en">
@include('components.layout.head',['title'=>$title])

<body data-sidebar="dark">
    <div class="loading"><div class="loader"></div></div>
    <div id="layout-wrapper">

        @include('components.layout.header')
        @include('components.layout.leftmenu')

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    @yield('content')
                </div> <!-- container-fluid -->
            </div>
            @include('components.layout.footer')
        </div>
        <!-- end main content-->

    </div>
    <div class="rightbar-overlay"></div>
    @include('components.layout.script')
    
</body>
</html>
