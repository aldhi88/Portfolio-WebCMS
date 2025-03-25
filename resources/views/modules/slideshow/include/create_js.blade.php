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
    setup: function (editor) {
        editor.on('init', function (e) {
            editor.setContent(`
                <h3 data-animation="animated slideInLeft">Bersama Kami</h3>
                <h1 data-animation="animated slideInUp">Wujudkan Pelayanan Jujur Adil Transparan</h1>
                <a class="btn btn-light border btn-md" href="#" data-animation="animated slideInUp">Sambutan</a> <a class="btn btn-theme effect btn-md" href="#" data-animation="animated slideInUp">Visi Misi</a>
            `);
        });
    }
});

getOrder();
function getOrder(){
    $.ajax({
        type: 'GET', cache: true, contentType: false, processData: true,
        url: '{{ route("pages.getOrder") }}',
        data: {
            category:'main_slider',
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

function resetImage(){
    $('input[name="image_media"]').val('');
    $('input[name="image"]').val('');
    $('#img-cover').attr('src','{{asset("assets/images/default/no_image.jpg")}}');
}

$('#formIn').submit(function (e) {
    loader(true);
    tinymce.triggerSave();
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        type: 'POST',
        url: "{{ route('pages.store') }}",
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
