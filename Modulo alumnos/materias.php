<?php 
  include ("header.php");
  include("valAdmin.php");
  require_once("registro.php");
  require_once("modificar.php");
  require_once("consultar.php");
  $error = array();  
  
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['acepMaterias'])){
      $i = 1;
      while($_POST['codigo'.$i] != ''){
        $materiaID[$i] = $_POST['codigo'.$i];
        $nombre[$i] = $_POST['materia'.$i];
      	if(!registrarMaterias($materiaID[$i], $nombre[$i])){
          $error[0] = '<p style="color:red;"> Existen registros con esas especificaciones</p>'; //acomodar lo qeu de hay unas no ingresan
        }else{
          $error[0] = '';			
        }
        $i++;
      }
      
      if($error[0] == ''){ ?>	    		
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
<?php }
    }
    
    if(isset($_POST['modMateria'])) {
      modificarMateria();
    }
    
    if(isset($_POST['deleteMateria'])) {
        deleteMateria();
    }
  }
?>

<script language="JavaScript">
  function validar(codigo1){
    var x;
    var codigo = document.formMateria.codigo1.value;
    if (confirm(codigo) == true) {
        x = "You pressed OK!";
    } else {
        x = "You pressed Cancel!";
    }
    document.getElementById("demo").innerHTML = x;
  }
</script>


<div id="Paneles">
  <div class="container">
    <div class="panel panel-default">
      <div class="panel-heading">
          <h2>Módulo de Materias</h2>
      </div>
      <div class="panel-body">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#registro">Registro</a></li>
            <li><a data-toggle="tab" href="#consulta">Consulta</a></li>
        </ul>
        <div class="tab-content">
          <div id="registro" class="tab-pane fade in active" style="margin-top:10px;">
            <div class="panel panel-default">
              <div class="panel-heading">
                  <label for="materia">Aumentar:</label>
                  <button type="button" class="btn btn-default btn-sm" onclick='agregarFilaMaterias("tablaMateria")'>
                      <span class="glyphicon glyphicon-plus"></span>
                  </button>
                  <label for="materia">Disminuir:</label>
                  <button type="button" class="btn btn-default btn-sm" onclick='borrarUltimaFila("tablaMateria")'>
                      <span class="glyphicon glyphicon-minus"></span>
                  </button>
              </div>
              <div class="panel-body">
                <form class="form" role="form" name="formMateria" method="post">
                  <div class="row">
                    <div class="col-sm-7">
                      <div class="form-group" style="height:auto">
                        <div class="table-responsive" id="divTabla">          
                          <table class="table" id="tablaMateria">
                            <thead class="thead">
                              <tr>
                                <th>Código de la materia</th>
                                <th>Nombre de la materia</th>
                              </tr>
                            </thead>
                            <tbody class="tbody" id="bodyTabla">
                              <?php if($error[0] != ''){
                                for($j=1; $j<=$i; $j++){
                              ?>  <tr>
                                    <td><input class="form-control" type="text" name="codigo<?php echo $j; ?>" value="<?php echo $materiaID[$j]; ?>" autofocus required/></td>
                                    <td><input class="form-control" type="text" name="materia<?php echo $j; ?>" value="<?php echo $nombre[$j]; ?>" required/></td>
                                  </tr> <?php
                                }
                              } else { ?>
                                <tr>
                                  <td><input class="form-control" type="text" name="codigo1" placeholder="Código de la materia" required/></td>
                                  <td><input class="form-control" type="text" name="materia1" placeholder="Matemática" required/></td>
                                </tr>
                                <tr>
                                  <td><input class="form-control" type="text" name="codigo2" placeholder="Código de la materia" required/></td>
                                  <td><input class="form-control" type="text" name="materia2" placeholder="Castellano" required/></td>
                                </tr>
                                <tr>
                                  <td><input class="form-control" type="text" name="codigo3" placeholder="Código de la materia" required/></td>
                                  <td><input class="form-control" type="text" name="materia3" placeholder="Historia de Venezuela" required/></td>
                                </tr>
                              <?php } ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-5">
                      <div class="form-group" style="height:auto">
                        <div class="table-responsive"id="divTabla">          
                          <table class="table">
                            <thead class="thead">
                              <tr>
                                <th>Materias Registradas</th>
                              </tr>
                            </thead>
                            <tbody class="tbody" id="bodyTabla">
                              <?php consultarMateria2(); ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                      
                    </div>
                  </div>
                  
                  
                  <div class="form-group" id="div-btn">
                    <center>
                    <color="red"><?php echo $error[0]; ?><p id="demo"></p></color>
                    <button type="submit" class="btn btn-success" name="acepMaterias" >Aceptar</button>
                    <button type="reset" class="btn btn-info" name="cancelar">Cancelar</button>
                    </center>
                  </div>
                </form>
              </div>
            </div>
          </div>
          
          <div id="consulta" class="tab-pane fade" style="margin-top:10px;">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-body" style="padding-top:4px;">
                            <h3>Modificar Materias</h3>
                            <div class="table-responsive" id="materiaTableDiv">          
                              <table class="table" id="usuarioTable">
                                <thead>
                                  <tr>
                                    <th>Materias Registradas</th>
                                    <th></th>
                                  </tr>
                                </thead>
                                <tbody id="bodyUsuarioTable">
                                <?php consultarMateria5(); 
                                for($i=0; $i < count($id); $i++){ 
                                ?>
                                    <tr>
                                      <form method="POST">
                                        <td>
                                            <input type="hidden" value="<?php echo $id[$i]; ?>" name="idMateria1" />
                                            <?php echo $id[$i]." - ".$nombre[$i]; ?>
                                        </td>
                                        <td><button type="button" class='btn btn-info' id="btn-modifyMateria" onclick="modifyMateria(<?php echo $id[$i].", '".$nombre[$i]."'"; ?>);"><i class='glyphicon glyphicon-pencil'></i></button>
                                        <button type="submit" class='btn btn-danger' name="deleteMateria" id="deleteMateria"><i class='glyphicon glyphicon-remove'></i></button></td>
                                      </form></tr>
                                <?php } ?>
                                </tbody>
                              </table>
                            </div>
                            <div class="row" id="modMateriaDiv" style="display:none;">
                                <form class="form-horizontal" role="form" method="post" id="materiaConsultaForm" name="materiaConsultaForm">
                                    <div class="col-md-12 ">
                                        <div class="form-group">
                                            <input type="hidden" name="idMateria1" id="idMateria1" />
                                            <label for="inicio" class="col-sm-4 control-label">Código:</label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text" name="idMateria" id="idMateria" required/></td>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="fin" class="col-sm-4 control-label">Materia:</label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text" name="nombre" id="nombre"  required/></td>
                                            </div>
                                        </div> 
                                        <div id="div-btn" class="form-group">
                                            <button type="submit" class="btn btn-success" name="modMateria">Aceptar</button>
                                            <button type="button" class="btn btn-info" id="cancelarModMateria">Cancelar</button>
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
