@extends('web.layout.main')
@section('css')
    <style>
        /* .dataTables_filter { 
            display: none !important; 
        } */
        table.dataTable thead th, table.dataTable thead td, table.dataTable tfoot th, table.dataTable tfoot td{
            text-align: center !important;
        }
    </style>
@endsection
@section('js')
@include('web.mod.inc.undang_js')
@endsection
@section('content')

<div class="breadcrumb-area shadow dark text-center bg-fixed text-light" style="background-image: url({{asset('web/assets/img/kejati/bg-undang.jpg')}});">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Undang-Undang</h1>
                {{-- <ul class="breadcrumb">
                    <li>
                    @foreach ($data['news']['post_related_categories'] as $item) 
                    <a href="#"><i class="fas fa-tag"></i>{{$item['post_categories']['name']}}</a>
                    @endforeach
                    </li>
                </ul> --}}
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumb -->

<div class="blog-area full-blog right-sidebar full-blog default-padding">
    <div class="container">
        <div class="row">
            <div class="blog-items">
                <div class="blog-content col-md-8">
                    <div class="item-box">
                        
                        <div class="item">

                            <div id="catagory-element">
                                <div class="col">
                                    <span id="produk-hukum">Semua Produk Hukum</span>
                                    <input type="hidden" name="filter" value="0">
                                </div>
                            </div>

                            <table id="myTable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Judul/Nomor</th>
                                        <th>Tahun</th>
                                        <th>Tentang</th>
                                    </tr>
                                </thead>
                                <thead id="header-filter" class="text-center">
                                    <th off></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Start Sidebar -->
                <div class="sidebar col-md-4">
                    <aside>
                        <!-- Start Sidebar Item -->
                        <div class="sidebar-item category">
                            <div class="title">
                                <h4>Produk Hukum</h4>
                            </div>
                            <div class="sidebar-info">
                                <ul>
                                    <li class="produk-hukum" data-id="0" data-text="Semua Produk Hukum"><a href="#0">Semua Produk Hukum <span>{{$data['isi']}}</span></a></li>
                                    @foreach ($data['produkHukum'] as $item)
                                        <li class="produk-hukum" data-id="{{$item['id']}}" data-text="{{$item['name']}}"><a href="#{{$item['id']}}">{{$item['name']}} <span>{{$item['isi_count']}}</span></a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <!-- End Sidebar Item -->
                    </aside>
                </div>
                
                <!-- End Start Sidebar -->
            </div>
        </div>
    </div>
</div>
<!-- End Blog -->

@endsection