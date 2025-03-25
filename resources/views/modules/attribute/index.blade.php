@extends('components.layout.main',['title' => 'Atribute Web'])
@section('css')
@endsection
@section('js')
    @include('modules.attribute.include.index_js')
@endsection

@section('content')

<div class="row">
    <div class="col">
        @include('components.content.page_title',['title' => 'Atribute Web'])

        <div class="row">
            <div class="col">
                {{-- <h6>Tambahkan data baru</h6> --}}
                <form id="inForm"> @csrf
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Alamat</label>
                        <div class="col-md-5">
                            <textarea name="address" class="form-control" rows="5">{{$data['attrs'][0]['value']}}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Google Map</label>
                        <div class="col-md-5">
                            <input name="location" class="form-control" type="text" value="{{$data['attrs'][1]['value']}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Alamat Email</label>
                        <div class="col-md-5">
                            <input name="email" class="form-control" type="text" value="{{$data['attrs'][2]['value']}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Telepon</label>
                        <div class="col-md-5">
                            <input name="phone" class="form-control" type="text" value="{{$data['attrs'][3]['value']}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Link Video</label>
                        <div class="col-md-5">
                            <input name="video" class="form-control" type="text" value="{{$data['attrs'][4]['value']}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Instagram</label>
                        <div class="col-md-5">
                            <input name="instagram" class="form-control" type="text" value="{{$data['attrs'][5]['value']}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Facebook</label>
                        <div class="col-md-5">
                            <input name="facebook" class="form-control" type="text" value="{{$data['attrs'][6]['value']}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Kanal Youtube</label>
                        <div class="col-md-5">
                            <input name="youtube" class="form-control" type="text" value="{{$data['attrs'][7]['value']}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Twitter</label>
                        <div class="col-md-5">
                            <input name="twitter" class="form-control" type="text" value="{{$data['attrs'][14]['value']}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Whatsapp 1</label>
                        <div class="col-md-5">
                            <input name="chat1" class="form-control" type="text" value="{{$data['attrs'][8]['value']}}">
                            <span class="text-danger"><small>Harus angka 62 didepan tidak boleh 0</small></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Whatsapp 2</label>
                        <div class="col-md-5">
                            <input name="chat2" class="form-control" type="text" value="{{$data['attrs'][9]['value']}}">
                            <span class="text-danger"><small>Harus angka 62 didepan tidak boleh 0</small></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Whatsapp 3</label>
                        <div class="col-md-5">
                            <input name="chat3" class="form-control" type="text" value="{{$data['attrs'][10]['value']}}">
                            <span class="text-danger"><small>Harus angka 62 didepan tidak boleh 0</small></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Email Pengawasan</label>
                        <div class="col-md-5">
                            <input name="mail1" class="form-control" type="text" value="{{$data['attrs'][11]['value']}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Email Penkum/PPH/PPM</label>
                        <div class="col-md-5">
                            <input name="mail2" class="form-control" type="text" value="{{$data['attrs'][12]['value']}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Email 3</label>
                        <div class="col-md-5">
                            <input name="mail3" class="form-control" type="text" value="{{$data['attrs'][13]['value']}}">
                        </div>
                    </div>
                
                    <div class="form-group row mt-5">
                        <label class="col-md-2 col-form-label">&nbsp;</label>
                        <div class="col-md-5">
                            <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection