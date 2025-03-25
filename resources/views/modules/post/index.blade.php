@extends('components.layout.main',['title' => 'Data Berita'])
@section('css')
@include('components.dtable.style')
@endsection
@section('js')
@include('components.dtable.script')
    @include('modules.post.include.index_js')
    @include('modules.post.include.delete_js')
@endsection

@section('content')

<div class="row">
    <div class="col">
        @include('components.content.page_title',[
            'title' => 'Data Berita',
            'right' => '<a href="'.route('posts.create').'" class="btn btn-outline-primary waves-effect waves-light btn-sm">Tambah Berita Baru</a>'
        ])

        <div class="row">
            <div class="col">
                
                <div class="card">
                    <div class="card-body">

                        {{-- -------------- --}}
                        <div id="catagory-element">
                            <div class="row">
                                <div class="col">
                                    <select name="filter1" class="form-control form-control-sm">
                                        <option value="x">Semua Kategori</option>
                                        @foreach ($data['categories'] as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <select name="filter2" class="form-control form-control-sm">
                                        <option value="x">Semua Status Berita</option>
                                        <option value="0">Berita Draf</option>
                                        <option value="1">Berita Terbit</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        {{-- -------------- --}}

                        <table id="myTable" class="table table-bordered dt-responsive nowrap table-striped" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th>User</th>
                                    <th>Kategori</th>
                                    <th>Pembaca</th>
                                    <th>Komentar</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <thead id="header-filter" class="text-center">
                                <th></th>
                                <th></th>
                                <th off></th>
                                <th off></th>
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

@include('modules.post.delete')
@endsection