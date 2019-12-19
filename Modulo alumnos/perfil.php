<?php
include ("header.php");
include("valUser.php");
require_once("modificar.php");
require_once("imagen.php");
?>
<center>
<div id="Paneles">
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>Perfil del Usuario</h2>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data" id="perfilForm">
                    <div class="row">
                        <div class="col-xs-6 col-sm-7">
                            <div class="panel panel-default">
                                <div class="panel-body" style="padding-top:4px;">
                                    <h3>Datos personales</h3>
                                    <div class="form-group">
                                        <label for="cedula" class="col-sm-5 control-label">Cedula:</label>
                                        <div class="col-sm-4">
                                            <input type="number" class="form-control" name="per_cedula" id="per_cedula" value="<?php echo $_SESSION['cedula']; ?>" readonly>
                                        </div> 
                                    </div>
                                    <div class="form-group">
                                         <label for="nombre1" class="col-sm-5 control-label">Primer Nombre:</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="per_nombre1" id="per_nombre1" value="<?php echo $_SESSION['primerNombre']; ?>" readonly required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre2" class="col-sm-5 control-label">Segundo Nombre:</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="per_nombre2" id="per_nombre2" value="<?php echo $_SESSION['segundoNombre']; ?>" readonly required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="apellido1" class="col-sm-5 control-label">Primer Apellido:</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="per_apellido1" id="per_apellido1" value="<?php echo $_SESSION['primerApellido']; ?>" readonly required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="apellido2" class="col-sm-5 control-label">Segundo Apellido:</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="per_apellido2" id="per_apellido2" value="<?php echo $_SESSION['segundoApellido']; ?>" readonly required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="col-sm-5 control-label">Email:</label>
                                        <div class="col-sm-7">
                                            <input type="email" class="form-control" name="per_email" id="per_email" value="<?php echo $_SESSION['correo']; ?>" readonly required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="telefono" class="col-sm-5 control-label">Telefono:</label>
                                        <div class="col-sm-7">
                                            <input type="number" class="form-control" name="per_telefono" id="per_telefono" value="<?php echo $_SESSION['telefono']; ?>" readonly required>
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-bottom: 0px">
                                        <label for="direccion" class="col-sm-5 control-label" align="center">Direccion:</label>
                                        <div class="col-sm-7">
                                            <input type="textarea" class="form-control" rows="3" name="per_direccion" id="per_direccion" value="<?php echo $_SESSION['direccion']; ?>" readonly required>
                                        </div>
                                    </div>
                                </div>
                            </div>                
                        </div>
                        <div class="col-xs-6 col-sm-5">
                            <div class="row">
                                <div class="col-xs-6 col-sm-12">
                                    <div class="panel panel-default" style="margin-bottom:8px;">
                                        <div class="panel-body">
                                            <div class="file-preview">
                                                <?php 
                                                    //Esto permite buscar la foto asociada en el momento que te registraste
                                                    $foto = "fotos/" . $_SESSION['user'] . ".";
                                                    if(file_exists($foto . "jpg")) $foto = $foto . "jpg";
                                                    else if(file_exists($foto . "png")) $foto = $foto . "png";
                                                    else if(file_exists($foto . "jpeg")) $foto = $foto . "jpeg";
                                                    else $foto = "imagenes/default_avatar_male.jpg";
                                                    echo "<img src=$foto alt='Foto de perfil' id='preview' width='300' height='300'>";
                                                ?>
                                            </div>
                                            <a class="file-input-wrapper btn btn btn-primary"><i class="glyphicon glyphicon-camera"></i>  Foto
                                            <input type="file" id="avatar" name="avatar" class="btn btn-primary" title="Foto" onchange="PreviewImg(this);" /></a>
                                            <button type="button" title="Quitar" id="reset" class="btn btn-default fileinput-remove fileinput-remove-button" onclick="reset();">
                                                 <i class="glyphicon glyphicon-remove"></i>
                                            </button> 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-12">
                                    <div class="panel panel-default" style="margin-bottom:8px;">
                                        <div class="panel-body">
                                            <div class="form-group" style="margin-bottom: 0px">
                                                <label for="id" class="col-sm-3 control-label" style="padding-right:0px;padding-left:5px;">ID Carne:</label>
                                                <div class="col-sm-7" style="padding-right:2px;padding-left:4px;">
                                                    <input type="text" class="form-control" name="tarjeta" value="000-000-000-000-000" readonly style="padding-left:4px;padding-right:2px;">
                                                </div>  
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-xs-6 col-sm-12">
                                    <div class="panel panel-default" style="margin-bottom: 8px">
                                        <div class="panel-body"  style="padding: 10px">
                                            <div class="form-group"  style="margin-bottom: 0px">
                                                <label for="cargo" class="col-sm-3 control-label">Cargo:</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="per_cargo" value="<?php echo $_SESSION['cargo']; ?>" readonly/>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-12" id="divPersonalHorario">
                                    <div class="panel panel-default" style="margin-bottom: 8px">
                                        <div class="panel-body"  style="padding: 10px">
                                            <div class="form-group"  style="margin-bottom: 0px">
                                                <label for="cargo" class="col-sm-3 control-label">Horario:</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="per_horario" value="<?php echo $_SESSION['horario']; ?>" readonly />
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="div-btn" class="form-group">
                        <div style="color:red;"><?php echo $error; ?></div>
                        <button type="submit" class="btn btn-success" name="modPerfil">Aceptar</button>
                        <button type="reset" class="btn btn-info" name="cancelar">Cancelar</button>
                    </div>
                </form>
            
     
    </div>
</div>
</center>
