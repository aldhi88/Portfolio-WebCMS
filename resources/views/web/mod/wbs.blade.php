@extends('web.layout.main')
@section('css')
{{-- @include('web.mod.inc.hubungi_css')    --}}
@endsection
@section('js')
{{-- <script src="https://www.google.com/recaptcha/api.js?render=6Lcsh6sfAAAAADAY10ZxgnyxS_Gtm_hXn_Q5Eefh"></script> --}}
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@include('web.mod.inc.wbs_js')
@endsection
@section('content')

<div class="breadcrumb-area shadow dark text-center bg-fixed text-light" style="background-image: url({{asset('web/assets/img/kejati/bg-hubungi.jpg')}});">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Whistle Blowing System Kejati Sumut (WBS)</h1>
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
                <div class="col">
                    <p>
                        <em>Whistle Blowing System (WBS)</em> pada website ini merupakan layanan bagi Pegawai Kejaksaan Tinggi Sumatera Utara (Whistleblower) untuk melaporkan dugaan pelanggaran perilaku maupun pelanggaran hukum di lingkungan Kejaksaan Tinggi Sumatera Utara.<br> 
                    </p>
                    <ol>
                        Unit Perlindungan Pelapor (UPP) akan melakukan penanganan terhadap setiap laporan yang masuk dan memberikan perlindungan bagi Pelapor (Whistleblower) dalam bentuk :
                        <li style="margin-left: 15px;">Merahasiakan dan menyamarkan identitas Pelapor</li>
                        <li style="margin-left: 15px;">Perlindungan dari perlakuan diskrimtinatif</li>
                        <li style="margin-left: 15px;">Perlindungan atas catatan yang merugikan dalam arsip data kepegawaian.</li>
                        <li style="margin-left: 15px;">Perlindungan terhadap ancaman fisik dan/atau psikis.</li>
                        <li style="margin-left: 15px;">Perlindungan terhadap harta, dan/atau</li>
                        <li style="margin-left: 15px;">Pemberian keterangan tanpa bertatap muka degan terlapor.</li>
                    </ol>
                </div>
                <div class="seperator col-md-12">
                    <span class="border"></span>
                </div>

                <!-- Start Maps & Contact Form -->
                <div class="maps-form">
                    <div class="heading">
                        <h3>Form Whistle Blowing System</h3>
                        <p>Laporan anda akan terkirim langsung ke bagian PENGAWASAN.</p>
                    </div>
                    <span id="alert-area"></span>
                    <form id="kirimWbs">@csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Nama *</strong></label>
                                    <input class="form-control" name="nama" type="text">
                                    <span class="text-danger nama msg"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Alamat *</strong></label>
                                    <input class="form-control" name="alamat" type="text">
                                    <span class="text-danger alamat msg"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><strong>Email *</strong></label>
                                    <input class="form-control" name="email" type="email">
                                    <span class="text-danger email msg"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><strong>No. Telepon *</strong></label>
                                    <input class="form-control" name="hp" type="text">
                                    <span class="text-danger hp msg"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><strong>Unggah KTP (.jpg/.png, Maks.512KB) *</strong></label>
                                    <input class="form-control" name="ktp" type="file">
                                    <span class="text-danger ktp msg"></span>
                                </div>
                            </div>
                            
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label><strong>Isi Pengaduan *</strong></label>
                                    <textarea class="form-control" name="aduan" placeholder="Isi pengaduan anda"></textarea>
                                    <span class="text-danger aduan msg"></span>
                                </div>
                            </div>

                            <div class="col-md-4" style="padding-top: 20px">
                                <div class="form-group pull-right">
                                    <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
                                </div>
                            </div>

                            <div class="col-md-12" style="margin-top: 10px;z-index: 9999;">
                                <button type="submit" class="btn-block">
                                    Kirim <i class="fa fa-paper-plane"></i>
                                </button>
                            </div>

                        </div>
                        
                    </form>
                </div>
                <!-- End Maps & Contact Form -->

            </div>
        </div>
    </div>

@endsection