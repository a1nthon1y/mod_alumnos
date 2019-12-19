<?php
 include ("header.php");
 include("valUser.php");
 include ("registro.php");
 require_once("consultar.php");
 $conn = new connection();
 $db = $conn->connect();
?>
<script>
$(document).ready(function() {
    $("#report_curso").change(function(){
        if($("#report_curso option:selected").val() != ''){
            $("#estudianteDiv").hide();
            $("#loaderDiv1").append('<img src="imagenes/loader.gif" id="loader"/>');
            $.ajax({
               type: 'POST',
               url: 'opciones.php',
               data: {
                   text:$("#report_curso").val()
               },
                success: function(response) {
                    $("#loader").remove();
                    $("#estudianteDiv").show();
                    $("#estudian").html(response);
                }
            });  
        } else{
            $("#estudianteDiv").hide();
        }
    });
    
     $("#estudian").change(function(){
        if($("#estudian option:selected").val() != ''){
            $("#selectRegDiv").hide();
            $("#noRetrasosDiv").hide();
            $("#loaderDiv2").html('<img src="imagenes/loader.gif" id="loader"/>');
            $.ajax({
               type: 'POST',
               url: 'consultarRegistro.php',
               data: {
                   action: 'retraso',
                   text:$("#estudian").val()
               },
                success: function(response) {
                    $("#loader").remove();
                    $("#selectRegDiv").show();
                    $("#retrasos").html(response);
                    
                }
            });    
        } else{
            $("#selectRegDiv").hide();
            $("#noRetrasosDiv").hide();
            $("#retrasos").html();
        }
    });
});

</script>

<div id="Paneles">
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>Consultar retrasos</h2>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="post" id="retraso" name="retraso">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2"> 
                            <div class="form-group">
                                 <label for="curso" class="col-sm-3 control-label">Curso:</label>
                                <div class="col-sm-9" id="selectCursoDiv">
                                    <select class="form-control" name="report_curso" id="report_curso" required>
                                    <?php consultarGrados4(); ?>
                                    </select>
                                </div>
                            </div>
                            <div id="loaderDiv1"></div>
                            <div class="form-group" id="estudianteDiv" style="display:none;">
                                <label for="estudiante" class="col-sm-3 control-label">Estudiantes:</label>
                                <div class="col-sm-9" id="selectEstDiv">
                                    <select class="form-control" name="estudian" id="estudian" required>
                                    
                                    </select>
                                </div>
                            </div>
                            <p style="text-align: justify"> Seleccione el (los) registro(s) a actualizar (puede seleccionar varios <br/>
                            manteniendo la tecla "Ctrl" presionada y haciendo clic a cada registro por <br> 
                            separado). Los registros justificados pasaran a No justificados y viceversa.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-9">
                            <label for="estudiantes" class="col-sm-2 control-label">Retrasos:</label>
                            <div id="loaderDiv2"></div>
                            <div id="selectRegDiv" style="display:none;">
                                <select multiple class="form-control" size="6" name= "retrasos[]" id="retrasos" style="height:130px" required>
                                </select>  
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-primary btn-sm" name="cambio" id="cambio">Aplicar cambios</button>
                        </div>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>
