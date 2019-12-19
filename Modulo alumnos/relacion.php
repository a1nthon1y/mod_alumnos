<?php
include ("header.php");
include("valAdmin.php");
require_once("registro.php");
require_once("consultar.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $rel_cedula = $_POST['rel_cedula'];
    for($i=1; $i<=10; $i++){
      for($j=1; $j<=5; $j++){
        $rel_hora[$i][$j] = $_POST['rel_hora'.$i.$j];
        $rel_materia[$i][$j] = $_POST['rel_materia'.$i.$j];
        $rel_curso[$i][$j] = $_POST['rel_curso'.$i.$j];
        if($rel_materia[$i][$j] != '' && $rel_curso[$i][$j] != ''){
          if(!registrarRelacion($rel_cedula, $rel_hora[$i][$j], $rel_materia[$i][$j], $rel_curso[$i][$j])){
          }else{
            $error = '';			
          }
        }
      }
    }
    
    
    /*$i = 1;
    while($_POST['dia'.$i] != ''){
      $diaHorarioC[$i] = $_POST['dia'.$i];
      $horaInicialC[$i] = $_POST['horaInicial'.$i];
      $horaFinalC[$i] = $_POST['horaFinal'.$i];
      if(!registrarHorarioClases($diaHorarioC[$i], $horaInicialC[$i], $horaFinalC[$i])){
        $error = '<p style="color:red;"> Hubo un error</p>'; 
        echo "fsfds";
      }else{
          
        $error = '';			
      }
      $i++;
    }*/
    
    if($error == ''){ ?>	    		
		<div class="alert alert-success">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		  	<strong>DATOS INSERTADOS CON EXITO!</strong>
		</div>									
<?php  
    } else{ ?>	    		
		<div class="alert alert-danger">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		  	<strong>HUBO UN ERROR: <?php echo $error; ?></strong>
		</div>									
<?php   	}
}
?>
<style type="text/css">
    .table_titles, .table_cells_odd, .table_cells_even {
      padding-right: 20px;
      padding-left: 20px;
      color: #000;
    }
    .table_titles {
      color: #FFF;
      background-color: #666;
    }
    .table_cells_odd {
      background-color: #CCC;
    }
    .table_cells_even {
      background-color: #FAFAFA;
    }
    body { font-size:12px; }
  </style>
    <script>
$(document).ready(function() {
    $("#docente_relacion").change(function(){
        if($("#docente_relacion option:selected").val() != ''){
            $("#selectRelacionDiv").hide();
            $("#loaderDiv").append('<img src="imagenes/loader.gif" id="loader"/>');
            $.ajax({
               type: 'POST',
               url: 'horarioDocente.php',
               data: {
                  action: 'consulta', 
                  cedula:$("#docente_relacion").val()
               },
                success: function(response) {
                    $("#loader").remove();
                    $("#selectRelacionDiv").show();
                    $("#tablaRelacionDoce tbody").append(response);
                }
            });  
        } else{
            $("#selectRelacionDiv").hide();
        }
    });
});

