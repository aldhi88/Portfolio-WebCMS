@extends('components.layout.main',['title' => 'Album Photo'])
@section('css')
    @include('components.dtable.style')
@endsection
@section('js')
    @include('components.dtable.script')
    @include('modules.gallery.include.index_js')
    @include('modules.gallery.include.delete_js')
@endsection

@section('content')

<div class="row">
    <div class="col">
        @include('components.content.page_title',[
            'title' => 'Album Photo',
            'right' => '<a href="'.route('galleries.create').'" class="btn btn-outline-primary waves-effect waves-light btn-sm">Tambah Album Baru</a>'
        ])

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
        
                        <table id="myTable" class="table table-bordered dt-responsive nowrap table-striped" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Nama Album</th>
                                    <th>Jumlah Photo</th>
                                    <th>User</th>
                                    <th>Dibuat</th>
                                </tr>
                            </thead>
                            <thead id="header-filter" class="text-center">
                                <th></th>
                                <th off></th>
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

@include('modules.gallery.delete')
@endsection