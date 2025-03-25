<script>
    var dtTable = $('#myTable').DataTable({
        processing: true,serverSide: true,pageLength: 10,order: [[1, 'asc']],scrollX: true,
        language: { paginate: { previous: "<i class='mdi mdi-chevron-left'>", next: "<i class='mdi mdi-chevron-right'>" }},
        drawCallback: function () { $(".dataTables_paginate > .pagination").addClass("pagination-rounded") },
        columnDefs: [
            { className: 'text-left', targets: ['_all'] },
        ],
        ajax:{
            url: '{{ route("widgets.dtIndex") }}',
            data: function(d){
            }
        },
        columns: [
            { data: 'action', name: 'title', orderable: true, searchable:true },
            { data: 'order', name: 'order', orderable: true, searchable:true },
            { data: 'users.first_name', name: 'users.first_name', orderable: true, searchable:true },
            { data: 'created_at_format', name: 'created_at', orderable: true, searchable:false },
        ],
        initComplete: function(settings){
            table = settings.oInstance.api();
            initSearchCol(table,'#header-filter','input-search');
        }
    });

</script>