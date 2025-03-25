@extends('web.layout.main')

@section('content')

<div class="breadcrumb-area shadow dark text-center bg-fixed text-light" style="background-image: url({{asset('web/assets/img/kejati/bg-halaman.jpg')}});">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>{{$data['page']['title']}}</h1>
                {{-- <ul class="breadcrumb">
                    @foreach ($data['page']['post_related_categories'] as $item) 
                    <li><a href="#"><i class="fas fa-tag"></i> {{$item['post_categories']['name']}}</a></li>
                    @endforeach
                </ul> --}}
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumb -->

<div class="blog-area full-blog standard single-blog full-blog default-padding">
    <div class="container">
        <div class="row">
            <div class="blog-items">
                <div class="blog-content col-md-10 col-md-offset-1">
                    <div class="item-box">
                        <div class="item">
                            <div class="thumb">
                                <a href="#"><img class="img-responsive center-block" src="{{asset($data['page']['image'])}}" alt="Thumb"></a>
                                {{-- <div class="date">
                                    <h4><span>{{\Carbon\Carbon::parse($data['page']['created_at'])->format('d')}}</span> {{\Carbon\Carbon::parse($data['page']['created_at'])->format('M, Y')}}</h4>
                                </div> --}}
                            </div>
                            <div class="info">
                                <h3>
                                    {{$data['page']['title']}}
                                </h3>
                                <div class="meta">
                                    <ul>
                                        <li><a href="#"><i class="fas fa-user"></i> {{$data['page']['users']['first_name']}}</a></li>
                                        {{-- <li><a href="#"><i class="fas fa-comments"></i> 5 Komentar</a></li> --}}
                                    </ul>
                                    
                                </div>
                                {!!$data['page']['content']!!}
                            </div>
                            {{-- <div class="post-pagi-area">
                                <a href="#"><i class="fas fa-angle-double-left"></i> Halaman 2</a>
                                <a href="#">Halaman 1 <i class="fas fa-angle-double-right"></i></a>
                            </div> --}}
                            
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Blog -->

@endsection