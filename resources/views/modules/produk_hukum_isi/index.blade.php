@extends('components.layout.main',['title' => 'Isi Produk Hukum'])
@section('css')
@include('components.dtable.style')
@endsection
@section('js')
@include('components.dtable.script')
    @include('modules.produk_hukum_isi.include.index_js')
    @include('modules.produk_hukum_isi.include.delete_js')
@endsection

@section('content')

<div class="row">
    <div class="col">
        @include('components.content.page_title',[
            'title' => 'Isi Produk Hukum',
            'right' => '<a href="'.route('produk-hukum.index').'" class="btn btn-outline-primary waves-effect waves-light btn-sm">Kembali ke Produk Hukum</a>'

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
                                        <option value="0">Semua Produk Hukum</option>
                                        @foreach ($data['categories'] as $item)
                                        <option {{ $item['id']==$data['filter']?'selected':null }} value="{{$item['id']}}">{{$item['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        {{-- -------------- --}}

                        <table id="myTable" class="table table-bordered dt-responsive nowrap table-striped" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Judul/Nomor</th>
                                    <th>Tahun</th>
                                    <th width="300">Tentang</th>
                                    <th>Kategori</th>
                                    <th>User</th>
                                </tr>
                            </thead>
                            <thead id="header-filter" class="text-center">
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
                
            </div>


            
        </div>
    </div>
</div>

@include('modules.produk_hukum_isi.delete')
@endsection