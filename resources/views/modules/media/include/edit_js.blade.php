<script>
$('#upForm').submit(function (e) {
    loader(true);
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        type: 'POST',
        url: "{{ url('bo/media') }}/{{ $edit['id'] }}",
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

$('input[name="name"]').bind('input', function(){
    $(this).val(function(_, v){
        return v.replace(/\s+/g, '');
    });
});

</script>