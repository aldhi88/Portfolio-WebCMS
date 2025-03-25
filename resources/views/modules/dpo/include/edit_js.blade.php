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
    
    getOrder();
    function getOrder(){
        $.ajax({
            type: 'GET', cache: true, contentType: false, processData: true,
            url: '{{ route("pages.getOrder") }}',
            data: {
                category:'team',
                edit:'{{$edit["order"]}}',
            },
            success: (a) => {
                $('select[name="order"]').html(a);
            },
            error: (a) => {
                alert("Error #001, getData.");
            }
        });
    }
    
    $('#formUp').submit(function (e) {
        loader(true);
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: "{{ url('bo/pages') }}/{{ $edit['id'] }}",
            data: formData,
            cache: false, contentType: false, processData: false,
            success: (a) => {
                showNotif(a.data.type, a.data.msg);
                loader(false);
            },
            error: (a) => {
                if(a.status == 422){
                    clearValidate('#formUp');
                    $.each(a.responseJSON.errors, function(key, value){
                        if(key=='image'){
                            showNotif('error', value);
                        }
                        showValidate('#formUp',key, value);
                    })
                }else{
                    showNotif('error',a.status);
                }
                loader(false);
            }
        });
    });
    </script>