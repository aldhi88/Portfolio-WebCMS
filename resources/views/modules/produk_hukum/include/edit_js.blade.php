<script>
    $('#upForm').submit(function (e) {
        loader(true);
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: "{{ url('bo/produk-hukum') }}/{{ $edit['id'] }}",
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
</script>