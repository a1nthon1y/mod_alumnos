<?php
include ("header.php");
include("valDocente.php");
require_once("registro.php");
require_once("consultar.php");
require_once("imagen.php");

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
                <div id="docentes" class="tab-pane fade active in" style="margin-top:10px;">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
            					<div class="col-md-8">
            					    <b>Docente: <?php echo ($_SESSION['primerNombre']." ".$_SESSION['primerApellido']); ?></b>
            					 </div>
            					<div class="col-md-4">
            					    <b><?php date_default_timezone_set('America/Aruba');
            					        echo date('l d-m-Y h:i a'); ?></b>
            					</div>
            				</div>
                        </div>
                         <div class="panel-body">
                             <div class="row">
            					<div class="col-md-12">
            						<div class="table-responsive" id="divTabla">  
                                        <table class="table">
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
                                            <tbody class="tbody" style="max-height:700px;overflow-y:scroll;" id="tbodyAsistencia">
                                          <?php 
                                                $dias = array('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes');
                                                $oddrow = true; 
                                                $m=0; $p=0;
                                                consultarDocenteHorario();
                                                if($error == ''){
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
                                                        echo '<td '.$css_class.'>'.$horas2[$i].'</td>'; ?>
                                                        <td colspan="5" <?php echo $css_class; ?>>RECESO</td>
                                              <?php   } else if($i==35){
                                                        echo '<td '.$css_class.'>'.$horas2[$i].'</td>'; ?>
                                                        <td colspan="5" <?php echo $css_class; ?>>RECESO</td>
                                              <?php   } else{
                                                            echo '<td '.$css_class.'>'.$horas2[$i].'</td>';
                                                            for($j=0;$j<5;$j++){
                                                                $p=0;
                                                                for($o=0; $o<count($curso); $o++){
                                                                    if($horas[$o] == $horas2[$i] && $dia[$o] == $dias[$j]){
                                            ?>
                                                                    <td <?php echo $css_class; ?>>
                                                                        <b><?php echo $materia[$o]; ?>
                                                                        <br/>
                                                                        <?php echo $curso[$o]; ?></b>
                                                                    </td>
                                            <?php                       $o=510000;
                                                                    
                                                                    } else{
                                                                        $p++;
                                                                    } 
                                                                }
                                                                if($p == count($curso)) echo "<td ".$css_class.">Libre</td>";
                                                            }
                                                      } ?>
                                                      </tr>
                                            <?php     $m++;
                                                    }
                                                } else echo "<tr><td>No hay horario registrado</td></tr>"; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!--<div id="asistenciaPanel" style="display:none;">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <div class="row">
            					                    <div class="col-md-2">
                                                        <button class="btn btn-default" id="btn-volverAsistencia">Volver</button>
                                                    </div>
                                                    <div class="col-md-10" id="headAsistencia">
                                                    </div>
                                            </div>
                                            <div class="panel-body" id="bodyAsistencia">
                                                
                                            </div>
                                    </div>-->
            					</div>
            				</div>
                         </div>
                     </div>
                </div>
            </div>
        </div>
    </div>
</div>
</center>
<?php include ("footer.html"); 
?>