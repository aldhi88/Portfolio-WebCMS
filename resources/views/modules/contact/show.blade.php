@extends('components.layout.main',['title' => 'Detail Tindakan Terhadap Pesan'])
@section('css')
@endsection
@section('js')
@endsection

@section('content')

<div class="row">
    <div class="col">
        @include('components.content.page_title',[
            'title' => 'Detail Tindakan Terhadap Pesan',
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
                    <div class="card-body">
                        <h5 class="card-title">Petugas: {{ Auth::user()->first_name }}</h5>
                        <hr>
                        <div class="form-group">
                            <label>Deskripsi Tindakan:</label>
                            <p>{{ $data['action'] }}</p>
                        </div>
                        <small><p class="text-right">{{ \Carbon\Carbon::parse($data['updated_at'])->format('d M Y') }}</p></small>
                    </div>
                </div>
                
            </div>


            
        </div>
    </div>
</div>

@endsection