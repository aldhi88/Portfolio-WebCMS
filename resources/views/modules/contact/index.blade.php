@extends('components.layout.main',['title' => 'Pesan Masuk'])
@section('css')
@include('components.dtable.style')
@endsection
@section('js')
@include('components.dtable.script')
    @include('modules.contact.include.index_js')
@endsection

@section('content')

<div class="row">
    <div class="col">
        @include('components.content.page_title',[
            'title' => 'Pesan Masuk',
            // 'right' => '<a href="'.route('media.create').'" class="btn btn-outline-primary waves-effect waves-light btn-sm">Unggah Media Baru</a>'
        ])

        <div class="row">
            <div class="col">
                
                <div class="card">
                    <div class="card-body">

                        {{-- -------------- --}}
                        <div id="catagory-element">
                            <div class="row">
                                <div class="col"></div>
                                <div class="col">
                                    <select name="filter" class="form-control form-control-sm">
                                        <option value="x">Semua Status</option>
                                        <option value="1">Sudah Diproses</option>
                                        <option value="0">Belum Diproses</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        {{-- -------------- --}}

                        <table id="myTable" class="table table-bordered dt-responsive nowrap table-striped" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Telepon</th>
                                    <th>Status</th>
                                    <th>Diporses<br>oleh</th>
                                    <th>Tindakan</th>
                                </tr>
                            </thead>
                            <thead id="header-filter" class="text-center">
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th off></th>
                                <th off></th>
                                <th off></th>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
                
            </div>


            
        </div>
    </div>
</div>

{{-- @include('modules.media.delete') --}}
@endsection