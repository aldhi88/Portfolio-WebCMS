@extends('components.layout.main',['title' => 'Edit Data Halaman'])
@section('css')
@endsection
@section('js')
<script src="{{asset('assets/libs/tinymce/tinymce.min.js')}}"></script>
    @include('modules.page.include.edit_js')
@endsection

@section('content')

<div class="row">
    <div class="col">
        @include('components.content.page_title',[
            'title' => 'Edit Data Halaman',
            'right' => '
                <a href="'.route('pages.index').'" class="btn btn-outline-primary waves-effect waves-light btn-sm">Semua Halaman</a>
                <a href="'.route('pages.create').'" class="btn btn-outline-primary waves-effect waves-light btn-sm">Tambah Halaman Baru</a>
            '
        ])

        <form id="formUp">@csrf @method('PUT')
            <input type="hidden" name="id" value="{{$edit['id']}}">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <input type="text" value="{{$edit['title']}}" name="title" class="form-control form-control-lg" placeholder="Judul Halaman">
                        <div class="invalid-feedback d-block msg title"></div>
                    </div>
                    <div class="form-group">
                        <label>Permalink (slug)</label>
                        <input type="text" value="{{$edit['slug']}}" id="slug" name="slug" class="form-control" placeholder="judul-halaman">
                        <div class="invalid-feedback d-block msg slug"></div>
                    </div>
                    <div class="form-group">
                        <label>Ringkasan/Deskripsi</label>
                        <textarea id="summary" name="summary" rows="3" class="form-control">{{$edit['summary']}}</textarea>
                        <div class="invalid-feedback d-block msg summary"></div>
                    </div>
                    <div class="form-group bg-white p-2">
                        <button type="button" data-toggle="modal" data-target="#modalMedia" class="btn btn-outline-primary btn-sm mb-2"><i class="ri-film-line align-middle mr-2"></i>Ambil Link Media</button>
                        <textarea id="elm1" name="content">{!!$edit['content']!!}</textarea>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="btn-group btn-block" role="group" aria-label="Basic example">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    <div class="card mt-2">
                        <div class="card-header font-wight-bold"><h6 class="my-0">Cover & Thumbnail</h6></div>
                        <div class="card-body">
                            <label>
                                Maksimal: <strong>{{$data['maxSize']}}KB</strong> <br>
                                Jenis: <strong>jpg | png</strong>
                            </label>
                            <img id="img-cover" src="{{asset($edit['image'])}}" class="img-fluid hover-click open-file">
                            <input type="hidden" name="image_media">
                            <input type="file" name="image" onchange="showPreview(this,'img-cover')" style="display: none">
                            <div class="btn-group btn-block" role="group" aria-label="Basic example">
                                <button type="button" class="btn rounded-0 btn-secondary btn-sm" data-toggle="modal" data-target="#modalMediaImage">Dari Media</button>
                                <button type="button" class="btn rounded-0 btn-danger btn-sm open-file">Unggah Baru</button>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>

        </form>

    </div>
</div>
@include('modules.page.modal_media')
@include('modules.page.modal_media_image')
@endsection