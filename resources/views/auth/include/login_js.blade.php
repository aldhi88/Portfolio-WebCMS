<script>
    $('#loginForm').submit(function (e) {
        loader(true);
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: "{{ route('auth.login') }}",
            data: formData,
            cache: false, contentType: false, processData: false,
            success: (a) => {
                if(a.status==true){
                    window.location.replace(a.data.url);
                }else{
                    showNotif(a.data.type, a.data.msg);
                    loader(false);
                }
            },
            error: (a) => {
                if(a.status == 422){
                    clearValidate('#loginForm');
                    $.each(a.responseJSON.errors, function(key, value){
                        showValidate('#loginForm',key, value);
                    })
                }else{
                    // showAlert('danger', 'times', 'alert-area', a.status);
                    // $('#createModal').modal('toggle');
                }
                loader(false);
            }
        });
    });
</script>

