@include('components.dtable.style')

<table id="myTable2" class="table table-bordered dt-responsive nowrap table-striped" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
        <tr>
            <th>Media</th>
            <th>User</th>
            <th>Kategori</th>
            <th>Tanggal</th>
            <th>Pilih</th>
        </tr>
    </thead>
    <thead id="header-filter" class="text-center">
        <th></th>
        <th></th>
        <th></th>
        <th off></th>
        <th off></th>
    </thead>
    <tbody></tbody>
</table>
@include('components.dtable.script')
<script>
    var dtTable = $('#myTable2').DataTable({
        processing: true,serverSide: true,pageLength: 10,order: [[3, 'desc']],scrollX: true,
        language: { paginate: { previous: "<i class='mdi mdi-chevron-left'>", next: "<i class='mdi mdi-chevron-right'>" }},
        drawCallback: function () { $(".dataTables_paginate > .pagination").addClass("pagination-rounded") },
        columnDefs: [
            { className: 'text-left', targets: ['_all'] },
        ],
        ajax:{
            url: '{{ route("posts.dtMediaImage") }}',
            data: function(d){
                d.filter = $('select[name="filter"] option:selected').val();
            }
        },
        columns: [
            { data: 'action', name: 'name', orderable: true, searchable:true },
            { data: 'users.first_name', name: 'users.first_name', orderable: true, searchable:true },
            { data: 'category', name: 'category', orderable: true, searchable:true },
            { data: 'created_at_format', name: 'created_at', orderable: true, searchable:false },
            { data: 'pick', name: 'pick', orderable: false, searchable:false },
        ],
        initComplete: function(settings){
            table = settings.oInstance.api();
            initSearchCol(table,'#header-filter','input-search');
            pick();
        }
    });

    function pick() {
        $('#myTable2').on('click','.pick',function(){
            var path = $(this).attr('path');
            var storage = $(this).attr('storage');
            $('#modalMediaImage').modal('hide');
            $('#img-cover').attr('src',path);
            $('input[name="image_media"]').val(storage);
            $('input[name="image"]').val('');
        })
    }
</script>

