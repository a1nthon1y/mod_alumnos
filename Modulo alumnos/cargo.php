<?php
include ("header.php");
include ("valAdmin.php");
require_once("registro.php");
require_once("modificar.php");
require_once("consultar.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['acepCargo'])){
        $i = 1;
        while($_POST['descripcionCargo'.$i] != ''){
          $cargoDesc[$i] = $_POST['descripcionCargo'.$i];
        	if(!registrarCargos($cargoDesc[$i])){
            $error[0] = '<p style="color:red;"> Hubo un error</p>'; //acomodar lo qeu de hay unas no ingresan
          }else{
            $error[0] = '';			
          }
          $i++;
        }
        
        if($error[0] == ''){
          $error[0] = '<p style="color:green;">Datos registrados exitosamente!</p>';
          /*header('Location: materias.php');
          exit;*/
        }
    }   
    if(isset($_POST['modCargo'])){
      modificarCargo();
    }
    
    if(isset($_POST['deleteCargo'])){
      deleteCargo();
    }
}
?>

<center>
<!-- Estos dos div Paneles y Container es para que todos los paneles mantengan el mismo ancho a excepcion del de login -->
<div id="Paneles">
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>Módulo de Cargos</h2>
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
                          <div class="panel-heading">
                              <label for="materia">Aumentar:</label>
                              <button type="button" class="btn btn-default btn-sm" id="btn-agregarCargo" onclick='agregarFilaCargos("tablaCargo")'>
                                  <span class="glyphicon glyphicon-plus"></span>
                              </button>
                              <label for="materia">Disminuir:</label>
                              <button type="button" class="btn btn-default btn-sm" onclick='borrarUltimaFila("tablaCargo")'>
                                  <span class="glyphicon glyphicon-minus"></span>
                              </button>
                          </div>
                          <div class="panel-body">
                            <form class="form" role="form" name="formCargo" method="post">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group" style="height:auto">
                                            <div class="table-responsive" id="divTabla">          
                                              <table class="table" id="tablaCargo">
                                                <thead>
                                                    <tr>
                                                        <th>Cargo</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="bodyTabla">
                                                    <tr>
                                                        <td><input class="form-control" type="text" name="descripcionCargo1" placeholder="Docente" required/></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input class="form-control" type="text" name="descripcionCargo2" placeholder="Obrero" required/></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input class="form-control" type="text" name="descripcionCargo3" placeholder="Secretaria" required/></td>
                                                    </tr>
                                                </tbody>
                                              </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group" style="height:auto">
                                            <div class="table-responsive" id="divTabla">          
                                              <table class="table" id="tablaCargo">
                                                <thead class="thead">
                                                    <tr>
                                                        <th>Cargos Registrados</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="bodyTabla" class="tbody">
                                                    <?php consultarCargo();?>
                                                </tbody>
                                              </table>
                                            </div>
                                        </div>
                                    </div>
                              </div>
                              <div class="form-group" id="div-btn">
                                <center>
                                <color="red"><?php echo $error[0]; ?><p id="demo"></p></color>
                                <button type="submit" class="btn btn-success" name="acepCargo" >Aceptar</button>
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
                                        <h3>Modificar Cargos</h3>
                                        <div class="table-responsive" id="cargoTableDiv">          
                                          <table class="table">
                                            <thead>
                                              <tr>
                                                <th>Cargos Registrados</th>
                                                <th></th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                            <?php consultarCargo2(); 
                                            for($i=0; $i < count($id); $i++){ 
                                            ?>
                                                <tr>
                                                  <form method="POST">
                                                    <td>
                                                        <input type="hidden" value="<?php echo $id[$i]; ?>" name="idCargo" />
                                                        <?php echo $cargo[$i]; ?>
                                                    </td>
                                                    <td><button type="button" class='btn btn-info' id="btn-modifyCargo" onclick="modifyCargo(<?php echo $id[$i].", '".$cargo[$i]."'"; ?>);"><i class='glyphicon glyphicon-pencil'></i></button>
                                                    <button type="submit" class='btn btn-danger' name="deleteCargo" id="deleteCargo"><i class='glyphicon glyphicon-remove'></i></button></td>
                                                  </form></tr>
                                            <?php } ?>
                                            </tbody>
                                          </table>
                                        </div>
                                        <div class="row" id="modCargoDiv" style="display:none;">
                                            <form class="form-horizontal" role="form" method="post" id="CargoConsultaForm" name="CargoConsultaForm">
                                                <div class="col-md-12 ">
                                                    <div class="form-group">
                                                      <input type="hidden" name="idCargo" id="idCargo" />
                                                        <label for="inicio" class="col-sm-4 control-label">Cargo:</label>
                                                        <div class="col-md-8">
                                                            <input class="form-control" type="text" name="cargo" id="cargo" required/></td>
                                                        </div>
                                                    </div>
                                                    <div id="div-btn" class="form-group">
                                                        <button type="submit" class="btn btn-success" name="modCargo">Aceptar</button>
                                                        <button type="button" class="btn btn-info" id="cancelarModCargo">Cancelar</button>
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
