@extends('web.layout.main')
@section('css')
<link href="{{asset('web/assets/css/owl.carousel.min.css')}}" rel="stylesheet" />
<link href="{{asset('web/assets/css/owl.theme.default.min.css')}}" rel="stylesheet" />
<link href="{{asset('web/assets/css/magnific-popup.css')}}" rel="stylesheet" />
@endsection
@section('js')
<script src="{{asset('web/assets/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('web/assets/js/jquery.magnific-popup.min.js')}}"></script>
@include('web.mod.inc.beranda_js')
@endsection

@section('content')
<style>
    .social-card {
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 20px;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.social-title {
    font-weight: bold;
    margin-bottom: 10px;
}

.item iframe,
.item blockquote {
    width: 100%;
    height: 500px; 
    max-height: 500px;
}

@media (max-width: 768px) {
    .item iframe,
    .item blockquote {
        height: 720px;
        width: 100%;
        max-height: 750px;
    }
}


.blog-area .single-item .thumb {
    position: relative;
    width: 100%;
    overflow: hidden;
    padding-bottom: 125%;
    background-color: #f5f5f5; 
}

.blog-area .single-item .thumb img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover; 
}

.blog-area .single-item .info p {
    display: -webkit-box;
    -webkit-line-clamp: 4; 
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    text-align: justify;
}

.blog-area .single-item .info h4 {
    display: -webkit-box;
    -webkit-line-clamp: 3; 
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    margin-bottom: 10px; 
}

/* Aturan untuk mobile */
@media (max-width: 768px) {
    .blog-area .single-item .info p,
    .blog-area .single-item .info h4 {
        display: block;  /
        text-align: justify;
        margin-bottom: 10px;
        max-height: none; 
    }

}
</style>

