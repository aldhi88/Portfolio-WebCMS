<script>
$('input[name="name"]').val($('input[name="bind_name"]').val());
$('input[name="bind_name"]').on('keyup',function(){
    var text = $(this).val();
    $('input[name="name"]').val(text);
})

</script>