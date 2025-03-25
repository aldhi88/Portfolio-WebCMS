@include('components.dtable.style')
{{-- -------------- --}}
<div id="filter-post">
    <div class="row">
        <div class="col">
            <select name="filter_post_1" class="form-control form-control-sm">
                <option value="x">Semua Kategori</option>
                @foreach ($data['categories'] as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col">
            <select name="filter_post_2" class="form-control form-control-sm">
                <option value="x">Semua Status Berita</option>
                <option value="0">Berita Draf</option>
                <option value="1">Berita Terbit</option>
            </select>
        </div>
    </div>
</div>
{{-- -------------- --}}

<table id="myTable2" class="table table-bordered dt-responsive nowrap table-striped" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
        <tr>
            <th>Judul</th>
            <th>User</th>
            <th>Kategori</th>
            <th>Pembaca</th>
            <th>Komentar</th>
            <th>Status</th>
            <th>Tanggal</th>
            <th width="100">Pilih</th>
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
        <th off></th>
    </thead>
    <tbody></tbody>
</table>
@include('components.dtable.script')

<script>
var dtTable2 = $('#myTable2').DataTable({
    processing: true,serverSide: true,pageLength: 10,order: [[6, 'desc']],scrollX: true,
    language: { paginate: { previous: "<i class='mdi mdi-chevron-left'>", next: "<i class='mdi mdi-chevron-right'>" }},
    drawCallback: function () { $(".dataTables_paginate > .pagination").addClass("pagination-rounded") },
    columnDefs: [
        { className: 'text-left', targets: ['_all'] },
    ],
    ajax:{
        url: '{{ route("links.dtGetPost") }}',
        data: function(d){
            d.filter1 = $('select[name="filter_post_1"] option:selected').val();
            d.filter2 = $('select[name="filter_post_2"] option:selected').val();
        }
    },
    columns: [
        { data: 'action', name: 'title', orderable: true, searchable:true },
        { data: 'users.first_name', name: 'users.first_name', orderable: true, searchable:true },
        { data: 'categories', name: 'categories', orderable: false, searchable:false },
        { data: 'count_visitor', name: 'count_visitor', orderable: false, searchable:false },
        { data: 'id', name: 'id', orderable: false, searchable:false },
        { data: 'status', name: 'status', orderable: false, searchable:false },
        { data: 'created_at_format', name: 'created_at', orderable: true, searchable:false },
        { data: 'pick', name: 'pick', orderable: false, searchable:false },
    ],
    initComplete: function(settings){
        $('#myTable2_filter').css('display','inline');
        var div = $('#filter-post').html();
        $('#filter-post').remove();
        $('#myTable2_filter').html(div);
        $('select[name="filter_post_1"],select[name="filter_post_2"]').change(function(){
            dtTable2.ajax.reload();
        });
        table = settings.oInstance.api();
        initSearchCol(table,'#header-filter','input-search');
        pickPost('{{$data["activeKey"]}}');
    }
});


</script>