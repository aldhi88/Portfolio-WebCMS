

<script>
    $('#inForm').submit(function (e) {
         loader(true);
         e.preventDefault();
         var formData = new FormData(this);
         $.ajax({
             type: 'POST',
             url: "{{ route('attributes.store') }}",
             data: formData,
             cache: false, contentType: false, processData: false,
             success: (a) => {
                 showNotif(a.data.type, a.data.msg);
                 loader(false);
             },
             error: (a) => {
                 if(a.status == 422){
                     clearValidate('#inForm');
                     $.each(a.responseJSON.errors, function(key, value){
                         showValidate('#inForm',key, value);
                     })
                 }else{
                     showNotif('error',a.status);
                 }
                 loader(false);
             }
         });
     });
 </script>