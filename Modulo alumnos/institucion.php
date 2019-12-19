<?php 
  include ("header.php"); 
  require_once("registro.php");
  require_once("consultar.php");
  require_once("validacion.php");
  $aux = false;
  if(validarInstitucion()){
    $aux = true;
  }
  require_once("imagen.php");
  

?>

<div id="Paneles">
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>Datos de la instutición</h2>
            </div>
            <!-- REGISTRO -->
            <div class="panel-body">
              <div class="row">
                <form class="form-horizontal" role="form" enctype="multipart/form-data" method="post" id="institucionForm" name="institucionForm">
                <div class="col-sm-8">
                  <div class="panel panel-default">
                    <div class="panel-body">
                      <div class="form-group">
                        <label for="institucion" class="col-sm-6 control-label">Nombre de la institución:</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="institucion" placeholder="Nombre de la institucion" autofocus required> <br>
                        </div>
                        <!-- TIENEN QUE AGREGAR ESTO -->
                        <label for="FechaIni" class="col-sm-6 control-label">Fecha de inicio año escolar:</label> <br>
                        <div class="col-sm-6">
                            <input type="date" class="form-control" name="FechaIni" required>
                        </div>
                         <!-- TIENEN QUE AGREGAR ESTO -->
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="panel panel-default">
                    <div class="panel-body">
                      <div class="form-group">
                        <div class="file-preview">
                          <img src="imagenes/default_avatar_male.jpg" alt="Foto de perfil" id="preview">
                      </div>
                      </div>
                      <div class="form-group">
                        <label for="id" class="col-sm-12">Foto:</label>
                        <a class="file-input-wrapper btn btn btn-primary"><i class="glyphicon glyphicon-camera"></i><input type="file" id="avatar" name="avatar" class="btn btn-primary" title="Foto" onchange="PreviewImg(this);" required/></a>
                        <button type="button" title="Quitar" id="reset" class="btn btn-default fileinput-remove fileinput-remove-button" onclick="reset();">
                             <i class="glyphicon glyphicon-remove"></i>
                        </button> 
                      </div>
                    </div>
                  </div>
                </div>
                
                <div id="div-btn" class="form-group">
                  <div style="color:red;"><?php echo $error; ?></div>
                  <button type="submit" class="btn btn-success" name="acepInstitucion" id="acepInstitucion">Aceptar</button>
                  <button type="reset" class="btn btn-info" name="cancelar">Cancelar</button>
                </div>
                </form>
              </div>
            </div>
        </div>
    </div>
</div>
