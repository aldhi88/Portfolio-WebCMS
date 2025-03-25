<script>
    $("#modalDefault").on("show.bs.modal", function(e) {
        var id = $(e.relatedTarget).data('id');
        $('#formModalDefault input[name="id"]').val(id);
        $.ajax({
            type: 'GET', cache: true, contentType: false, processData: true,
            url: '{{ route("post-categories.getData") }}',
            data: {id:id},
            success: (a) => {
                $('#formModalDefault .attr').text(a.name);
            },
            error: (a) => {
                alert("Error #001, post-categories/getData.");
            }
        });
    });
    $('#formModalDefault').submit(function (e) {
        loader(true);
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST', cache: false, contentType: false, processData: false,
            url: "{{ url('post-categories/upDefault') }}/"+$("#formModalDefault input[name='id']").val(),
            data: formData,
            success: (a) => {
                $('#modalDefault').modal('toggle');
                if(a.status == true){
                    dtTable.ajax.reload();
                }
                showNotif(a.data.type, a.data.msg);
                loader(false);
            },
            error: (a) => {
                showNotif(a.data.type,a.data.msg);
                loader(false);
            }
        });
    });
</script>

