@extends('components.layout.main',['title' => 'Buat Berita Baru'])
@section('css')
@endsection
@section('js')
<script src="{{asset('assets/libs/tinymce/tinymce.min.js')}}"></script>
@include('modules.post.include.create_js')
@endsection

@section('content')

<div class="row">
    <div class="col">
        @include('components.content.page_title',[
            'title' => 'Buat Berita Baru',
            'right' => '<a href="'.route('posts.index').'" class="btn btn-outline-primary waves-effect waves-light btn-sm">Semua Berita</a>'
        ])

        @if (count($data['categories']) == 0)
        <div class="alert alert-warning" role="alert">
            Data kategori berita belum diinput, silahkan klik <a href="{{route('post-categories.index')}}" class="alert-link"><u>disini</u></a> untuk melakukan input.
        </div>
        @else
        <form id="formIn">@csrf
            <input type="hidden" name="is_publish" value="1">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <input type="text" name="title" class="form-control form-control-lg" placeholder="Judul Berita">
                        <div class="invalid-feedback d-block msg title"></div>
                    </div>
                    <div class="form-group">
                        <label>Permalink (slug)</label>
                        <input type="text" id="slug" name="slug" class="form-control" placeholder="judul-berita">
                        <div class="invalid-feedback d-block msg slug"></div>
                    </div>
                    <div class="form-group">
                        <label>Ringkasan/Deskripsi</label>
                        <textarea id="summary" name="summary" rows="3" class="form-control"></textarea>
                        <div class="invalid-feedback d-block msg summary"></div>
                    </div>
                    <div class="form-group bg-white p-2">
                        <button type="button" data-toggle="modal" data-target="#modalMedia" class="btn btn-outline-primary btn-sm mb-2"><i class="ri-film-line align-middle mr-2"></i>Ambil Link Media</button>
                        <textarea id="elm1" name="content"></textarea>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="btn-group btn-block" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-warning submit" act="0">Simpan Draf</button>
                        <button type="button" class="btn btn-primary submit" act="1">Terbitkan</button>
                    </div>
                    <div class="card mt-2">
                        {{-- <div class="card-header font-wight-bold"><h6 class="my-0">Komentar</h6></div> --}}
                        <div class="card-body">
                            <div class="form-group">
                                <label>Apakah berita ini boleh dikomentari oleh pembaca?</label>
                                <select name="allow_comment" class="form-control form-control-sm">
                                    <option value="1">Ya</option>
                                    <option value="0">Tidak</option>
                                </select>
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
                    <div class="card mt-2">
                        <div class="card-header font-wight-bold">
                            <div class="row"><h6 class="my-0">Kategori</h6></div>
                        </div>
                        <div class="card-body">
                            @foreach ($data['categories'] as $item)
                            <div class="form-check mb-1">
                                <input class="form-check-input" name="post_category_id[]" id="cat-{{$item->id}}" type="checkbox" value="{{$item->id}}">
                                <label class="form-check-label" for="cat-{{$item->id}}" style="margin-top: 2px">{{$item->name}}</label>
                            </div>
                            @endforeach
                            
                        </div>
                    </div>
                </div>
            </div>

        </form>
        @endif


    </div>
</div>

@include('modules.post.modal_media')
@include('modules.post.modal_media_image')
@endsection