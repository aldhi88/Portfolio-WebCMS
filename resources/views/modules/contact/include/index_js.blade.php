<script>
    var dtTable = $('#myTable').DataTable({
        processing: true,serverSide: true,pageLength: 10,order: [[0, 'desc']],scrollX: true,
        language: { paginate: { previous: "<i class='mdi mdi-chevron-left'>", next: "<i class='mdi mdi-chevron-right'>" }},
        drawCallback: function () { $(".dataTables_paginate > .pagination").addClass("pagination-rounded") },
        columnDefs: [
            { className: 'text-left', targets: ['_all'] },
        ],
        ajax:{
            url: '{{ route("contacts.dtIndex") }}',
            data: function(d){
                d.filter = $('select[name="filter"] option:selected').val();
            }
        },
        columns: [
            { data: 'created_at_action', name: 'created_at', orderable: true, searchable:false },
            { data: 'name', name: 'name', orderable: true, searchable:true },
            { data: 'email', name: 'email', orderable: false, searchable:true },
            { data: 'phone', name: 'phone', orderable: false, searchable:true },
            { data: 'status_format', name: 'status', orderable: true, searchable:false },
            { data: 'user_format', name: 'user_format', orderable: false, searchable:false },
            { data: 'action', name: 'action', orderable: false, searchable:false },
        ],
        initComplete: function(settings){
            $('#myTable_filter').css('display','inline');
            var div = $('#catagory-element').html();
            $('#catagory-element').remove();
            $('#myTable_filter').html(div);
            $('select[name="filter"]').change(function(){
                dtTable.ajax.reload();
            });
            table = settings.oInstance.api();
            initSearchCol(table,'#header-filter','input-search');
        }
    });
</script>