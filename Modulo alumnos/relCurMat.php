<?php 
    ob_start();
    include ("header.php"); 
    require("registro.php");
    require("consultar.php");
    $error = array();  
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      
      for($i=1; $i<=6; $i++) {
        for($j=$i+1; $i<=6; $j++){
          if($_POST['grado'.$i] == $_POST['grado'.$i+1]) {
    	      $error[0] = '<p style="color:red;">Hay cursos repetidos!</p>';
    	      break;
    	    }
        }
      }
      
      /*for($i=1; $i<=6; $i++) {
    	  if(isset($_POST['grado'.$i])){
    	    $cursoID = $_POST['grado'.$i];
    	    for ($j=0; $j<count($_POST['destinoMateria'.$i]); $j++) {
              $materiaID = $_POST['destinoMateria'.$i][$j];
              if(!registrarCursos($cursoID, $materiaID)){
                $error[0] = '<p style="color:red;">Error en el registro!</p>';
              } else{
                $error[0] = '';			
              }
          	}
          	if($error[0] == ''){
            $error[0] = '<p style="color:green;">Datos registrados exitosamente!</p>';
          }
        }
    	}*/
    }
?>
<script type="text/javascript"> 
	
  
  function validarForm() {
    var x = document.forms["formCurso"]["fname"].value;
    if (x == null || x == "") {
        alert("Name must be filled out");
        return false;
    }
 } 
</script>

<div id="Paneles">
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>Módulo de Horario del Personal</h2>
            </div>
            <div class="panel-body">
              <ul class="nav nav-tabs">
                  <li class="active"><a data-toggle="tab" href="#registro">Registro</a></li>
                  <li><a data-toggle="tab" href="#modificacion">Modificación</a></li>
                  <li><a data-toggle="tab" href="#consultas">Consultas</a></li>
              </ul>
      
              <div class="tab-content">
                <div id="registro" class="tab-pane fade in active" style="margin-top:10px;">
                  <div class="panel panel-default">
                    <div class="panel-heading" id="heading">
                      <button type="button" class="btn btn-default btn-sm" onclick='agregarFilaCurso("tablaCursoMateria")'>
                          <span class="glyphicon glyphicon-plus"></span>
                      </button>
                      <button type="button" class="btn btn-default btn-sm" onclick='borrarUltimaFila("tablaCursoMateria")'>
                          <span class="glyphicon glyphicon-minus"></span>
                      </button>
                    </div>
                    <div class="panel-body">
                      <form class="form" role="form" name="formCurso" method="post" onsubmit="return validarForm()">
                        <div class="form-group" style="width:100%;height:auto;">
                          <div class="table-responsive">          
                            <table class="table" id="tablaCursoMateria">
                              <thead class="thead">
                                <tr>
                                  <th>Grado a relacionar</th>
                                  <th>Materias a relacionar</th>
                                  <th></th>
                                  <th>Materias a Registradas</th>
                                </tr>
                              </thead>
                              <tbody class="tbody" id="bodyTabla">
                                <tr>
                                  <td>
                                    <div>
                                      <br/>
                                      <select class="form-control" name="grado1" style="width:100%" required>
                                        <?php consultarGrados1(); ?>
                                      </select>
                                    </div>
                                  </td>
                                  <td>
                                    <div>
                                      <select class="form-control" id ="destinoMateria1" name="destinoMateria1[]" multiple required>
                                      </select>
                                    </div>
                                  </td>
                                  <td>
                                    <br/>
                                    <div class="btn-group-vertical">
                                      <button type="button" id="izqDer1" class="btn btn-info btn-sm" onclick="pasar('origenMateria1', 'destinoMateria1');"><span class="glyphicon glyphicon-arrow-left"></span></button>
                                      <button type="button" id="derIzq1" class="btn btn-info btn-sm" onclick="pasar('destinoMateria1', 'origenMateria1');"><span class="glyphicon glyphicon-arrow-right"></span></button>
                                    </div> 
                                  </td>
                                  <td>
                                    <div> 
                                      <select class="form-control" id="origenMateria1" name="origenMateria1[]" multiple>
                                        <?php consultarMateria(); ?>
                                      </select>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    <div>
                                      <br/>
                                      <select class="form-control" name="grado2" style="width:100%" required>
                                        <?php consultarGrados1(); ?>
                                      </select>
                                    </div>
                                  </td>
                                  <td>
                                    <div> 
                                      <select class="form-control" id ="destinoMateria2" name="destinoMateria2[]" multiple required>
                                      </select>
                                    </div>
                                  </td>
                                  <td>
                                    <br/>
                                    <div class="btn-group-vertical">
                                      <button type="button" id="izqDer2" class="btn btn-info btn-sm" onclick="pasar('origenMateria2', 'destinoMateria2');"><span class="glyphicon glyphicon-arrow-left"></span></button>
                                      <button type="button" id="derIzq2" class="btn btn-info btn-sm" onclick="pasar('destinoMateria2', 'origenMateria2');"><span class="glyphicon glyphicon-arrow-right"></span></button>
                                    </div> 
                                  </td>
                                  <td>
                                    <div> 
                                      <select class="form-control" id="origenMateria2" name="origenMateria2[]" multiple>
                                        <?php consultarMateria(); ?>
                                      </select>
                                    </div>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <div class="form-group">
                          <center>
                          <?php echo $error[0]; ?>
                          <button type="submit" class="btn btn-success" name="acepCursos" >Aceptar</button>
                          <button type="reset" class="btn btn-info" name="cancelar">Cancelar</button>
                          </center>
                        </div>
                      </form>  
                    </div>
                  </div>
                </div>
                
                <div id="modificacion" class="tab-pane fade">
                  <div class="panel panel-default">
                    <div class="panel-heading" id="heading">
                      <button type="button" class="btn btn-default btn-sm" onclick='agregarFila("tablaHora")'>
                          <span class="glyphicon glyphicon-plus"></span>
                      </button>
                      <button type="button" class="btn btn-default btn-sm" onclick='borrarUltimaFila("tablaHora")'>
                          <span class="glyphicon glyphicon-minus"></span>
                      </button>
                    </div>
                    <div class="panel-body">
                     
                    </div>
                  </div>
                </div>
                <div id="consultas" class="tab-pane fade">
                  <div class="panel panel-default">
                    <div class="panel-body">
                     
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>

