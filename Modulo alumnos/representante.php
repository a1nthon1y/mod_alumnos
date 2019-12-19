<script>
    var full;
    function showHTML() {
        if(full == false) {
            $('.FormRepresentante').load('repreExi.php');
            full = true;
        }  else {
            $('.FormRepresentante').load('repreForm.html');  //ver arregarRepre.txt
            full = false;
        } 
    } 
</script>