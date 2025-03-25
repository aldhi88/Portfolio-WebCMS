@extends('components.layout.main',['title' => 'Buat DPO Baru'])
@section('css')
@endsection
@section('js')
@include('modules.dpo.include.create_js')
@endsection

@section('content')

<div class="row">
    <div class="col">
        @include('components.content.page_title',[
            'title' => 'Buat DPO Baru',
            'right' => '<a href="'.route('dpos.index').'" class="btn btn-outline-primary waves-effect waves-light btn-sm">Semua DPO</a>'
        ])

        <form id="formIn">@csrf
            <input type="hidden" name="category" value="dpo">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <input type="text" name="title" class="form-control form-control-lg" placeholder="Nama DPO">
                        <div class="invalid-feedback d-block msg title"></div>
                    </div>
                    <div class="form-group">
                        <label>Kategori Tindak Kejahatan</label>
                        <input type="text" id="slug" name="summary" class="form-control">
                        <div class="invalid-feedback d-block msg summary"></div>
                    </div>
                    <div class="form-group">
                        <label>Sekilas Tentang</label>
                        <textarea id="summary" name="content" rows="3" class="form-control"></textarea>
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
                            <img id="img-cover" src="{{asset('assets/images/default/no_image.jpg')}}" class="img-fluid hover-click open-file">
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

@include('modules.post.modal_media')
@include('modules.post.modal_media_image')
@endsection