<?php 

  include ("header.php");
  include("valUser.php");
  require("registro.php");
  require("consultar.php");

  
?>
<div id="Paneles">
  <div class="container">
    <div class="panel panel-default" style="width:400px;">
      <div class="panel-heading">
          <h2>Recuperar Clave</h2>
      </div>
<?php   if($_POST) { 
          if($_POST['usu_cedula']){ 
            consultarCedulaUsuario();  ?>
<?php     }
        } else{ ?>
      
        <div class="panel-body">
          <div class="form-group">
            <form class="form" role="form" id="formClave" method="POST">
              <label for="user" class="col-sm-5 control-label" style="padding-left:0px;">Ingresa tu usuario:</label>
              <div class="col-sm-5" style="padding-left:0px;">
                  <input type="text" class="form-control" name="usu_cedula" id="usu_cedula" placeholder="Usuario..." <?php if($error!=""){ echo "value='".$user."'"; }?> autofocus required>
              </div>
              <button type="submit" class="btn btn-default" name="acepCedula" ><i class="glyphicon glyphicon-search"></i></button>
            </form>
          </div>
        </div>
<?php } ?>
    </div>
  </div>
</div>
