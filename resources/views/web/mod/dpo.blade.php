@extends('web.layout.main')
@section('css')
@endsection
@section('js')
@include('web.mod.inc.hubungi_js')
@endsection
@section('content')

<div class="breadcrumb-area shadow dark text-center bg-fixed text-light" style="background-image: url({{asset('web/assets/img/kejati/bg-dpo.jpg')}});">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Daftar Pencarian Orang</h1>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumb -->

<section id="advisor" class="advisor-area default-padding bottom-less">
    <div class="container">
        <div class="row">
            <div class="advisor-items text-center text-light">
                <!-- Single Item -->
                @foreach ($data['dpos'] as $item)
                <div class="col-md-4 col-sm-6 single-item">
                    <div class="advisor-item">
                        <div class="info-box">
                            <img src="{{asset($item['image'])}}" alt="Thumb">  
                            <div class="info-title">
                                <h4>{{ $item['title'] }}</h4>
                                <span>{{ $item['slug'] }}</span>
                            </div>
                        </div>    
                    </div>
                </div> 
                @endforeach
                <!-- Single Item -->
            </div>
        </div>
    </div>
</section>

@endsection