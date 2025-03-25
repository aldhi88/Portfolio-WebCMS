@extends('components.layout.main',['title' => 'Edit Atribut Produk Hukum'])
@section('css')
@endsection
@section('js')
    @include('modules.produk_hukum_isi.include.edit_js')
@endsection

@section('content')

<div class="row">
    <div class="col">
        @include('components.content.page_title',['title' => 'Edit Atribut Produk Hukum'])

        <div class="row">
            <div class="col-4">
                <form id="upForm"> @csrf @method('PUT')
                    <div class="form-group">
                        <label>Judul/Nomor</label>
                        <input name="name" required type="text" class="form-control" value="{{ $edit['name'] }}">
                        <div class="invalid-feedback d-block msg name"></div>
                    </div>
                    <div class="form-group">
                        <label>Tahun</label>
                        <input name="tahun" required type="number" minlength="4" maxlength="4" value="{{ $edit['tahun'] }}" class="form-control">
                        <div class="invalid-feedback d-block msg tahun"></div>
                    </div>
                    <div class="form-group">
                        <label>Tentang</label>
                        <textarea name="tentang" required rows="10" class="form-control">{{$edit['tentang']}}</textarea>
                        <div class="invalid-feedback d-block msg tentang"></div>
                    </div>
    
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
                        <a class="btn btn-light" href="{{ route('produk-hukum-isi.index') }}">Kembali</a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection