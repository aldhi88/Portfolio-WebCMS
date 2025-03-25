@extends('components.layout.main',['title' => 'Buat Album Baru'])
@section('css')
    <link href="{{asset('assets/libs/dropzone/min/dropzone.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('js')
    <script src="{{asset('assets/libs/dropzone/min/dropzone.min.js')}}"></script>
    @include('modules.gallery.include.create_js')
@endsection

@section('content')

<div class="row">
    <div class="col">
        @include('components.content.page_title',[
            'title' => 'Buat Album Baru',
            'right' => '<a href="'.route('galleries.index').'" class="btn btn-outline-primary waves-effect waves-light btn-sm">Data Album</a>'
        ])

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>Nama Album</label>
                    <input type="text" name="bind_name" class="form-control" value="Album_{{date('YmdHis')}}_{{explode(" ",microtime())[1]}}">
                </div>
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('galleries.store')}}" class="dropzone" id="my-awesome-dropzone">@csrf
                            <input type="hidden" name="name">
                            <div class="fallback">
                                <input name="file[]" type="file" multiple="multiple">
                            </div>
                            <div class="dz-message needsclick">
                                <div class="mb-3">
                                    <i class="display-4 text-muted ri-upload-cloud-2-line"></i>
                                </div>
                                <h4>Tarik file kesini atau klik untuk mengungah.</h4>
                            </div>
                        </form>
                    <p class="mt-2">Maksimum kapasitas file yang diizinkan untuk diunggah adalah: <strong>{{$data['fileSize']}} KB</strong></p>
                    </div>
                </div>
                
            </div>


            
        </div>
    </div>
</div>

@endsection