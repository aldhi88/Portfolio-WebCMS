<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ========== Meta Tags ========== -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Website informasi untuk Kejati Sumatera Utara">
    <!-- ========== Page Title ========== -->
    <title>Kejati Website</title>
    <!-- ========== Favicon Icon ========== -->
    <link rel="shortcut icon" href="{{asset('web/assets/img/kejati/logo-mini.png')}}" type="image/x-icon">
    <!-- ========== Start Stylesheet ========== -->
    <link href="{{asset('web/assets/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{asset('web/assets/css/font-awesome.min.css')}}" rel="stylesheet" />
    <link href="{{asset('web/assets/css/flaticon-set.css')}}" rel="stylesheet" />
    <link href="{{asset('web/assets/css/elegant-icons.css')}}" rel="stylesheet" />
    <link href="{{asset('web/assets/css/animate.css')}}" rel="stylesheet" />
    <link href="{{asset('web/assets/css/bootsnav.css')}}" rel="stylesheet" />
    <link href="{{asset('web/assets/css/styled.css')}}" rel="stylesheet">
    <link href="{{asset('web/assets/css/responsive.css')}}" rel="stylesheet" />
    <link href="{{asset('web/assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{asset('web/assets/css/jquery.contactus.min.css')}}" rel="stylesheet" />
    @yield('css')
    <link href="{{asset('web/mine/custom.css')}}" rel="stylesheet" />
    <!-- ========== End Stylesheet ========== -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700,800" rel="stylesheet">
     @yield('meta_tags')

</head>

<body>
    <div class="loading"><div class="loader"></div></div>
    @include('web.layout.header')
    @yield('content')
    @include('web.layout.footer')



    <!-- jQuery Frameworks
============================================= -->
<script src="{{asset('web/assets/js/jquery-1.12.4.min.js')}}"></script>
<script src="{{asset('web/assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('web/assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('web/assets/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('web/assets/js/equal-height.min.js')}}"></script>
<script src="{{asset('web/assets/js/jquery.appear.js')}}"></script>
<script src="{{asset('web/assets/js/jquery.easing.min.js')}}"></script>
<script src="{{asset('web/assets/js/modernizr.custom.13711.js')}}"></script>
<script src="{{asset('web/assets/js/wow.min.js')}}"></script>
<script src="{{asset('web/assets/js/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('web/assets/js/imagesloaded.pkgd.min.js')}}"></script>
<script src="{{asset('web/assets/js/count-to.js')}}"></script>
<script src="{{asset('web/assets/js/loopcounter.js')}}"></script>
<script src="{{asset('web/assets/js/jquery.nice-select.min.js')}}"></script>
<script src="{{asset('web/assets/js/bootsnav.js')}}"></script>
@yield('js')
<script src="{{asset('web/assets/js/main.js')}}"></script>
<script>
$('.arcontactus-message-button').click(function(){
    var status = $('.messangers-block').hasClass("show-messageners-block");

    if(typeof status === 'boolean' && status === true) {
        $('.messangers-block').removeClass('show-messageners-block');
    }else{
        $('.messangers-block').addClass('show-messageners-block');
    }
    
})
</script>
</body>
</html>