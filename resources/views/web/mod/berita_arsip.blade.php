@extends('web.layout.main')

@section('content')

<div class="breadcrumb-area shadow dark text-center bg-fixed text-light" style="background-image: url({{asset('web/assets/img/kejati/bg-berita.jpg')}});">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Arsip Berita Per Bulan & Tahun</h1>
                <ul class="breadcrumb">
                    <li><a href="#"><i class="fas fa-tag"></i> {{$data['keyword']}}</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumb -->

<!-- Start Blog
    ============================================= -->
    <div class="blog-area full-blog right-sidebar full-blog default-padding">
        <div class="container">
            <div class="row">
                <div class="blog-items">
                    <div class="blog-content col-md-8">
                        @foreach ($data['news'] as $item)
                        <div class="single-item">
                            <div class="item">
                                <div class="thumb">
                                    <a href="{{env('APP_URL')}}/berita/{{$item['slug']}}"><img src="{{asset($item['image'])}}" alt="Thumb"></a>
                                    <div class="date">
                                        <h4><span>{{\Carbon\Carbon::parse($item['created_at'])->format('d')}}</span> {{\Carbon\Carbon::parse($item['created_at'])->format('M, Y')}}</h4>
                                    </div>
                                </div>
                                <div class="info">
                                    <h3>
                                        <a href="{{env('APP_URL')}}/berita/{{$item['slug']}}">{{$item['title']}}</a>
                                    </h3>
                                    <p>
                                        {{asset($item['summary'])}}
                                    </p>
                                    <a href="{{env('APP_URL')}}/berita/{{$item['slug']}}">Baca Selanjutnya <i class="fas fa-angle-double-right"></i></a>
                                    <div class="meta">
                                        <ul>
                                            <li>
                                                <a href="#"><i class="fas fa-user"></i> {{$item['users']['first_name']}}</a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="fas fa-comments"></i> {{ count($item['comments']) }} Komentar</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        
                        <!-- Pagination -->

                        <div class="row">
                            <div class="col-md-12 pagi-area">
                                {{ $data['news']->onEachSide(7)->links('vendor.pagination.custom') }}
                            </div>
                        </div>
                    </div>
                    <!-- Start Sidebar -->
                    @include('web.layout.berita_sidebar')
                    <!-- End Start Sidebar -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Blog -->

@endsection