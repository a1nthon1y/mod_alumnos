<script>
    function PreviewImg(input) {
        if (input.files && input.files[0]) {
            if(inArray(input.value) == false) {
                $('#preview')
                .attr('src','imagenes/no_disponible.png')
                .width(120)
                .height(120);
            }
            else {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#preview') 
                        .attr('src', e.target.result)
                        .width(120)
                        .height(120);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }else {
            $('#preview').attr('src','imagenes/default_avatar_male.jpg');
        }
    }
    
    function inArray(img) {
        var exts = ["jpg","png","jpeg"];
        var imgExt = img.substring(img.lastIndexOf('.') + 1).toLocaleLowerCase();
        for (var i = 0; i < exts.length; i++) {
            if(imgExt == exts[i]) return true;
        }
        return false;
    } 
    
    //falta el boton reset
</script>