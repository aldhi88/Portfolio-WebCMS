@extends('components.layout.main',['title' => 'Edit Nama Media'])
@section('css')
@endsection
@section('js')
    @include('modules.media.include.edit_js')
@endsection

@section('content')

<div class="row">
    <div class="col">
        @include('components.content.page_title',['title' => 'Edit Nama Media'])

        <div class="row">
            <div class="col-4">
                <form id="upForm"> @csrf @method('PUT')
                    <input type="hidden" name="id" value="{{$edit['id']}}">
                    <div class="form-group">
                        <label>Nama Media</label>
                        <div class="input-group">
                            <input name="name" type="text" class="form-control" value="{{pathinfo($edit['name'], PATHINFO_FILENAME)}}">
                            <div class="input-group-append">
                                <span class="input-group-text">{{str_replace(pathinfo($edit['name'], PATHINFO_FILENAME),'',$edit['name'])}}</span>
                                <input type="hidden" name="extension" value="{{str_replace(pathinfo($edit['name'], PATHINFO_FILENAME),'',$edit['name'])}}">
                            </div>
                        </div>
                        <div class="invalid-feedback d-block msg name"></div>
                    </div>
    
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
                        <a class="btn btn-light" href="{{ route('media.index') }}">Kembali</a>
                    </div>
                </form>
            </div>
            <div class="col-4">
                <label>Preview Media</label>
                <img src="{{asset($edit['thumbnail'])}}" class="img-fluid" alt="">
            </div>

        </div>
    </div>
</div>

@endsection