@extends('components.layout.main',['title' => 'Edit Data Album'])
@section('css')
@include('components.dtable.style')
    <link href="{{asset('assets/libs/dropzone/min/dropzone.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('js')
    @include('components.dtable.script')
    <script src="{{asset('assets/libs/dropzone/min/dropzone.min.js')}}"></script>
    @include('modules.gallery.include.edit_js')
    @include('modules.gallery.include.delete_item_js')
@endsection

@section('content')

<div class="row">
    <div class="col">
        @include('components.content.page_title',[
            'title' => 'Edit Data Album',
            'right' => '
                <a href="'.route('galleries.index').'" class="btn btn-outline-primary waves-effect waves-light btn-sm">Data Album</a>
                <a href="'.route('galleries.create').'" class="btn btn-outline-primary waves-effect waves-light btn-sm">Data Album Baru</a>
            '
        ])

        <div class="row">
            <div class="col">
                <form id="upAlbumName"> @csrf @method('PUT')
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Nama Album</label>
                                    <input type="text" name="name" class="form-control" value="{{$edit['name']}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <button class="btn btn-primary form-control">Ubah Nama Album</button>
                                </div>
                            </div>
                        </div>
                </form>
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('galleries.update',$edit['id'])}}" class="dropzone" id="my-awesome-dropzone">@csrf @method('PUT')
                            <input type="hidden" name="id" value="{{$edit['id']}}">
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

                    <table id="myTable" class="table table-bordered dt-responsive nowrap table-striped" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Gambar</th>
                            </tr>
                        </thead>
                        <thead id="header-filter" class="text-center">
                            <th off></th>
                        </thead>
                        <tbody></tbody>
                    </table>
    
                    </div>
                </div>

                
            </div>
            
        </div>

        
    </div>
</div>

@include('modules.media.delete')

@endsection