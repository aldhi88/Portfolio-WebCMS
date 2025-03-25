<script>
tinymce.init({
    selector: "textarea#elm1",
    height: 500,
    plugins: [
        "advlist autolink link image lists charmap hr",
        "searchreplace wordcount code fullscreen media",
        "table directionality emoticons paste",
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | preview media fullpage | forecolor backcolor",
    style_formats: [
        { title: "Bold text", inline: "b" },
        { title: "Red text", inline: "span", styles: { color: "#ff0000" } },
        { title: "Red header", block: "h1", styles: { color: "#ff0000" } },
        { title: "Example 1", inline: "span", classes: "example1" },
        { title: "Example 2", inline: "span", classes: "example2" },
        { title: "Table styles" },
        { title: "Table row 1", selector: "tr", classes: "tablerow1" },
    ],
});
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

$('input[name="title"]').on('keyup',function(){
    var text = $(this).val();
    var slug = text.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
    $('#slug').val(slug);
    $('#summary').val(text);
})

$('#slug').bind('input', function(){
    $(this).val(function(_, v){
        return v.replace(/\s+/g, '');
    });
});

getOrder();
function getOrder(){
    $.ajax({
        type: 'GET', cache: true, contentType: false, processData: true,
        url: '{{ route("pages.getOrder") }}',
        data: {
            category:'leader',
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
    tinymce.triggerSave();
    var formData = new FormData(this);
    $.ajax({
        type: 'POST',
        url: "{{ route('pages.store') }}",
        data: formData,
        cache: false, contentType: false, processData: false,
        success: (a) => {
            showNotif(a.data.type, a.data.msg);
            location.reload();
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
