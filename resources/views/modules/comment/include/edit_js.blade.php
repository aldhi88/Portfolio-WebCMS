<script>
    $('#process').submit(function (e) {
        loader(true);
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: "{{ url('bo/contacts') }}/{{ $data['id'] }}",
            data: formData,
            cache: false, contentType: false, processData: false,
            success: (a) => {
                showNotif(a.data.type, a.data.msg);
                loader(false);
            },
            error: (a) => {
                if(a.status == 422){
                    clearValidate('#process');
                    $.each(a.responseJSON.errors, function(key, value){
                        showValidate('#process',key, value);
                    })
                }else{
                    showNotif('error',a.status);
                }
                loader(false);
            }
        });
    });
</script>

