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

$('#komentar').submit(function (e) {
    clearValidate('#komentar');
    e.preventDefault();
    var formData = new FormData(this);
    var response = grecaptcha.getResponse();
    if(response.length == 0){
        var alert = `<div class="alert alert-danger" role="alert">Silahkan konfirmasi reCaptcha.</div>`;
        $('#alert-area').html(alert);
        return false;
    }

    $.ajax({
        type: 'POST',
        url: "{{ route('web.kirimKomentar') }}",
        data: formData,
        cache: false, contentType: false, processData: false,
        success: (a) => {
            var alert = `<div class="alert alert-`+a.data.alert+`" role="alert">`+a.data.msg+`</div>`;
            $('#alert-area').html(alert);
            $('#komentar').trigger('reset');
            grecaptcha.reset();
            loader(false);
        },
        error: (a) => {
            if(a.status == 422){
                clearValidate('#komentar');
                $.each(a.responseJSON.errors, function(key, value){
                    showValidate('#komentar',key, value);
                })
            }else{
                // showNotif('error',a.status);
            }
        }
    });
});
</script>