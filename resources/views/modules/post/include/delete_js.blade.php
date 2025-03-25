<script>
    $("#delModal").on("show.bs.modal", function(e) {
        var id = $(e.relatedTarget).data('id');
        $('#delModalForm input[name="id"]').val(id);
        $.ajax({
            type: 'GET', cache: true, contentType: false, processData: true,
            url: '{{ route("posts.getData") }}',
            data: {id:id},
            success: (a) => {
                $('#delModalForm .attr-delete').text(a.name);
            },
            error: (a) => {
                alert("Error #001, getData.");
            }
        });
    });
    
    $('#delModalForm').submit(function (e) {
        loader(true);
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST', cache: false, contentType: false, processData: false,
            url: "{{ url('bo/posts') }}/"+$("#delModalForm input[name='id']").val(),
            data: formData,
            success: (a) => {
                $('#delModal').modal('toggle');
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

