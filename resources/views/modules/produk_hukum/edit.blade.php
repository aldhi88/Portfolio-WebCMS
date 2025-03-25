@extends('components.layout.main',['title' => 'Edit Produk Hukum'])
@section('css')
@endsection
@section('js')
    @include('modules.produk_hukum.include.edit_js')
@endsection

@section('content')

<div class="row">
    <div class="col">
        @include('components.content.page_title',['title' => 'Edit Produk Hukum'])

        <div class="row">
            <div class="col-4">
                <form id="upForm"> @csrf @method('PUT')
                    <input type="hidden" name="id" value="{{$edit['id']}}">
                    <div class="form-group">
                        <label>Nama Produk Hukum</label>
                        <input name="name" type="text" class="form-control" value="{{$edit['name']}}">
                        <div class="invalid-feedback d-block msg name"></div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
                        <a class="btn btn-light" href="{{ route('produk-hukum.index') }}">Kembali</a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection