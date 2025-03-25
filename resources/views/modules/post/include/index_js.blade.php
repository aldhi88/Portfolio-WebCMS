<script>
    var dtTable = $('#myTable').DataTable({
        processing: true,serverSide: true,pageLength: 10,order: [[6, 'desc']],scrollX: true,
        language: { paginate: { previous: "<i class='mdi mdi-chevron-left'>", next: "<i class='mdi mdi-chevron-right'>" }},
        drawCallback: function () { $(".dataTables_paginate > .pagination").addClass("pagination-rounded") },
        columnDefs: [
            { className: 'text-left', targets: ['_all'] },
        ],
        ajax:{
            url: '{{ route("posts.dtIndex") }}',
            data: function(d){
                d.filter1 = $('select[name="filter1"] option:selected').val();
                d.filter2 = $('select[name="filter2"] option:selected').val();
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
        }
    });
</script>