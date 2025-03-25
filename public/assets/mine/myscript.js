$(function() {
    // hide loader ketika halaman selesai di load
    $('.loading').fadeOut(500);

    // clear warning error ketika input diisi
    $("input").keypress(function(){
        $(this).removeClass("is-invalid").closest(".form-group").find(".msg").empty();
    })
    
    // active cursor pada form biasa
    $('.focus').focus();

    // active cursor pada form modal
    $(".modal").on("shown.bs.modal", function() {
        $('.focus').focus();
    });
});


function showPreview(input,preview) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
        $('#'+preview).attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function showNotif(type,msg){
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": 300,
        "hideDuration": 1000,
        "timeOut": 5000,
        "extendedTimeOut": 1000,
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    toastr[type](msg);
}

// function form show or hide loader
function loader(value){
    if(value==false){
        $('.loading').fadeOut(100);
    }else{
        $('.loading').fadeIn(100);
    }
}

// function untuk pencarian di datatable untuk setiap column
function initSearchCol(table,headerId,inputClass){
    $(headerId+' th').each(function() {
        var title = $(this).text();
        var off = $(this).attr("off");
        var align = $(this).attr('center');
        if (typeof align != typeof undefined) {
            var align = 'text-center';
        }
        if (typeof off == typeof undefined) {
            $(this).html('<input placeholder="'+title+'" type="text" class="'+inputClass+' '+align+' form-control form-control-sm py-1 w-100"/>');
        }
    });
    var timeout = null;
    $(headerId).on('keyup', '.'+inputClass,function (e) {
        clearTimeout(timeout);
        var dataThis = $(this);
        var thisValue = this.value;
        timeout = setTimeout(function() {
            table.column( dataThis.parent().index() ).search( thisValue ).draw();
        }, 1000);
    });
}

// menampilkan validasi error disetiap input
function showValidate(el, key, value){
    $(el+' .'+key).text(value);
    $(el+' input[name="'+key+'"]').addClass('is-invalid');
}

// menghapus validasi error di setiap input
function clearValidate(el){
    $(el+' input').removeClass('is-invalid');
    $('.msg').text('');
}

