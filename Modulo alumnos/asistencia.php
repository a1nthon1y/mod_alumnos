<?php
include ("header.php");
include ("valDocente.php");
require_once("registro.php");
require_once("consultar.php");
require_once("imagen.php");

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
<center>
<!-- Estos dos div Paneles y Container es para que todos los paneles mantengan el mismo ancho a excepcion del de login -->
<div id="Paneles">
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>Módulo de asistencia</h2>
            </div>
            <div class="panel-body">
                <?php 
                    date_default_timezone_set('America/Aruba'); 
                    $date = date('l d-m-Y h:i a'); 
                    
                    $dias = array('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes');
                    $days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');
                    for($i=0; $i<count($days); $i++){
                        if(date("l", strtotime($date)) == $days[$i]){
                            $dia = $dias[$i];
                        }
                    }
                ?>
                <div id="docentes" class="tab-pane fade active in" style="margin-top:10px;">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <?php consultarAsistenciaPanel($_SESSION['cedula'], $date); ?>
            					<div class="col-md-3">
            					    <b>Docente: <?php echo ($_SESSION['primerNombre']." ".$_SESSION['primerApellido']); ?></b>
            					</div>
            					<div class="col-md-3">
            					    <input type="hidden" id="curso" value="<?php echo $curso; ?>" />
            					    Curso: <?php echo $curso; ?>
            					</div>
            					<div class="col-md-2">
            					    Materia: <?php echo $materia; ?>
            					</div>
            					<div class="col-md-4">
            					    <b><?php echo $dia." ".date('d-m-Y h:i a'); ?></b>
            					</div>
            				</div>
                        </div>
                         <div class="panel-body">
                        <?php if($mensaje == ''){ ?>
                             <div class="row">
                                <div class="col-md-6" style="text-align:right;">
                                     Estado del sensor: <b><p id="mensajeBtnAsitencia">Apagado</p></b>
                                </div>
                                <div class="col-md-6" style="text-align:left;">
                                     <button type="button" id="btn-asistencia" class="btn btn-danger" value="off"><span class="glyphicon glyphicon-off"></span></button><br/>
                                </div>
                            </div>
                            <div class="row">
                                 <div class="col-md-5" style="padding-right:0px;">
                                     <label for="listaEstudiantes" class="control-label">Lista de estudiantes inscritos</label>
                                     <select class="form-control" id="origenEstudiante" name="origenEstudiante[]" size="20" multiple>
                            <?php for($i=0; $i<count($estCedula); $i++){ ?>
                                        <option value="<?php echo $estCedula[$i]; ?>"><?php echo $estNombre[$i]; ?></option>
                                        
                            <?php } ?>
                                     </select>
                                 </div>
                                 <div class="col-md-2" style="padding:0px;margin-top:25%;">
                                     <button type="button" id="" class="btn btn-info btn-sm" onclick="pasar('destinoEstudiante', 'origenEstudiante');"><span class="glyphicon glyphicon-arrow-left"></span></button>
                                     <button type="button" id="" class="btn btn-info btn-sm" onclick="pasar('origenEstudiante', 'destinoEstudiante');"><span class="glyphicon glyphicon-arrow-right"></span></button>
                                 </div>
                                 <div class="col-md-5" style="padding-left:0px;">
                                     <label for="listaEstudiantes" class="control-label">Lista de estudiantes asistentes</label>
                                     <select class="form-control" id="destinoEstudiante" name="destinoEstudiante[]" size="20" multiple>
                                     </select>
                                 </div>
                             </div>
                             <br/>
                             <div class="form-group">
                                <center>
                                <button type="submit" class="btn btn-success" name="acepAsistencia">Aceptar</button>
                                <button type="reset" class="btn btn-info" name="cancelar">Cancelar</button>
                                </center>
                            </div>
                        <?php } else{ ?>
                            <div class="row">
                                <div class="col-md-12" style="text-align:center;">
                                     <b><h1><?php echo $mensaje; ?></h1></b>
                                </div>
                            </div>
                        <?php } ?>
                         </div>
                     </div>
                </div>
            </div>
        </div>
    </div>
</div>
</center>
