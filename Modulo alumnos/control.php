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
            $("#tableRegDiv").hide();
            $("#noRetrasosDiv").hide();
            $("#loaderDiv2").html('<img src="imagenes/loader.gif" id="loader"/>');
            $.ajax({
               type: 'POST',
               url: 'consultarRegistro.php',
               data: {
                   action: 'asistencia',
                   text: $("#estudian").val()
               },
                success: function(response) {
                    $("#loader").remove();
                    $("#tableRegDiv").show();
                    $("#tableReg tbody").append(response);
                    
                }
            });    
        } else{
            $("#tableRegDiv").hide();
            $("#noRetrasosDiv").hide();
            $("#tableReg").html();
        }
    });
});

</script>

<div id="Paneles">
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>Consultar Asistencias</h2>
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
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-9">
                            <label for="estudiantes" class="col-sm-2 control-label">Asistencia:</label><br/>
                            <div id="loaderDiv2"></div>
                            <div id="tableRegDiv" style="display:none;">
                                <table id="tableReg" class="table">
                                    <thead>
                                        <tr>
                                            <th>Materia</th>
                                            <th>Día y Hora de Materia</th>
                                            <th>Asistencia</th>
                                            <th>Retraso</th>
                                        </tr>
                                        <tbody></tbody>
                                    </thead>
                                </table> 
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
