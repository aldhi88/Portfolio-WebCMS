<script>

$("#modalMedia").on("show.bs.modal", function(e) {
    $.ajax({
        type: 'GET', cache: true, contentType: false, processData: true,
        url: '{{ route("pages.getMedia") }}',
        data: {},
        success: (a) => {
            $('#modalMedia .modal-body').html(a);
        },
        error: (a) => {
            alert("Error #001, getData.");
        }
    });
});

$("#modalMediaImage").on("show.bs.modal", function(e) {
    $.ajax({
        type: 'GET', cache: true, contentType: false, processData: true,
        url: '{{ route("pages.getMediaImage") }}',
        data: {},
        success: (a) => {
            $('#modalMediaImage .modal-body').html(a);
        },
        error: (a) => {
            alert("Error #001, getData.");
        }
    });
});

$('.open-file').click(function(){
    $('input[name="image"]').trigger('click');
})

function resetImage(){
    $('input[name="image_media"]').val('');
    $('input[name="image"]').val('');
    $('#img-cover').attr('src','{{asset("assets/images/default/no_image.jpg")}}');
}

getOrder();
function getOrder(){
    $.ajax({
        type: 'GET', cache: true, contentType: false, processData: true,
        url: '{{ route("pages.getOrder") }}',
        data: {
            category:'dpo',
            edit:'false',
        },
        success: (a) => {
            $('select[name="order"]').html(a);
        },
        error: (a) => {
            alert("Error #001, getData.");
        }
    });
}
$('#formIn').submit(function (e) {
    loader(true);
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        type: 'POST',
        url: "{{ route('dpos.store') }}",
        data: formData,
        cache: false, contentType: false, processData: false,
        success: (a) => {
            showNotif(a.data.type, a.data.msg);
            $('#formIn').trigger('reset');
            resetImage();
            getOrder();
            loader(false);
        },
        error: (a) => {
            if(a.status == 422){
                clearValidate('#formIn');
                $.each(a.responseJSON.errors, function(key, value){
                    if(key=='image'){
                        showNotif('error', value);
                    }
                    showValidate('#formIn',key, value);
                })
            }else{
                showNotif('error',a.status);
            }
            loader(false);
        }
    });
});

</script>
