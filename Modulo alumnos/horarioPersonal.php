<?php
include ("header.php");
include("valAdmin.php");
require_once("registro.php");
require_once("modificar.php");
require_once("consultar.php");
$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if(isset($_POST['acepHorasP'])){
    $i = 1;
    while($_POST['dia'.$i] != ''){
      $diaHorarioP[$i] = $_POST['dia'.$i];
      $horaInicialP[$i] = $_POST['horaInicial'.$i];
      $horaFinalP[$i] = $_POST['horaFinal'.$i];
      if(!registrarHorarioPersonal($diaHorarioP[$i], $horaInicialP[$i], $horaFinalP[$i])){
        $error = '<p style="color:red;"> Hubo un error</p>'; 
      }else{
          
        $error = '';			
      }
      $i++;
    }
    
    if($error == ''){ ?>	    		
  		<div class="alert alert-success">
  			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  		  	<strong>DATOS INSERTADOS CON EXITO!</strong>
  		</div>									
<?php  
    } else{ ?>	    		
  		<div class="alert alert-danger">
  			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  		  	<strong>HUBO UN ERROR</strong>
  		</div>									
<?php   	}
  }
}
?>

<center>
<!-- Estos dos div Paneles y Container es para que todos los paneles mantengan el mismo ancho a excepcion del de login -->
<div id="Paneles">
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>Módulo de Hora del Personal</h2>
            </div>
            <div class="panel-body">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#registro">Registro</a></li>
                    <li><a data-toggle="tab" href="#consulta">Consulta</a></li>
                </ul>
                <div class="tab-content">
            <!-- REGISTRO -->
                    <div id="registro" class="tab-pane fade in active" style="margin-top:10px;">
                        <div class="panel panel-default">
                          <div class="panel-heading" id="heading">
                             <label for="materia">Aumentar:</label>
                            <button type="button" class="btn btn-default btn-sm" onclick='agregarFilaHoras("tablaHora")'>
                                <span class="glyphicon glyphicon-plus"></span>
                            </button>
                            <label for="materia">Disminuir:</label>
                            <button type="button" class="btn btn-default btn-sm" onclick='borrarUltimaFila("tablaHora")'>
                                <span class="glyphicon glyphicon-minus"></span>
                            </button>
                          </div>
                          <div class="panel-body">
                            <form id="formHoras" method="POST">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group" style="height:auto">
                                            <div class="table-responsive" id="divTabla">          
                                              <table class="table" id="tablaHora">
                                                <thead class="thead">
                                                  <tr>
                                                    <th>Dia</th>
                                                    <th>Hora Inicial</th>
                                                    <th>Hora Final</th>
                                                  </tr>
                                                </thead>
                                                <tbody class="tbody">
                                            <?php for($i=1; $i <= 3; $i++){ ?>
                                                  <tr>
                                                    <td>
                                                      <select class="form-control" name="dia<?php echo $i; ?>" required>
                                                        <option value="Todos">Todos</option>
                                                        <option value="Lunes">Lunes</option>
                                                        <option value="Martes">Martes</option>
                                                        <option value="Miercoles">Miercoles</option>
                                                        <option value="Jueves">Jueves</option>
                                                        <option value="Viernes">Viernes</option>
                                                      </select></td>
                                                    <td><input class="form-control" type="time" name="horaInicial<?php echo $i; ?>" min="7:00:00" max="18:00:00"  required/></td>
                                                    <td><input class="form-control" type="time" name="horaFinal<?php echo $i; ?>" min="7:00:00" max="18:00:00" required/></td>
                                                  </tr>
                                              <?php } ?>
                                                </tbody>
                                              </table>
                                             </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group" style="height:auto">
                                            <div class="table-responsive" id="divTabla">          
                                              <table class="table" id="tablaHora">
                                                <thead class="thead">
                                                  <tr>
                                                    <th>Horarios</th>
                                                  </tr>
                                                </thead>
                                                <tbody class="tbody" id="tbody">
                                                  <?php consultarHorarioPersonal(); ?>
                                                </tbody>
                                              </table>
                                             </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <center>
                                    <button type="submit" class="btn btn-success" name="acepHorasP">Aceptar</button>
                                    <button type="reset" class="btn btn-info" name="cancelar">Cancelar</button>
                                    </center>
                                </div>
                            </form>
                          </div>  
                        </div>
                    </div>
            
            <!-- CONSULTA -->
                    <div id="consulta" class="tab-pane fade" style="margin-top:10px;">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="panel panel-default">
                                    <div class="panel-body" style="padding-top:4px;">
                                        <h3>Modificar Horarios</h3>
                                        <div class="table-responsive" id="horarioPTableDiv">          
                                          <table class="table" id="usuarioTable">
                                            <thead>
                                              <tr>
                                                <th>Horarios Registrados</th>
                                                <th></th>
                                              </tr>
                                            </thead>
                                            <tbody id="bodyUsuarioTable">
                                            <?php consultarHorarioPersonal3(); 
                                            for($i=0; $i < count($id); $i++){ 
                                            ?>
                                                <tr>
                                                  <form method="POST">
                                                    <td>
                                                        <input type="hidden" value="<?php echo $id[$i]; ?>" name="idHorarioP" />
                                                        <?php echo $dia[$i]." - ".$horas[$i]; ?>
                                                    </td>
                                                    <td><button type="button" class='btn btn-info' id="btn-modifyHorarioP" onclick="modifyHorarioP(<?php echo $id[$i].", '".$inicio[$i]."', '".$fin[$i]."', '".$dias[$i]."'"; ?>);"><i class='glyphicon glyphicon-pencil'></i></button>
                                                    <button type="submit" class='btn btn-danger' name="deleteHorarioP" id="deleteHorarioP"><i class='glyphicon glyphicon-remove'></i></button></td>
                                                  </form></tr>
                                            <?php } ?>
                                            </tbody>
                                          </table>
                                        </div>
                                        <div class="row" id="modHorarioPDiv" style="display:none;">
                                            <form class="form-horizontal" role="form" method="post" id="horarioPConsultaForm" name="horarioPConsultaForm">
                                                <div class="col-md-12 ">
                                                    <div class="form-group">
                                                      <input type="hidden" name="idHorarioP" id="idHorarioP" />
                                                        <label for="dias" class="col-sm-4 control-label">Dias:</label>
                                                        <div class="col-md-8">
                                                            <select class="form-control" name="diaHorarioP" id="diaHorarioP" required>
                                                              <option value="Todos">Todos</option>
                                                              <option value="Lunes">Lunes</option>
                                                              <option value="Martes">Martes</option>
                                                              <option value="Miercoles">Miercoles</option>
                                                              <option value="Jueves">Jueves</option>
                                                              <option value="Viernes">Viernes</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inicio" class="col-sm-4 control-label">Hora inicial:</label>
                                                        <div class="col-md-8">
                                                            <input class="form-control" type="time" name="inicioHorarioP" id="inicioHorarioP" min="7:00:00" max="15:00:00" step="60" required/></td>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="fin" class="col-sm-4 control-label">hora final:</label>
                                                        <div class="col-md-8">
                                                            <input class="form-control" type="time" name="finHorarioP" id="finHorarioP" min="7:00:00" max="15:00:00" step="60" required/></td>
                                                        </div>
                                                    </div> 
                                                    <div id="div-btn" class="form-group">
                                                        <button type="submit" class="btn btn-success" name="modHorarioP">Aceptar</button>
                                                        <button type="button" class="btn btn-info" id="cancelarModHorarioP">Cancelar</button>
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
        </div>
    </div>
</div>
</center>
