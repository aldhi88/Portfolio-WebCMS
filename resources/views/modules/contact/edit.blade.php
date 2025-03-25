@extends('components.layout.main',['title' => 'Proses Pesan Masuk'])
@section('css')
@endsection
@section('js')
@include('modules.contact.include.edit_js')
@endsection

@section('content')

<div class="row">
    <div class="col">
        @include('components.content.page_title',[
            'title' => 'Proses Pesan Masuk',
            'right' => '<a href="'.route('contacts.index').'" class="btn btn-outline-primary waves-effect waves-light btn-sm">Pesan Masuk</a>'
        ])

        <div class="row">
            <div class="col">
                <div class="media mb-4">
                    <div class="media-body">
                        <h5 class="font-size-14 my-1 font-size-16">{{ $data['name'] }}</h5>
                        <small class="text-muted">{{ $data['email'] }}</small>
                    </div>
                </div>
                <p>{{ $data['msg'] }}</p>
                <small><p class="text-right">{{ \Carbon\Carbon::parse($data['created_at'])->format('d M Y') }}</p></small>
            </div>
            <div class="col">
                
                <div class="card">
                    <form id="process">@csrf @method('PUT')
                        <div class="card-body">
                            <h5 class="card-title">Petugas: {{ Auth::user()->first_name }}</h5>
                            <hr>
                            <div class="form-group">
                                <label>Deskripsi Tindakan:</label>
                                <textarea name="action" class="form-control" rows="10" placeholder="Misal : Membalas pesan langsung ke E-Mail dan SMS..."></textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block">Tandai Pesan Sudah Diproses</button>
                            </div>
                        </div>
                    </form>
                </div>
                
            </div>


            
        </div>
    </div>
</div>

@endsection