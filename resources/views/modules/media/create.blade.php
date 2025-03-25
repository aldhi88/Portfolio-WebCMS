@extends('components.layout.main',['title' => 'Unggah Media Baru'])
@section('css')
    <link href="{{asset('assets/libs/dropzone/min/dropzone.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('js')
    <script src="{{asset('assets/libs/dropzone/min/dropzone.min.js')}}"></script>
@endsection

@section('content')

<div class="row">
    <div class="col">
        @include('components.content.page_title',[
            'title' => 'Unggah Media Baru',
            'right' => '<a href="'.route('media.index').'" class="btn btn-outline-primary waves-effect waves-light btn-sm">Pustaka</a>'
        ])

        <div class="row">
            <div class="col">
                
                <div class="card">
                    <div class="card-body">

                        <div>
                            <form action="{{route('media.store')}}" class="dropzone" id="my-awesome-dropzone">@csrf
                                <div class="fallback">
                                    <input name="file" type="file" multiple="multiple">
                                </div>
                                <div class="dz-message needsclick">
                                    <div class="mb-3">
                                        <i class="display-4 text-muted ri-upload-cloud-2-line"></i>
                                    </div>
                                    
                                    <h4>Tarik file kesini atau klik untuk mengungah.</h4>
                                    
                                </div>
                            </form>
                        </div>
                        <p class="mt-2">Maksimum kapasitas file yang diizinkan untuk diunggah adalah: <strong>{{$data['fileSize']}} KB</strong></p>
                    </div>
                </div>
                
            </div>


            
        </div>
    </div>
</div>

@endsection