</script>
<center>
<!-- Estos dos div Paneles y Container es para que todos los paneles mantengan el mismo ancho a excepcion del de login -->
<div id="Paneles" width="900">
    <div class="container" style="max-width:1200px;">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>Módulo de Relación</h2>
            </div>
            <div class="panel-body">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#registro">Registro</a></li>
                    <li><a data-toggle="tab" href="#consulta">Consulta</a></li>
                </ul>
                <div class="tab-content">
            <!-- REGISTRO -->
                    <div id="registro" class="tab-pane fade in active" style="margin-top:10px;">
                      <form id="formHoras" method="POST">
                        <div class="panel panel-default">
                          <div class="panel-heading" id="heading">
                            <div class="row">
                              <div class="col-md-4">
                                <label for="docente">Docente:</label>
                                <input type="text" class="form-control" id="textbox" name="rel_cedula2" min="1" placeholder="Cedula" autofocus /><br/>
                                <select class="form-control" name="rel_cedula" id="select" required>
                                    <?php echo consultarDocente(); ?>
                                </select>
                              </div>
                              <div class="col-md-8">
                                <div class="table-responsive" id="divTabla">          
                                  <table class="table" id="rel_horarioTable"></table>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group" style="height:auto">
                                        <div class="table-responsive" id="divTabla">  
                                          <table class="table" id="tablaHora">
                                            <thead class="thead">
                                              <tr>
                                                <th>Hora</th>
                                                <th>Lunes</th>
                                                <th>Martes</th>
                                                <th>Miercoles</th>
                                                <th>Jueves</th>
                                                <th>Viernes</th>
                                              </tr>
                                            </thead>
                                            <tbody class="tbody" style="max-height:700px;overflow-y:scroll;" id="tbodyRelacion">
                                          <?php $oddrow = true; 
                                                $k=0; $m=0;
                                                consultarHorarioClases();
                                                for($i=0;$i<50;$i+=5){ 
                                                  if ($oddrow){ 
                                                    $css_class=' class="table_cells_odd"'; 
                                                  }else{ 
                                                    $css_class=' class="table_cells_even"'; 
                                                  } 
                                                  $oddrow = !$oddrow; 
                                          ?>
                                                  <tr>
                                          <?php   
                                                  if($i==10){
                                                    echo '<td '.$css_class.'>'.$inicio[$i].' - '.$fin[$i].'</td>'; $k+=5;?>
                                                    <td colspan="5" <?php echo $css_class; ?>>RECESO</td>
                                          <?php   } else if($i==35){
                                                    echo '<td '.$css_class.'>'.$inicio[$i].' - '.$fin[$i].'</td>'; $k+=5;?>
                                                    <td colspan="5" <?php echo $css_class; ?>>RECESO</td>
                                          <?php   } else{
                                                    echo '<td '.$css_class.'>'.$inicio[$i].' - '.$fin[$i].'</td>'; 
                                                    for($j=0;$j<5;$j++){ ?>
                                                      <td <?php echo $css_class; ?>>
                                                        <input type="hidden" value="<?php echo $id[$k]; ?>" name="rel_hora<?php echo ($m+1).($j+1); ?>" />
                                                        <a class="btn btn-default" name="rel_button<?php echo ($m+1).($j+1); ?>" id="rel_button">ASIGNAR</a>
                                                        <select class="form-control" name="rel_curso<?php echo ($m+1).($j+1); ?>" id="rel_curso" style="font-size:12px;display:none;" >
                                                          <?php consultarGrados4(); ?>
                                                        </select>
                                                        <br/>
                                                        <select class="form-control" name="rel_materia<?php echo ($m+1).($j+1); ?>" id="rel_materia<?php echo ($m+1).($j+1); ?>" style="font-size:12px;display:none;" >
                                                          <option value="">Seleccione una materia</option>
                                                          <?php consultarMateria(); ?>
                                                        </select>
                                                      </td>
                                              <?php $k++; 
                                                    }
                                                  } ?>
                                                  </tr>
                                        <?php     $m++;
                                                }  ?>
                                            </tbody>
                                          </table>
                                         </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <center>
                                <button type="submit" class="btn btn-success" name="acepRelacion">Aceptar</button>
                                <button type="reset" class="btn btn-info" name="cancelar">Cancelar</button>
                                </center>
                            </div>
                          </div>  
                        </div>
                      </form>
                    </div>
            
            <!-- CONSULTA -->
                    <div id="consulta" class="tab-pane fade" style="margin-top:10px;">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h2>Consultar Relacion</h2>
                            </div>
                            <div class="panel-body">
                                <form class="form-horizontal" role="form" method="post" id="retraso" name="retraso">
                                    <div class="row">
                                        <div class="col-sm-8 col-sm-offset-2"> 
                                            <div class="form-group">
                                                <label for="curso" class="col-sm-3 control-label">Profesor:</label>
                                                <div class="col-sm-9" id="selectCursoDiv">
                                                    <select class="form-control" name="docente_relacion" id="docente_relacion" required>
                                                    <?php consultarDocente(); ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="loaderDiv"></div>
                                    <div class="row">
                                        <div class="col-sm-9">
                                            <label for="estudiantes" class="col-sm-2 control-label">Horario:</label>
                                            <div id="selectRelacionDiv" style="display:none;">
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
            </div>
        </div>
        
        
        
    </div>
</div>
</center>

