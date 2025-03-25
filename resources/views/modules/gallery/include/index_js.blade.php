<script>
    var dtTable = $('#myTable').DataTable({
        processing: true,serverSide: true,pageLength: 10,order: [[3, 'desc']],
        language: { paginate: { previous: "<i class='mdi mdi-chevron-left'>", next: "<i class='mdi mdi-chevron-right'>" }},
        drawCallback: function () { $(".dataTables_paginate > .pagination").addClass("pagination-rounded") },
        columnDefs: [
            { className: 'text-left', targets: ['_all'] },
        ],
        ajax: '{{ route("galleries.dtIndex") }}',
        columns: [
            { data: 'action', name: 'name', orderable: true, searchable:true },
            { data: 'gallery_related_items_count', name: 'gallery_related_items_count', orderable: true, searchable:false },
            { data: 'users.first_name', name: 'users.first_name', orderable: true, searchable:true },
            { data: 'created_at_format', name: 'created_at', orderable: true, searchable:false },
        ],
        initComplete: function(settings){
            table = settings.oInstance.api();
            initSearchCol(table,'#header-filter','input-search');
        }
    });
</script>