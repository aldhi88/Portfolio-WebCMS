@extends('web.layout.main')
@section('css')
{{-- @include('web.mod.inc.hubungi_css')    --}}
@endsection
@section('js')
{{-- <script src="https://www.google.com/recaptcha/api.js?render=6Lcsh6sfAAAAADAY10ZxgnyxS_Gtm_hXn_Q5Eefh"></script> --}}
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@include('web.mod.inc.hubungi_js')
@endsection
@section('content')

<div class="breadcrumb-area shadow dark text-center bg-fixed text-light" style="background-image: url({{asset('web/assets/img/kejati/bg-hubungi.jpg')}});">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Hubungi Kami</h1>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumb -->

<!-- Start Contact Info
    ============================================= -->
    <div class="contact-info-area default-padding">
        <div class="container">
            <div class="row">
                <!-- Start Contact Info -->
                <div class="contact-info">
                    <div class="col-md-6 col-sm-6">
                        <div class="item">
                            <div class="icon">
                                <i class="fab fa-whatsapp"></i>
                            </div>
                            <div class="info">
                                <h4><a href="https://api.whatsapp.com/send?phone={{ \App\Models\Attribute::getAttr('chat1') }}" target="_blank">Chat Sekarang >></a></h4>
                                <span>Hotline Pelayanan Hukum dan Pengaduan Masyarakat</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="item">
                            <div class="icon">
                                <i class="fab fa-whatsapp"></i>
                            </div>
                            <div class="info">
                                <h4><a href="https://api.whatsapp.com/send?phone={{ \App\Models\Attribute::getAttr('chat2') }}" target="_blank">Chat Sekarang >></a></h4>
                                <span>Hotline Pengaduan Mafia Tanah</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Contact Info -->

                <div class="seperator col-md-12">
                    <span class="border"></span>
                </div>

                <!-- Start Maps & Contact Form -->
                <div class="maps-form">
                    <div class="col-md-6 maps">
                        <h3>Lokasi Kami</h3>
                        <div class="google-maps">
                            <iframe src="{{ env('GOOGLE_MAP') }}" width="600" height="450" style="border:0;" allowfullscreen="" ></iframe>
                        </div>
                    </div>
                    <div class="col-md-6 form">
                        <div class="heading">
                            <h3>Kirim Pesan</h3>
                            <p>Pesan anda akan di respon dalam waktu 2x24 Jam di waktu kerja.</p>
                        </div>
                        <span id="alert-area"></span>
                        <form id="kirimPesan">@csrf
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="form-group">
                                        <input class="form-control" name="name" placeholder="Nama Anda" type="text">
                                        <span class="text-danger name msg"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="form-group">
                                        <input class="form-control" name="email" placeholder="Email*" type="email">
                                        <span class="text-danger email msg"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="form-group" id="phone">
                                        <input class="form-control" name="phone" placeholder="No Handphone" type="text">
                                        <span class="text-danger phone msg"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="form-group">
                                        <textarea class="form-control" name="msg" placeholder="Isi pesan yang ingin disampaikan"></textarea>
                                        <span class="text-danger content msg"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="form-group">
                                        <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12" style="margin-top: 10px;z-index: 9999;">
                                <div class="row">
                                    <button type="submit" class="btn-block">
                                        Kirim Pesan <i class="fa fa-paper-plane"></i>
                                    </button>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>
                <!-- End Maps & Contact Form -->

            </div>
        </div>
    </div>

@endsection