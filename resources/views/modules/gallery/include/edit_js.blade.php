<script>
var dtTable = $('#myTable').DataTable({
    processing: true,serverSide: true,pageLength: 10,order: [[0 , 'desc']],
    language: { paginate: { previous: "<i class='mdi mdi-chevron-left'>", next: "<i class='mdi mdi-chevron-right'>" }},
    drawCallback: function () { $(".dataTables_paginate > .pagination").addClass("pagination-rounded") },
    columnDefs: [
        { className: 'text-left', targets: ['_all'] },
    ],
    ajax: '{{ route("galleries.dtEdit") }}',
    ajax:{
            url: '{{ route("galleries.dtEdit") }}',
            data: function(d){
                d.id = '{{$edit["id"]}}';
            }
        },
    columns: [
        { data: 'action', name: 'action', orderable: true, searchable:true },
    ],
    initComplete: function(settings){
        table = settings.oInstance.api();
        initSearchCol(table,'#header-filter','input-search');
    }
});

$('#upAlbumName').submit(function (e) {
    loader(true);
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        type: 'POST',
        url: "{{ url('bo/galleries/upAlbumName') }}/{{ $edit['id'] }}",
        data: formData,
        cache: false, contentType: false, processData: false,
        success: (a) => {
            showNotif(a.data.type,a.data.msg);
            loader(false);
        },
        error: (a) => {
            if(a.status == 422){
                clearValidate('#upForm');
                $.each(a.responseJSON.errors, function(key, value){
                    showValidate('#upForm',key, value);
                })
            }else{
                showNotif('error',a.status);
            }
            loader(false);
        }
    });
});

Dropzone.options.myElement = {
  // Note: using "function()" here to bind `this` to
  // the Dropzone instance.
  init: function() {
    this.on("success", file => {
      console.log("A file has been added");
    });
  }
};
</script>