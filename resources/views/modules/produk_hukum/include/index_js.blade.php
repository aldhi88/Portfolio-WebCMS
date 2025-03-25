<script>
    var dtTable = $('#myTable').DataTable({
        processing: true,serverSide: true,pageLength: 10,order: [[0, 'asc']],
        language: { paginate: { previous: "<i class='mdi mdi-chevron-left'>", next: "<i class='mdi mdi-chevron-right'>" }},
        drawCallback: function () { $(".dataTables_paginate > .pagination").addClass("pagination-rounded") },
        columnDefs: [
            { className: 'text-left', targets: ['_all'] },
        ],
        ajax: '{{ route("produk-hukum.dtIndex") }}',
        columns: [
            { data: 'action', name: 'name', orderable: true, searchable:true },
            { data: 'isi_count', name: 'isi_count', orderable: false, searchable:false },
        ],
        initComplete: function(settings){
            table = settings.oInstance.api();
            initSearchCol(table,'#header-filter','input-search');
        }
    });
</script>