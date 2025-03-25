@extends('components.layout.main',['title' => 'Data DPO'])
@section('css')
@include('components.dtable.style')
@endsection
@section('js')
@include('components.dtable.script')
    @include('modules.dpo.include.index_js')
    @include('modules.page.include.delete_js')
@endsection

@section('content')

<div class="row">
    <div class="col">
        @include('components.content.page_title',[
            'title' => 'Data DPO',
            'right' => '<a href="'.route('dpos.create').'" class="btn btn-outline-primary waves-effect waves-light btn-sm">Tambah DPO Baru</a>'
        ])

        <div class="row">
            <div class="col">
                
                <div class="card">
                    <div class="card-body">
                        <table id="myTable" class="table table-bordered dt-responsive nowrap table-striped" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Order</th>
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