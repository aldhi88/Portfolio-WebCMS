@extends('components.layout.main',['title' => 'Data Halaman'])
@section('css')
@include('components.dtable.style')
@endsection
@section('js')
@include('components.dtable.script')
    @include('modules.page.include.index_js')
    @include('modules.page.include.delete_js')
@endsection

@section('content')

<div class="row">
    <div class="col">
        @include('components.content.page_title',[
            'title' => 'Data Halaman',
            'right' => '<a href="'.route('pages.create').'" class="btn btn-outline-primary waves-effect waves-light btn-sm">Tambah Halaman Baru</a>'
        ])

        <div class="row">
            <div class="col">
                
                <div class="card">
                    <div class="card-body">

                        {{-- -------------- --}}
                        <div id="catagory-element">
                            <div class="row">
                                <div class="col"></div>
                                <div class="col-6">
                                    <select name="filter1" class="form-control form-control-sm">
                                        @foreach ($data['categories'] as $item)
                                        <option {{$item=='master_page'?'selected':null}} value="{{$item['key']}}">{{$item['label']}}</option>
                                        @endforeach
                                        <option value="x">Semua Kategori</option>
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
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <thead id="header-filter" class="text-center">
                                <th></th>
                                <th></th>
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

@include('modules.page.delete')
@endsection