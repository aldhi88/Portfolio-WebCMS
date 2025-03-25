<!-- Preloader Start -->
{{-- <div class="se-pre-con"></div> --}}
<!-- Preloader Ends -->
<style>
   @media (min-width: 992px) { 
        .navbar-nav {
            display: flex;
            justify-content: center;
            width: 100%;
            float: none !important;
        }
    }
    
@media (min-width: 400px) { 

    .header-custom {
        height: 120px;
    }
}


@media (min-width: 700px) { 

    .header-custom {
        height: 120px;
        padding-bottom: 0px; 
    }
}
</style>
<!-- Start Header Top 
============================================= -->
<div class="top-bar-area address-one-lines bg-kejati text-light">
    <div class="container">
        <div class="row">
            <div class="col-md-8 address-info">
                <div class="info box">
                    <ul>
                        <li>
                            <i class="fas fa-map-marker"></i>
                            {{ \App\Models\Attribute::getAttr('address') }}
                        </li>
                        <li>
                            <i class="fas fa-envelope-open"></i>
                            {{ \App\Models\Attribute::getAttr('email') }}
                        </li>
                        <li>
                            <i class="fas fa-phone"></i>
                            {{ \App\Models\Attribute::getAttr('phone') }}
                        </li>
                    </ul>
                </div>
            </div>
            <div class="user-login text-right col-md-4">
                <a target="_blank" href="{{ \App\Models\Attribute::getAttr('location') }}">
                    <i class="fas fa-map"></i> Lihat di Maps
                </a>
            </div>
        </div>
    </div>
</div>
<!-- End Header Top -->


<!-- header custom -->
<div class="header-custom bg-kejati">
    <div class="container">
        <div class="row">
            <div class="col bg-header hidden-xs">
                <img src="{{asset('web/assets/img/kejati/logo.png')}}" class="logo-kejati">
            </div>
            <div class="col text-center visible-xs">
                <img src="{{asset('web/assets/img/kejati/logo-center.png')}}" class="logo-kejati-mini">
            </div>
        </div>
    </div>
</div>
<!-- end header custom -->
<!-- Main Menu 
============================================= -->
<header id="home">

    <!-- Start Navigation -->
    <nav class="navbar navbar-default attr-border navbar-sticky bootsnav">

        <!-- Start Top Search -->
        <div class="container">
            <div class="row">
                <div class="top-search">
                    <div class="input-group">
                        <form action="{{ route('web.pencarianBerita') }}" method="GET">@csrf
                            <input type="text" name="keyword" class="form-control" placeholder="Cari berdasarkan judul...">
                            <button type="submit"><i class="fas fa-search"></i></button>  
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Top Search -->

        <div class="container">

            <!-- Start Atribute Navigation -->
            <div class="attr-nav">
                <ul>
                    <li class="search"><a href="#"><i class="fa fa-search"></i></a></li>
                </ul>
            </div>        
            <!-- End Atribute Navigation -->
            <!-- Start Header Navigation -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="{{env('APP_URL')}}">
                    <img src="{{asset('web/assets/img/kejati/logo-mini.png')}}" height="20" class="logo" alt="Logo">
                </a>
            </div>
            <!-- End Header Navigation -->

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-menu">
                <ul class="nav navbar-nav navbar-left" data-in="#" data-out="#">
                    {!!topMenu()!!}
                </ul>
            </div><!-- /.navbar-collapse -->
        </div>

    </nav>
    <!-- End Navigation -->

</header>
<!-- End Main Menu -->

