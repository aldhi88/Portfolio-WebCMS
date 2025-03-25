<script>
    $("#approve").on("show.bs.modal", function(e) {
        var id = $(e.relatedTarget).data('id');
        $('#approveForm input[name="id"]').val(id);
        $.ajax({
            type: 'GET', cache: true, contentType: false, processData: true,
            url: '{{ route("comments.getData") }}',
            data: {id:id},
            success: (a) => {
                $('#name').text(a.name);
                $('#contact').text(a.contact);
                $('#title').text(a.posts.title);
                $('#content').text(a.content);
            },
            error: (a) => {
                alert("Error #001, getData.");
            }
        });
    });

    $('#approve').on('click','#btn-approve', function(){
        submit('approve');
        $('#approveForm').trigger('submit');
    });

    $('#approve').on('click','#btn-reject', function(){
        submit('reject');
        $('#approveForm').trigger('submit');
    });

    function submit(action){
        $('#approveForm').submit(function (e) {
            loader(true);
            e.preventDefault();
            var formData = new FormData(this);
            formData.append('action',action);
            $.ajax({
                type: 'POST', cache: false, contentType: false, processData: false,
                url: "{{ url('bo/comments') }}/"+$("#approveForm input[name='id']").val(),
                data: formData,
                success: (a) => {
                    $('#approve').modal('toggle');
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
    }
    

</script>

