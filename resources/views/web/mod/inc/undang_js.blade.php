<script>
// menampilkan validasi error disetiap input
var dtTable = $('#myTable').DataTable({
    processing: true,serverSide: true,pageLength: 25,
    order: [[2, 'desc']],
    language: {
      "lengthMenu": "Tampilkan _MENU_ baris",
      "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
      "paginate": {
            "next":       ">>",
            "previous":   "<<"
        },
        'infoFiltered': '(filter dari _MAX_ total data)',
        "infoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
    },
    columnDefs: [
        { className: 'text-center', targets: ['_all'] },
    ],
    ajax:{
        url: '{{ route("web.dtUndangUndang") }}',
        data: function(d){
            d.filter = $('input[name="filter"]').val();
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable:false },
        { data: 'name', name: 'name', orderable: true, searchable:true },
        { data: 'tahun', name: 'tahun', orderable: true, searchable:true },
        { data: 'tentang', name: 'tentang', orderable: true, searchable:true },
    ],
    initComplete: function(settings){
        $('#myTable_filter').css('display','inline');
        var div = $('#catagory-element').html();
        $('#catagory-element').remove();
        $('#myTable_filter').html(div);
        $('body').on('click','li.produk-hukum',function(){
            var id = $(this).attr('data-id');
            var text = $(this).attr('data-text');
            $('input[name="filter"]').val(id);
            $('#produk-hukum').text(text);
            dtTable.ajax.reload();
        });
        table = settings.oInstance.api();
        initSearchCol(table,'#header-filter','input-search');
    }
});

function initSearchCol(table,headerId,inputClass){
    $(headerId+' th').each(function() {
        var title = $(this).text();
        var off = $(this).attr("off");
        var align = $(this).attr('center');
        if (typeof align != typeof undefined) {
            var align = 'text-center';
        }
        if (typeof off == typeof undefined) {
            $(this).html('<input placeholder="'+title+'" type="text" class="'+inputClass+' '+align+' form-control input-sm" style="width:100%"/>');
        }
    });
    var timeout = null;
    $(headerId).on('keyup', '.'+inputClass,function (e) {
        clearTimeout(timeout);
        var dataThis = $(this);
        var thisValue = this.value;
        timeout = setTimeout(function() {
            table.column( dataThis.parent().index() ).search( thisValue ).draw();
        }, 1000);
    });
}
</script>