@extends('web.layout.main')
@section('js')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@include('web.mod.inc.berita_js')
@endsection
@section('meta_tags')
    <meta property="og:title" content="{{ $data['news']['title'] }}" />
    <meta property="og:description" content="{{ strip_tags($data['news']['content']) }}" />
    <meta property="og:image" content="{{ url($data['news']['image']) }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="article" />
    <meta property="og:site_name" content="Kejati Sumut" />
@endsection

@section('content')

<div class="breadcrumb-area shadow dark text-center bg-fixed text-light" style="background-image: url({{asset('web/assets/img/kejati/bg-baca-berita.jpg')}});">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>{{$data['news']['title']}}</h1>
                <ul class="breadcrumb">
                    <li>
                    @foreach ($data['news']['post_related_categories'] as $item) 
                    <a href="#"><i class="fas fa-tag"></i>{{$item['post_categories']['name']}}</a>
                    @endforeach
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumb -->

<div class="blog-area full-blog right-sidebar full-blog default-padding">
    <div class="container">
        <div class="row">
            <div class="blog-items">
                <div class="blog-content col-md-8">
                    <div class="item-box">
                        <div class="item">
                            <div class="thumb">
                                <a href="#"><img src="{{asset($data['news']['image'])}}" alt="Thumb"></a>
                                <div class="date">
                                    <h4><span>{{\Carbon\Carbon::parse($data['news']['created_at'])->format('d')}}</span> {{\Carbon\Carbon::parse($data['news']['created_at'])->format('M, Y')}}</h4>
                                </div>
                            </div>
                            <div class="info">
                                <h3>
                                    {{$data['news']['title']}}
                                </h3>
                                <div class="meta">
                                    <ul>
                                        <li><a href="#"><i class="fas fa-user"></i> {{$data['news']['users']['first_name']}}</a></li>
                                        <li><a href="#"><i class="fas fa-comments"></i> {{ count($data['news']['comments']) }} Komentar</a></li>
                                    </ul>
                                </div>
                                {!!$data['news']['content']!!}
                            </div>
                            <div class="post-pagi-area">
                                <div class="row">
                                    @if (!is_null($data['prev']))
                                        <div class="col-md-6"><a href="{{ env('APP_URL')}}/berita/{{ $data['prev'] }}"><i class="fas fa-angle-double-left"></i> Berita Sebelumnya</a></div>
                                    @endif
                                    @if (!is_null($data['next']))
                                        <div class="col-md-6 text-right"><a href="{{ env('APP_URL')}}/berita/{{ $data['next'] }}">Berita Selanjutnya <i class="fas fa-angle-double-right"></i></a></div>
                                    @endif
                                </div>
                            </div>
                            
                            @if ($data['news']['allow_comment']==1)
                            <div class="comments-area">
                                <div class="comments-title">
                                    <h4>
                                        {{ count($data['news']['comments']) }} komentar
                                    </h4>
                                    <div class="comments-list">
                                        @if (count($data['news']['comments'])!=0)
                                        @foreach ($data['news']['comments'] as $item)
                                        <div class="commen-item">
                                            <div class="content">
                                                <h5>{{ $item['name'] }}</h5>
                                                <div class="comments-info">
                                                    {{ \Carbon\Carbon::parse($item['created_at'])->format('d/m/Y') }}
                                                </div>
                                                <p>
                                                    {{ $item['content'] }}
                                                </p>
                                            </div>
                                        </div>
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="comments-form">
                                    <div class="title">
                                    </div>
                                    <span id="alert-area"></span>
                                    <form id="komentar">@csrf
                                        <input type="hidden" name="post_id" value="{{ $data['news']['id'] }}">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <!-- Name -->
                                                    <input name="name" class="form-control" placeholder="Nama *" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <!-- Email -->
                                                    <input name="contact" class="form-control" placeholder="Email/Telepon *" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group comments">
                                                    <!-- Comment -->
                                                    <textarea name="content" class="form-control" placeholder="Komentar/Saran"></textarea>
                                                </div>
                                                <div class="form-group pull-right">
                                                    <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
                                                </div>
                                                <div class="form-group full-width submit">
                                                    <button type="submit">Kirim Komentar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endif
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