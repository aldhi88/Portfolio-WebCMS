@extends('components.layout.main',['title' => 'Edit Data Spesial Link'])
@section('css')
@endsection
@section('js')
    @include('modules.widget.include.edit_js')
    @include('modules.widget.include.modal_icon_js')
@endsection

@section('content')

<div class="row">
    <div class="col">
        @include('components.content.page_title',[
            'title' => 'Edit Data Spesial Link',
            'right' => '
                <a href="'.route('widgets.index').'" class="btn btn-outline-primary waves-effect waves-light btn-sm">Semua Spesial Link</a>
                <a href="'.route('widgets.create').'" class="btn btn-outline-primary waves-effect waves-light btn-sm">Tambah Spesial Link Baru</a>
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
                        <label>Icon ( <a href="#" data-target="#icon" data-toggle="modal">refrensi</a> )</label>
                        <input type="text" value="{{$edit['slug']}}" id="slug" name="slug" class="form-control" placeholder="Lihat dari refrensi lalu paste disini">
                        <div class="invalid-feedback d-block msg slug"></div>
                    </div>
                    <div class="form-group">
                        <label>Link</label>
                        <div class="input-group">
                            <span class="input-group-btn input-group-prepend">
                                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalPage">Halaman</button>
                            </span>
                            <input id="link" name="summary" class="form-control" type="text" autofocus value="{{$edit['summary']}}">
                            <span class="input-group-btn input-group-append">
                                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalPost">Berita</button>
                            </span>
                        </div>
                        <div class="invalid-feedback d-block msg summary"></div>
                    </div>
                    <div class="form-group">
                        <label>Ringkasan/Deskripsi</label>
                        <textarea name="content" rows="3" class="form-control">{!!$edit['content']!!}</textarea>
                        <div class="invalid-feedback d-block msg content"></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="btn-group btn-block" role="group" aria-label="Basic example">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    <div class="card mt-2">
                        <div class="card-header font-wight-bold"><h6 class="my-0">Urutan</h6></div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Tentukan urutan data ketika tampil</label>
                                <select name="order" class="form-control form-control-sm"></select>
                            </div>
                        </div>
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
@include('modules.widget.modal_icon')

@endsection