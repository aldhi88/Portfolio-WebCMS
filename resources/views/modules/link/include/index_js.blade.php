<script>
// $('#formIn').submit(function (e) {
$('body').on('submit','#formIn',function(e){
    loader(true);
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        type: 'POST',
        url: "{{ route('links.store') }}",
        data: formData,
        cache: false, contentType: false, processData: false,
        success: (a) => {
            showNotif(a.data.type, a.data.msg);
            replaceLinkContent(a.other.active);
            loader(false);
        },
        error: (a) => {
            if(a.status == 422){
                clearValidate('#formIn');
                $.each(a.responseJSON.errors, function(key, value){
                    if(key=='name' || key=='link'){
                        showNotif('error',value);
                    }
                    // showValidate('#formIn',key, value);
                })
            }else{
                showNotif('error',a.status);
            }
            loader(false);
        }
    });
});

$("#modalPage").on("show.bs.modal", function(e) {
    var category = $(e.relatedTarget).data('key');
    $.ajax({
        type: 'GET', cache: true, contentType: false, processData: true,
        url: '{{ route("links.getPage") }}',
        data: {category:category},
        success: (a) => {
            $('#modalPage .modal-body').html(a);
        },
        error: (a) => {
            alert("Error #001, getData.");
        }
    });
});

$("#modalPost").on("show.bs.modal", function(e) {
    var category = $(e.relatedTarget).data('key')
    $.ajax({
        type: 'GET', cache: true, contentType: false, processData: true,
        url: '{{ route("links.getPost") }}',
        data: {category:category},
        success: (a) => {
            $('#modalPost .modal-body').html(a);
        },
        error: (a) => {
            alert("Error #001, getData.");
        }
    });
});

function pickPage(key) {
    $('#myTable').on('click','.pick',function(){
        var link = $(this).attr('link');
        $('#modalPage').modal('hide');
        $('#link_'+key).val(link);
    })
}
function pickPost(key) {
    $('#myTable2').on('click','.pick',function(){
        var link = $(this).attr('link');
        $('#modalPost').modal('hide');
        $('#link_'+key).val(link);
    })
}

function replaceLinkContent(active){
    $.ajax({
        type: 'GET', cache: true, contentType: false, processData: true,
        url: '{{ route("links.getLinkForm") }}',
        data: {active:active},
        success: (a) => {
            $('#link-form').html(a);
        },
        error: (a) => {
            alert("Error #001, getData.");
        }
    });
}

$('#upForm').submit(function (e) {
    loader(true);
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        type: 'POST',
        url: "{{ url('bo/post-categories') }}/",
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

$("body").on("click",".up", function(e) {
    $.ajax({
        type: 'POST', cache: false, processData: true,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: '{{ route("links.upOrder") }}',
        data: {
            id:$(this).attr('data-id'),
        },
        success: (a) => {
            replaceLinkContent(a.data.active);
        },
        error: (a) => {
            alert("Error #001, getData.");
        }
    });
});

$("body").on("click",".down", function(e) {
    $.ajax({
        type: 'POST', cache: true, processData: true,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: '{{ route("links.downOrder") }}',
        data: {
            id:$(this).attr('data-id'),
        },
        success: (a) => {
            replaceLinkContent(a.data.active);
        },
        error: (a) => {
            alert("Error #001, getData.");
        }
    });
});

$("body").on("click",".delete", function(e) {
    $.ajax({
        type: 'POST', cache: true, processData: true,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: "{{ url('bo/links') }}/"+$(this).attr('data-id'),
        data: {
            _method:'DELETE',
            order:$(this).attr('data-order'),
            category:$(this).attr('data-category'),
        },
        success: (a) => {
            replaceLinkContent(a.data.active);
        },
        error: (a) => {
            alert("Error #001, getData.");
        }
    });
});


//setup before functions
var typingTimer;                //timer identifier
var doneTypingInterval = 0;  //time in ms, 5 second for example
var $input = $('.link-edit');

//on keyup, start the countdown
$input.on('change', function () {
    clearTimeout(typingTimer);
    typingTimer = setTimeout(doneTyping, doneTypingInterval, $(this));
});

//on keydown, clear the countdown 
$input.on('keydown', function () {
    clearTimeout(typingTimer);
});

//user is "finished typing," do something
function doneTyping (el) {
    $.ajax({
        type: 'POST', cache: true, processData: true,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: "{{ url('bo/links') }}/"+el.attr('data-id'),
        data: {
            _method:'PUT',
            edit:el.attr('data-edit'),
            value:el.val(),
        },
        success: (a) => {
            showNotif(a.data.type,a.data.msg);
        },
        error: (a) => {
            alert("Error #001, getData.");
        }
    });
}



</script>