<?php
 include ("header.php");
 include("valUser.php");
 include ("connection.php");
 require_once("consultar.php");
 $conn = new connection();
 $db = $conn->connect();
 
 ?>
<script>
$(document).ready(function() {
    $("#report_curso").change(function(){
        $("#selectCursoDiv").append('<div id="loaderDiv"><img src="imagenes/loader.gif" id="loader"/></div>');
        $.ajax({
           type: 'POST',
           url: 'opciones.php',
           data: {
               text:$("#report_curso").val()
           },
            success: function(response) {
                $("#loaderDiv").remove();
                $("#repor_estudiantes").html(response);
            }
        });    
    });
 });
 
</script>
 
<div id="Paneles">
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>Generar reportes</h2>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="post" id="reporte" name="reporte"  action="pdf.php">
                    <div class="row">
                        <div class="col-sm-8"> 
                            <div class="form-group">
                                 <label for="curso" class="col-sm-2 control-label">Curso:</label>
                                <div class="col-sm-10" id="selectCursoDiv">
                                    <select class="form-control" name="report_curso" id="report_curso" required>
                                    <?php consultarGrados4(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                 <label for="estudiantes" class="col-sm-2 control-label">Estudiantes:</label>
                                <div class="col-sm-10">
                                    <select class="form-control" size="6" name= "repor_estudiantes" id="repor_estudiantes" required>
                                    
                                    </select>  
                                </div>
                            </div>
                        </div>
                    
                        <div class="col-sm-4"> 
                            <button type="submit" class="btn btn-primary btn-sm" name="descargar">Descargar reporte</button><br> <br>
                             <button type="submit" class="btn btn-primary btn-sm" name="enviar">Enviar reporte</button>
                        </div>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>
<?php include ("footer.html");
?>