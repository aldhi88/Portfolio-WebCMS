@extends('components.layout.main',['title' => 'Kategori Berita'])
@section('css')
    @include('components.dtable.style')
@endsection
@section('js')
    @include('components.dtable.script')
    @include('modules.post_category.include.index_js')
    @include('modules.post_category.include.create_js')
    @include('modules.post_category.include.delete_js')
    {{-- @include('modules.post_category.include.default_js') --}}
@endsection

@section('content')

<div class="row">
    <div class="col">
        @include('components.content.page_title',['title' => 'Kategori Berita'])

        <div class="row">
            <div class="col-4">
                {{-- <h6>Tambahkan data baru</h6> --}}

                <form id="inForm"> @csrf
                    <div class="form-group">
                        <label>Nama Kategori Berita</label>
                        <input name="name" type="text" class="form-control" placeholder="Isi disini.." autofocus>
                        <div class="invalid-feedback d-block msg name"></div>
                    </div>

                    {{-- <div class="form-group">
                        <div class="form-check mb-1">
                            <input class="form-check-input" name="is_default" id="default" type="checkbox" value="1">
                            <label class="form-check-label" for="default" style="margin-top: 2px">Default</label>
                        </div>
                    </div> --}}
    
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Tambahkan Data</button>
                    </div>
                </form>
            </div>


            <div class="col">
                <div class="card">
                    <div class="card-body">
        
                        <table id="myTable" class="table table-bordered dt-responsive nowrap table-striped" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Nama Kategori Berita</th>
                                    {{-- <th>Default</th> --}}
                                </tr>
                            </thead>
                            <thead id="header-filter" class="text-center">
                                <th></th>
                                {{-- <th off></th> --}}
                            </thead>
                            <tbody></tbody>
                        </table>
        
                    </div>
                </div>
        
            </div>
        </div>
    </div>
</div>

@include('modules.post_category.delete')
{{-- @include('modules.post_category.default') --}}
@endsection