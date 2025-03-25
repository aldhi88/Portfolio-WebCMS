@include('components.dtable.style')
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
            <th width="100">Pilih</th>
        </tr>
    </thead>
    <thead id="header-filter" class="text-center">
        <th></th>
        <th></th>
        <th off></th>
        <th off></th>
    </thead>
    <tbody></tbody>
</table>
@include('components.dtable.script')
<script>
var dtTable = $('#myTable').DataTable({
    processing: true,serverSide: true,pageLength: 10,order: [[2, 'desc']],scrollX: true,
    language: { paginate: { previous: "<i class='mdi mdi-chevron-left'>", next: "<i class='mdi mdi-chevron-right'>" }},
    drawCallback: function () { $(".dataTables_paginate > .pagination").addClass("pagination-rounded") },
    columnDefs: [
        { className: 'text-left', targets: ['_all'] },
    ],
    ajax:{
        url: '{{ route("links.dtGetPage") }}',
        data: function(d){
            d.filter = $('select[name="filter1"] option:selected').val();
        }
    },
    columns: [
        { data: 'action', name: 'title', orderable: true, searchable:true },
        { data: 'users.first_name', name: 'users.first_name', orderable: true, searchable:true },
        { data: 'created_at_format', name: 'created_at', orderable: true, searchable:false },
        { data: 'pick', name: 'pick', orderable: false, searchable:false },
    ],
    initComplete: function(settings){
        $('#myTable_filter').css('display','inline');
        var div = $('#catagory-element').html();
        $('#catagory-element').remove();
        $('#myTable_filter').html(div);
        $('select[name="filter1"],select[name="filter2"]').change(function(){
            dtTable.ajax.reload();
        });
        table = settings.oInstance.api();
        initSearchCol(table,'#header-filter','input-search');
        pickPage('{{$data["activeKey"]}}');
    }
});


</script>