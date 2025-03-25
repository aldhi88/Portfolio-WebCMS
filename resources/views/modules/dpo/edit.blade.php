@extends('components.layout.main',['title' => 'Edit Data DPO'])
@section('css')
@endsection
@section('js')
    @include('modules.dpo.include.edit_js')
@endsection

@section('content')

<div class="row">
    <div class="col">
        @include('components.content.page_title',[
            'title' => 'Edit Data DPO',
            'right' => '
                <a href="'.route('dpos.index').'" class="btn btn-outline-primary waves-effect waves-light btn-sm">Semua DPO</a>
                <a href="'.route('dpos.create').'" class="btn btn-outline-primary waves-effect waves-light btn-sm">Tambah DPO Baru</a>
            '
        ])

        <form id="formUp">@csrf @method('PUT')
            <input type="hidden" name="slug" value="{{$edit['slug']}}">
            <input type="hidden" name="id" value="{{$edit['id']}}">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <input type="text" value="{{$edit['title']}}" name="title" class="form-control form-control-lg" placeholder="Nama Asisten">
                        <div class="invalid-feedback d-block msg title"></div>
                    </div>
                    <div class="form-group">
                        <label>Kategori Tindak Kejahatan</label>
                        <input type="text" value="{{$edit['summary']}}" id="slug" name="summary" class="form-control" placeholder="Jabatan asisten">
                        <div class="invalid-feedback d-block msg summary"></div>
                    </div>
                    <div class="form-group">
                        <label>Ringkasan/Deskripsi</label>
                        <textarea id="summary" name="content" rows="3" class="form-control">{{$edit['content']}}</textarea>
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
@endsection