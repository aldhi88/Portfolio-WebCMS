<script>
    $('#inForm').submit(function (e) {
        loader(true);
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: "{{ route('post-categories.store') }}",
            data: formData,
            cache: false, contentType: false, processData: false,
            success: (a) => {
                dtTable.ajax.reload();
                showNotif(a.data.type, a.data.msg);
                $('#inForm').trigger('reset');
                loader(false);
            },
            error: (a) => {
                if(a.status == 422){
                    clearValidate('#inForm');
                    $.each(a.responseJSON.errors, function(key, value){
                        showValidate('#inForm',key, value);
                    })
                }else{
                    showNotif('error',a.status);
                }
                loader(false);
            }
        });
    });
</script>