<!-- Start Banner 
============================================= -->
<div class="banner-area content-top-heading less-paragraph text-normal">
    <div id="bootcarousel" class="carousel slide animate_text carousel-fade" data-ride="carousel">
        <div class="carousel-inner text-light carousel-zoom">
            @foreach ($data['mainSlider'] as $key => $item)
                <div class="item {{$key==0?'active':null}}">
                    <div class="slider-thumb bg-fixed" style="background-image: url({{asset($item['image'])}});"></div>
                    <div class="box-table shadow dark">
                        <div class="box-cell">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="content">
                                            {!! $item['content'] !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Left and right controls -->
        <a class="left carousel-control" href="#bootcarousel" data-slide="prev">
            <i class="fa fa-angle-left"></i>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#bootcarousel" data-slide="next">
            <i class="fa fa-angle-right"></i>
            <span class="sr-only">Next</span>
        </a>

    </div>
</div>
<!-- End Banner -->


<!-- Spesial Link
============================================= -->
<div class="top-cat-area default-padding" style="margin-left: 15px;">
    <div class="container">
        <div class="row">
            <div class="col top-cat-items text-light inc-bg-color text-center">
                <div class="row">
                    @foreach ($data['spesialLink'] as $item)
                    <div class="col-md-3 col-sm-3 equal-height">
                        <div class="item malachite" style="background-image: url({{asset($item['image'])}});">
                            <a href="{{$item['summary']}}">
                                <i class="{{$item['slug']}}"></i>
                                <div class="info">
                                    <h4>{{$item['title']}}</h4>
                                    <span>{{$item['content']}}</span>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                    

                </div>
            </div> 
            <!-- End Top Category -->

        </div>
    </div>
</div>
<!-- Spesial Link -->

<!-- Sambutan
============================================= -->
<div class="about-area default-padding bg-gray">
    <div class="container">
        <div class="row">
            <div class="about-info">
                @if (!is_null($data['ketua']))
                <div class="col-md-5 thumb">
                    <img src="{{asset($data['ketua']['image'])}}" alt="Thumb">
                </div>
                <div class="col-md-7 info">
                    <h5>Kepala Kejaksaan Tinggi Sumut</h5>
                    
                    <h2>{{$data['ketua']['title']}}</h2>
                    <p style="text-align:justify">
                        {{$data['ketua']['summary']}}
                    </p>
                    <a href="{{env('APP_URL')}}/halaman/{{$data['ketua']['slug']}}" class="btn btn-dark border btn-md">Baca Selengkapnya</a>
                    
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- End About -->

<!-- Staf
============================================= -->
<section id="advisor" class="advisor-area circle default-padding">
    <div class="container">
        <div class="row">
            <div class="site-heading text-center mb-0">
                <div class="col-md-8 col-md-offset-2">
                    <h2>Pejabat Struktural</h2>
                    {{-- <p>
                        Able an hope of body. Any nay shyness article matters own removal nothing his forming. Gay own additions education satisfied the perpetual. If he cause manor happy. Without farther she exposed saw man led. Along on happy could cease green oh. 
                    </p> --}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="advisor-carousel owl-carousel owl-theme text-center text-light">
                    @foreach ($data['teams'] as $item)
                    <!-- Single Item -->
                    <div class="advisor-item">
                        <div class="info-box">
                            <img src="{{asset($item['image'])}}" alt="Thumb">  
                            <div class="info-title">
                                <h4>{{$item['title']}}</h4>
                                <span>{{$item['slug']}}</span>
                            </div>
                            <div class="overlay">
                                <div class="box">
                                    <div class="content">
                                        <div class="overlay-content">
                                            <h4>Tentang<br>{{$item['title']}}</h4>
                                            <p>
                                                {{$item['summary']}}
                                            </p>
                                            {{-- <a href="#">Read More</a> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>  
                        </div>    
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>
<!--End staf -->



<!-- Start Video Area
============================================= -->
<div class="video-area padding-xl text-center bg-fixed text-light shadow dark-hard" style="background-image: url(web/assets/img/kejati/bg-video.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="video-heading">
                    <h2>Video Tentang Kami</h2>
                    <p>
                        Dokumentasi video kegiatan terbaru dari Kejaksaan Tinggi Sumatera Utara
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="video-info">
                <div class="overlay-video">
                    <a class="popup-youtube video-play-button" href="{{ $data['video'] }}">
                        <i class="fa fa-play"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Video Area -->

<!-- Berita Terbaru 
============================================= -->
<div id="blog" class="blog-area default-padding bg-gray">
    <div class="container">
        <div class="row">
            <div class="site-heading text-center">
                <div class="col-md-8 col-md-offset-2">
                    <h2>Berita Terbaru</h2>
                    {{-- <p>
                        Able an hope of body. Any nay shyness article matters own removal nothing his forming. Gay own additions education satisfied the perpetual. If he cause manor happy. Without farther she exposed saw man led. Along on happy could cease green oh. 
                    </p> --}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="blog-items">
                @foreach ($data['newsUpdate'] as $item)
                <!-- Single Item -->
                <div class="col-md-4 single-item">
                    <div class="item">
                        <div class="thumb" style="max-height: 250px">
                            <a href="{{env('APP_URL')}}/berita/{{$item['slug']}}"><img src="{{asset($item['image'])}}" class="img-fluid" alt="Thumb"></a>
                            <div class="date">
                                <h4><span>{{\Carbon\Carbon::parse($item['created_at'])->format('d')}}</span> {{\Carbon\Carbon::parse($item['created_at'])->format('M')}}, {{\Carbon\Carbon::parse($item['created_at'])->format('Y')}}</h4>
                            </div>
                        </div>
                        <div class="info">
                            <h4 style="min-height: 85px;max-height: 85px">
                                <a href="{{env('APP_URL')}}/berita/{{$item['slug']}}">{{$item['title']}}</a>
                            </h4>
                            <p style="min-height: 130px; max-height: 130px">
                                {{$item['summary']}}
                            </p>
                            <a href="{{env('APP_URL')}}/berita/{{$item['slug']}}">Baca selanjutnya <i class="fas fa-angle-double-right"></i></a>
                            <div class="meta">
                                <ul>
                                    <li><a href="#"><i class="fas fa-calendar-alt"></i> {{\Carbon\Carbon::parse($item['created_at'])->format('d M Y')}}</a></li>
                                    <li><a href="#"><i class="fas fa-user"></i> {{$item['users']['first_name']}}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                
                
            </div>
        </div>
    </div>
</div>
<!-- End Berita Terbaru -->

<!-- Berita Populer
============================================= -->
<section id="event" class="event-area default-padding">
    <div class="container">
        <div class="row">
            <div class="site-heading text-center">
                <div class="col-md-8 col-md-offset-2">
                    <h2>Berita Populer</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="event-items" style="text-align: justify;">
               
                @foreach ($data['newsFavorite'] as $key=>$item)
                        <div class="item horizontal col-md-12">
                            <div class="col-md-6 thumb bg-cover" style="background-image: url({{asset($item['image'])}});">
                                <div class="date">
                                    <h4><span>{{\Carbon\Carbon::parse($item['created_at'])->format('d')}}</span> {{\Carbon\Carbon::parse($item['created_at'])->format('M, Y')}}</h4>
                                </div>
                            </div>
                            <div class="col-md-6 info">
                                <h4>
                                    <a href="{{env('APP_URL')}}/berita/{{$item['slug']}}">{{$item['title']}}</a>
                                </h4>
                                <div class="meta">
                                    <ul>
                                        <li><i class="fas fa-calendar-alt"></i> {{\Carbon\Carbon::parse($item['created_at'])->format('d M, Y')}}</li>
                                        <li><i class="fas fa-user"></i>  {{$item['users']['first_name']}}</li>
                                        {{-- <li><i class="fas fa-comments"></i> 23 Komentar </li> --}}
                                    </ul>
                                </div>
                                <p>{{$item['summary']}}</p>
                                <a href="{{env('APP_URL')}}/berita/{{$item['slug']}}" class="btn btn-dark effect btn-sm">
                                    <i class="fas fa-chart-bar"></i> Baca selengkapnya
                                </a>
                            </div>
                        </div>
            
                @endforeach
                
                <div class="more-btn col-md-12 text-center">
                    <a href="{{env('APP_URL')}}/berita" class="btn btn-dark border btn-md">Lihat Semua Berita</a>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- End Event -->

<!-- DPO
============================================= -->
<section id="advisor" class="advisor-area circle default-padding bg-gray">
    <div class="container">
        <div class="row">
            <div class="site-heading text-center mb-0">
                <div class="col-md-8 col-md-offset-2">
                    <h2>Daftar Pencarian Orang (DPO)</h2>
                    {{-- <p>
                        Able an hope of body. Any nay shyness article matters own removal nothing his forming. Gay own additions education satisfied the perpetual. If he cause manor happy. Without farther she exposed saw man led. Along on happy could cease green oh. 
                    </p> --}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="advisor-carousel owl-carousel owl-theme text-center text-light">
                    @foreach ($data['dpos'] as $item)
                    <!-- Single Item -->
                    <div class="advisor-item">
                        <div class="info-box">
                            <img src="{{asset($item['image'])}}" alt="Thumb">  
                            <div class="info-title">
                                <h4>{{$item['title']}}</h4>
                                <span>{{$item['summary']}}</span>
                            </div>
                            <div class="overlay">
                                <div class="box">
                                    <div class="content">
                                        <div class="overlay-content">
                                            <h4>Tentang<br>{{$item['title']}}</h4>
                                            <p>
                                                {!! $item['content'] !!}
                                            </p>
                                            {{-- <a href="#">Read More</a> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>  
                        </div>    
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>
<!--End staf -->

<!-- Sesi Sosial Media -->
<div id="social-media" class="social-media-area default-padding">
    <div class="container">
        <div class="row">
            <div class="site-heading text-center">
                <div class="col-md-8 col-md-offset-2">
                    <h2>Sosial Media</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="social-items d-flex justify-content-center">
                <!-- Instagram -->
                <div class="col-md-4 col-sm-6 col-xs-12 single-item">
                    <div class="social-card">
                        <h4 class="social-title text-center">Instagram</h4>
                        <div class="item">
                            <blockquote class="instagram-media" data-instgrm-permalink="https://www.instagram.com/p/DFKpvpiyEZr/?utm_source=ig_embed&amp;utm_campaign=loading" data-instgrm-version="14" style=" background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:540px; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);"><div style="padding:16px;"> <a href="https://www.instagram.com/p/DFKpvpiyEZr/?utm_source=ig_embed&amp;utm_campaign=loading" style=" background:#FFFFFF; line-height:0; padding:0 0; text-align:center; text-decoration:none; width:100%;" target="_blank"> <div style=" display: flex; flex-direction: row; align-items: center;"> <div style="background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 40px; margin-right: 14px; width: 40px;"></div> <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center;"> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 100px;"></div> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 60px;"></div></div></div><div style="padding: 19% 0;"></div> <div style="display:block; height:50px; margin:0 auto 12px; width:50px;"><svg width="50px" height="50px" viewBox="0 0 60 60" version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g transform="translate(-511.000000, -20.000000)" fill="#000000"><g><path d="M556.869,30.41 C554.814,30.41 553.148,32.076 553.148,34.131 C553.148,36.186 554.814,37.852 556.869,37.852 C558.924,37.852 560.59,36.186 560.59,34.131 C560.59,32.076 558.924,30.41 556.869,30.41 M541,60.657 C535.114,60.657 530.342,55.887 530.342,50 C530.342,44.114 535.114,39.342 541,39.342 C546.887,39.342 551.658,44.114 551.658,50 C551.658,55.887 546.887,60.657 541,60.657 M541,33.886 C532.1,33.886 524.886,41.1 524.886,50 C524.886,58.899 532.1,66.113 541,66.113 C549.9,66.113 557.115,58.899 557.115,50 C557.115,41.1 549.9,33.886 541,33.886 M565.378,62.101 C565.244,65.022 564.756,66.606 564.346,67.663 C563.803,69.06 563.154,70.057 562.106,71.106 C561.058,72.155 560.06,72.803 558.662,73.347 C557.607,73.757 556.021,74.244 553.102,74.378 C549.944,74.521 548.997,74.552 541,74.552 C533.003,74.552 532.056,74.521 528.898,74.378 C525.979,74.244 524.393,73.757 523.338,73.347 C521.94,72.803 520.942,72.155 519.894,71.106 C518.846,70.057 518.197,69.06 517.654,67.663 C517.244,66.606 516.755,65.022 516.623,62.101 C516.479,58.943 516.448,57.996 516.448,50 C516.448,42.003 516.479,41.056 516.623,37.899 C516.755,34.978 517.244,33.391 517.654,32.338 C518.197,30.938 518.846,29.942 519.894,28.894 C520.942,27.846 521.94,27.196 523.338,26.654 C524.393,26.244 525.979,25.756 528.898,25.623 C532.057,25.479 533.004,25.448 541,25.448 C548.997,25.448 549.943,25.479 553.102,25.623 C556.021,25.756 557.607,26.244 558.662,26.654 C560.06,27.196 561.058,27.846 562.106,28.894 C563.154,29.942 563.803,30.938 564.346,32.338 C564.756,33.391 565.244,34.978 565.378,37.899 C565.522,41.056 565.552,42.003 565.552,50 C565.552,57.996 565.522,58.943 565.378,62.101 M570.82,37.631 C570.674,34.438 570.167,32.258 569.425,30.349 C568.659,28.377 567.633,26.702 565.965,25.035 C564.297,23.368 562.623,22.342 560.652,21.575 C558.743,20.834 556.562,20.326 553.369,20.18 C550.169,20.033 549.148,20 541,20 C532.853,20 531.831,20.033 528.631,20.18 C525.438,20.326 523.257,20.834 521.349,21.575 C519.376,22.342 517.703,23.368 516.035,25.035 C514.368,26.702 513.342,28.377 512.574,30.349 C511.834,32.258 511.326,34.438 511.181,37.631 C511.035,40.831 511,41.851 511,50 C511,58.147 511.035,59.17 511.181,62.369 C511.326,65.562 511.834,67.743 512.574,69.651 C513.342,71.625 514.368,73.296 516.035,74.965 C517.703,76.634 519.376,77.658 521.349,78.425 C523.257,79.167 525.438,79.673 528.631,79.82 C531.831,79.965 532.853,80.001 541,80.001 C549.148,80.001 550.169,79.965 553.369,79.82 C556.562,79.673 558.743,79.167 560.652,78.425 C562.623,77.658 564.297,76.634 565.965,74.965 C567.633,73.296 568.659,71.625 569.425,69.651 C570.167,67.743 570.674,65.562 570.82,62.369 C570.966,59.17 571,58.147 571,50 C571,41.851 570.966,40.831 570.82,37.631"></path></g></g></g></svg></div><div style="padding-top: 8px;"> <div style=" color:#3897f0; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:550; line-height:18px;">View this post on Instagram</div></div><div style="padding: 12.5% 0;"></div> <div style="display: flex; flex-direction: row; margin-bottom: 14px; align-items: center;"><div> <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(0px) translateY(7px);"></div> <div style="background-color: #F4F4F4; height: 12.5px; transform: rotate(-45deg) translateX(3px) translateY(1px); width: 12.5px; flex-grow: 0; margin-right: 14px; margin-left: 2px;"></div> <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(9px) translateY(-18px);"></div></div><div style="margin-left: 8px;"> <div style=" background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 20px; width: 20px;"></div> <div style=" width: 0; height: 0; border-top: 2px solid transparent; border-left: 6px solid #f4f4f4; border-bottom: 2px solid transparent; transform: translateX(16px) translateY(-4px) rotate(30deg)"></div></div><div style="margin-left: auto;"> <div style=" width: 0px; border-top: 8px solid #F4F4F4; border-right: 8px solid transparent; transform: translateY(16px);"></div> <div style=" background-color: #F4F4F4; flex-grow: 0; height: 12px; width: 16px; transform: translateY(-4px);"></div> <div style=" width: 0; height: 0; border-top: 8px solid #F4F4F4; border-left: 8px solid transparent; transform: translateY(-4px) translateX(8px);"></div></div></div> <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center; margin-bottom: 24px;"> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 224px;"></div> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 144px;"></div></div></a><p style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;"><a href="https://www.instagram.com/p/DFKpvpiyEZr/?utm_source=ig_embed&amp;utm_campaign=loading" style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none;" target="_blank">A post shared by Kejaksaan Tinggi Sumatera Utara (@kejatisumut)</a></p></div></blockquote>
                            <script async src="//www.instagram.com/embed.js"></script>
                        </div>
                    </div>
                </div>

                <!-- X -->
                <div class="col-md-4 col-sm-6 col-xs-12 single-item">
                    <div class="social-card">
                        <h4 class="social-title text-center">X</h4>
                        <div class="item">
                            <blockquote class="twitter-tweet"><p lang="in" dir="ltr">Jaksa Agung Muda Pengawasan Kejaksaan RI Inspeksi Pimpinan di Kejati Sumut,Tegaskan Pentingnya Akuntabilitas, Kapabilitas dan Integritas Aparatur Kejaksaan. <a href="https://t.co/326w1H07UW">pic.twitter.com/326w1H07UW</a></p>&mdash; KEJAKSAAN TINGGI SUMATERA UTARA (@humaskejatisu) <a href="https://twitter.com/humaskejatisu/status/1892025657149837454?ref_src=twsrc%5Etfw">February 19, 2025</a></blockquote> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                            </blockquote>
                            <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                        </div>
                    </div>
                </div>

                <!-- YouTube -->
                <div class="col-md-4 col-sm-6 col-xs-12 single-item">
                    <div class="social-card">
                        <h4 class="social-title text-center">YouTube</h4>
                        <div class="item">
                            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/T4dIMV8VE4A?si=dDsSpa-wudn-v3Hs" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Sesi Sosial Media -->

<!-- Galeri Photo
============================================= -->
<div id="portfolio" class="portfolio-area default-padding bg-gray">
    <div class="container">
        <div class="row">
            <div class="site-heading text-center" style="margin-bottom: 0px;">
                <div class="col-md-8 col-md-offset-2">
                    <h2>Galeri Photo</h2>
                </div>
            </div>
        </div>
        @if (!is_null($data['album']))
            <h4 style="text-align: center">{{$data['album']['name']}}</h4>
            <div class="portfolio-items-area text-center">
                <div class="row">
                    <div class="col-md-12 portfolio-content">
                        <!-- End Mixitup Nav-->

                        <div class="row magnific-mix-gallery masonary text-light">
                            <div id="portfolio-grid" class="portfolio-items col-4">

                                
                                @foreach ($data['album']['gallery_related_items'] as $key=>$item)
                                @if ($key<8)
                                <div class="pf-item">
                                    <div class="item-effect">
                                        <img src="{{asset($item['path'])}}" alt="thumb" />
                                        <div class="overlay">
                                            <a href="{{asset($item['path'])}}" class="item popup-link"><i class="fa fa-expand"></i></a>
                                            <a href="#"><i class="fas fa-link"></i></a>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach

                                
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
<!-- End Galeri Photo -->




@endsection