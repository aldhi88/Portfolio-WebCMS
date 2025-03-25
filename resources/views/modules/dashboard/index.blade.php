@extends('components.layout.main',['title' => 'Index Dashboard'])
@section('content')

<div class="row">
    <div class="col">
        @include('components.content.page_title',['title' => 'Index Dashboard'])
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                Selamat datang di Dashboard Admin Kejaksaan Tinggi Sumatera Utara!
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection