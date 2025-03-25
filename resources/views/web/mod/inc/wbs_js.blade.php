<script>
  // menampilkan validasi error disetiap input
function showValidate(el, key, value){
    $(el+' .'+key).text(value);
}

$("input, textarea").keypress(function(){
    $(this).closest(".form-group").find(".msg").empty();
})

// menghapus validasi error di setiap input
function clearValidate(el){
    $('.msg').text('');
}

    $('#kirimWbs').submit(function (e) {
        clearValidate('#kirimWbs');
        e.preventDefault();
        var formData = new FormData(this);
        var response = grecaptcha.getResponse();
        if(response.length == 0){
            var alert = `<div class="alert alert-danger" role="alert">Silahkan konfirmasi reCaptcha.</div>`;
            $('#alert-area').html(alert);
        }

        $.ajax({
            type: 'POST',
            url: "{{ route('web.kirimWbs') }}",
            data: formData,
            cache: false, contentType: false, processData: false,
            success: (a) => {
                var alert = `<div class="alert alert-`+a.data.alert+`" role="alert">`+a.data.msg+`</div>`;
                $('#alert-area').html(alert);
                $('#kirimWbs').trigger('reset');
                grecaptcha.reset();
                loader(false);
            },
            error: (a) => {
                if(a.status == 422){
                    clearValidate('#kirimWbs');
                    $.each(a.responseJSON.errors, function(key, value){
                        showValidate('#kirimWbs',key, value);
                    })
                }else{
                    // showNotif('error',a.status);
                }
            }
        });
    });
</script>