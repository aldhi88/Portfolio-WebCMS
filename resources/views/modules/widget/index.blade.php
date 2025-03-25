@extends('components.layout.main',['title' => 'Data Link Spesial'])
@section('css')
@include('components.dtable.style')
@endsection
@section('js')
@include('components.dtable.script')
    @include('modules.widget.include.index_js')
    @include('modules.page.include.delete_js')
@endsection

@section('content')

<div class="row">
    <div class="col">
        @include('components.content.page_title',[
            'title' => 'Data Link Spesial',
            'right' => '<a href="'.route('widgets.create').'" class="btn btn-outline-primary waves-effect waves-light btn-sm">Tambah Link Spesial Baru</a>'
        ])

        <div class="row">
            <div class="col">
                
                <div class="card">
                    <div class="card-body">

                        <table id="myTable" class="table table-bordered dt-responsive nowrap table-striped" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th>Urutan</th>
                                    <th>User</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <thead id="header-filter" class="text-center">
                                <th></th>
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