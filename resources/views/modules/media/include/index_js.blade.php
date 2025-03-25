<script>
    var dtTable = $('#myTable').DataTable({
        processing: true,serverSide: true,pageLength: 10,order: [[3, 'desc']],scrollX: true,
        language: { paginate: { previous: "<i class='mdi mdi-chevron-left'>", next: "<i class='mdi mdi-chevron-right'>" }},
        drawCallback: function () { $(".dataTables_paginate > .pagination").addClass("pagination-rounded") },
        columnDefs: [
            { className: 'text-left', targets: ['_all'] },
        ],
        ajax:{
            url: '{{ route("media.dtIndex") }}',
            data: function(d){
                d.filter = $('select[name="filter"] option:selected').val();
            }
        },
        columns: [
            { data: 'action', name: 'name', orderable: true, searchable:true },
            { data: 'users.first_name', name: 'users.first_name', orderable: true, searchable:true },
            { data: 'category', name: 'category', orderable: true, searchable:false },
            { data: 'created_at_format', name: 'created_at', orderable: true, searchable:false },
            { data: 'url', name: 'url', orderable: false, searchable:false },
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
            clipboard();
        }
    });

    function clipboard() {
        $('#myTable').on('click','.clipboard',function(){
            var id = $(this).attr('data-id');
            var copyText = document.getElementById("copy-"+id);
            copyText.select();
            copyText.setSelectionRange(0, 99999); /* For mobile devices */
            navigator.clipboard.writeText(copyText.value);
            showNotif('success', 'Alamat URL file berhasil disalin.');
        })
    }
</script>