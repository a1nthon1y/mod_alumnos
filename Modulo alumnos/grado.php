<?php 
  include ("header.php"); 
  include("valAdmin.php");
  require("registro.php");
  require("modificar.php");
  include("consultar.php");
  $error = array();  
  
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['acepGrados'])){
      consultarGrados3();
      $sec = array('A','B','C','D','E','F','G');
      $i = 1;
      while($_POST['gradoNombre'.$i] != ''){
        
        if($_POST['gradoSeccion'.$i] == 1){
          $gradoSeccion[0] = 'U';
        } else{
          $k=0;
          while($_POST['gradoSeccion'.$i] > $k){
            $gradoSeccion[$k]=$sec[$k];
            $k++;
          }
        }
        $j = 0;
        while(count($gradoSeccion) > $j){
          $gradoNombre = $_POST['gradoNombre'.$i];
          if(!registrarGrados($gradoNombre, $gradoSeccion[$j])){
            $error[0] = '<p style="color:red;"> Hubo un error</p>'; //acomodar lo qeu de hay unas no ingresan
          }else{
            $error[0] = '';			
          }
          $j++;
        }
        $i++;
      }
   
    
    if($error[0] == ''){ ?>	    		
					<div class="alert alert-success">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					  	<strong>DATOS INSERTADOS CON EXITO!</strong>
					</div>									
		<?php consultarGrados3(); 
        } else{ ?>	    		
					<div class="alert alert-danger">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					  	<strong>HUBO UN ERROR</strong>
					</div>									
		<?php   	} 
    }
    
    if(isset($_POST['modGrado'])){
      modificarGrado();
    }
    
    if(isset($_POST['deleteGrado'])){
      deleteGrado();
    }
  }
?>
<script>
 /* function gradoSeleccionado(grado){
    var gradoC = grado.value;
     document.getElementById('modifGrado').innerHTML=
     "<input type='hidden' name='grado' value='"+gradoC+"' required>";
  }*/
</script>
<div id="Paneles">
  <div class="container">
    <div class="panel panel-default">
      <div class="panel-heading">
          <h2>Módulo de Grados</h2>
      </div>
      <div class="panel-body">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#registro">Registro</a></li>
            <li><a data-toggle="tab" href="#consulta">Consultas</a></li>
        </ul>
        
        <div class="tab-content">
          <div id="registro" class="tab-pane fade in active" style="margin-top:10px;">
            <div class="panel panel-default">
              <div class="panel-heading" id="heading">
                <label for="materia">Agregar grado:</label>
                <button type="button" class="btn btn-default btn-sm" id="btn+grado" onclick='agregarFilaGrado("tablaGrado")'>
                    <span class="glyphicon glyphicon-plus"></span>
                </button>
                <label for="materia">Eliminar grado:</label>
                <button type="button" class="btn btn-default btn-sm" onclick='borrarUltimaFila("tablaGrado")'>
                    <span class="glyphicon glyphicon-minus"></span>
                </button>
              </div>
              <div class="panel-body">
                <form class="form" role="form" name="formGrado" method="POST">
                  <div class="row">
                    <div class="col-sm-7">
                      <div class="form-group" style="width:100%; height:auto;">
                  <?php 
                      $placeholder = array("Septimo grado", "Octavo grado",
                      "Noveno grado", "Primero de Diversificado", 
                      "Segundo de Diversificado", "Tercero de Diversificado");
                       ?>
                        <div class="table-responsive" id="divTabla">     
                          <table class="table" id="tablaGrado">
                            <thead>
                              <tr>
                                <th width="60%">Nombre del Grado</th>
                                <th>Secciones</th>
                              </tr>
                            </thead>
                            <tbody id="bodyTabla">
                      <?php 
                        consultarGrados3();
                        $o=1;
                        if(count($gradoNombre) > 0){
                          $i=0;
                          while(count($placeholder) > $i){ 
                            $j=0;
                            $k = 0;
                            while(count($gradoNombre) > $j){
                              if($gradoNombre[$j] != $placeholder[$i]) $k++;
                              $j++;
                            }
                            if($k == count($gradoNombre)){ ?>
                              <tr>
                                <td width="60%">
                                  <input type="text" class="form-control" name="gradoNombre<?php echo $o; ?>" value="<?php echo $placeholder[$i]; ?>" readonly required>
                                </td>
                                <td>
                                  <input type="number" class="form-control" name="gradoSeccion<?php echo $o; ?>" min="1" max="7" placeholder="1" required>
                                </td>
                              </tr>
                 <?php        $o++;
                            }
                            $i++; 
                          }
                        }else{ 
                          for($i=0; $i<6; $i++){ ?>
                              <tr>
                                <td width="60%">
                                  <input type="text" class="form-control" name="gradoNombre<?php echo $i+1; ?>" value="<?php echo $placeholder[$i]; ?>" readonly required>
                                </td>
                                <td>
                                  <input type="number" class="form-control" name="gradoSeccion<?php echo $i+1; ?>" min="1" max="7" placeholder="1" required>
                                </td>
                              </tr>
              <?php       }
                        }   ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-5">
                      <div class="form-group" style="width:100%; height:auto;">
                        <div class="table-responsive" id="divTabla">          
                          <table class="table">
                            <thead>
                              <tr>
                                <th>Grados Registrados</th>
                              </tr>
                            </thead>
                            <tbody id="bodyTabla">
                              <?php consultarGrados2(); ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group" id="div-btn">
                    <center>
                    <button type="submit" class="btn btn-success" name="acepGrados" >Aceptar</button>
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
                            <h3>Modificar Grados</h3>
                            <div class="table-responsive" id="gradoTableDiv">          
                              <table class="table" id="usuarioTable">
                                <thead>
                                  <tr>
                                    <th>Grados Registrados</th>
                                    <th></th>
                                  </tr>
                                </thead>
                                <tbody id="bodyUsuarioTable">
                                <?php consultarGrados3(); 
                                for($i=0; $i < count($id); $i++){ 
                                ?>
                                    <tr>
                                      <form method="POST">
                                        <td>
                                            <input type="hidden" value="<?php echo $id[$i]; ?>" name="idCurso" />
                                            <?php echo $grado[$i]." - ".$seccion[$i]; ?>
                                        </td>
                                        <td><button type="button" class='btn btn-info' id="btn-modifyGrado" onclick="modifyGrado(<?php echo $id[$i].", '".$grado[$i]."', '".$seccion[$i]."'"; ?>);"><i class='glyphicon glyphicon-pencil'></i></button>
                                        <button type="submit" class='btn btn-danger' name="deleteGrado" id="deleteGrado"><i class='glyphicon glyphicon-remove'></i></button></td>
                                      </form></tr>
                                <?php } ?>
                                </tbody>
                              </table>
                            </div>
                            <div class="row" id="modGradoDiv" style="display:none;">
                                <form class="form-horizontal" role="form" method="post" id="gradoConsultaForm" name="gradoConsultaForm">
                                    <div class="col-md-12 ">
                                        <div class="form-group">
                                          <input type="hidden" name="idCurso" id="idCurso" />
                                            <label for="inicio" class="col-sm-4 control-label">Grado:</label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text" name="grado" id="grado" required/></td>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="fin" class="col-sm-4 control-label">Sección:</label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text" name="seccion" id="seccion" readonly required/></td>
                                            </div>
                                        </div> 
                                        <div id="div-btn" class="form-group">
                                            <button type="submit" class="btn btn-success" name="modGrado">Aceptar</button>
                                            <button type="button" class="btn btn-info" id="cancelarModGrado">Cancelar</button>
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

