<?php
include ("header.php");
include("valAdmin.php");
require("registro.php");
require("modificar.php");
require("consultar.php");

?>

<!-- Estos dos div Paneles y Container es para que todos los paneles mantengan el mismo ancho a excepcion del de login -->
<div id="Paneles">
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>Registro de usuario</h2>
            </div>
            <!-- REGISTRO -->
            <div class="panel-body">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#registro">Registro</a></li>
                    <li><a data-toggle="tab" href="#consulta">Consulta</a></li>
                </ul>
                <div class="tab-content">
                    <div id="registro" class="tab-pane fade in active" style="margin-top:10px;">
                        <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data" id="usuarioForm" name="usuarioForm">
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                    <div class="panel panel-default">
                                        <div class="panel-body" style="padding-top:4px;">
                                            <h3>Datos del usuarios</h3>
                                            <div class="form-group">
                                                <label for="cedula" class="col-sm-5 control-label">Cedula:</label>
                                                <div class="col-md-7">
                                                    <input type="text" class="form-control" id="textbox" name="usu_cedula2" min="1" placeholder="Cedula" autofocus /><br/>
                                                    <select class="form-control" size="4" name="usu_cedula" id="select" required>
                                                        <?php echo consultarPersonal2(); ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Contraseña" class="col-sm-5 control-label">Contraseña:</label>
                                                <div class="col-sm-7">
                                                    <input type="password" class="form-control" name="usu_contras" id="usu_contras" placeholder="Contraseña" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="RepContraseña" class="col-sm-5 control-label">Repetir contraseña:</label>
                                                <div class="col-sm-7">
                                                    <input type="password" class="form-control" name="usu_contras2" id="usu_contras2" placeholder="Repetir contraseña" required>
                                                </div>
                                            </div>
                                            <div class="form-group" style="margin-bottom: 0px">
                                                <label for="nivel_usu" class="col-sm-5 control-label">Nivel:</label>
                                                <div class="col-sm-7">
                                                    <select class="form-control" name="usu_nivel" required>
                                                        <option value="">Selecciona el nivel</option>
                                                        <option value="1">Administrador</option>
                                                        <option value="2">Docente</option>
                                                        <option value="3">Personal</option>
                                                    </select>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                                <div id="div-btn" class="form-group">
                                     <div style="color:red;"><?php echo $error; ?></div>
                                    <button type="submit" class="btn btn-success" name="acepUsuario">Aceptar</button>
                                    <button type="reset" class="btn btn-info" name="cancelar">Cancelar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="consulta" class="tab-pane fade" style="margin-top:10px;">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="panel panel-default">
                                    <div class="panel-body" style="padding-top:4px;">
                                        <h3>Modificar Usuarios</h3>
                                        <div class="table-responsive" id="usuarioTableDiv">     
                                            <table class="table" id="usuarioTable">
                                                <thead>
                                                  <tr>
                                                    <th>Usuarios Registrados</th>
                                                    <th></th>
                                                  </tr>
                                                </thead>
                                                <tbody id="bodyUsuarioTable">
                                                <?php consultarUsuarios(); 
                                                for($i=0; $i < count($usu_cedula); $i++){  
                                                    if($nivel[$i] == 1){
                                                        $nivels = 'Administrador';
                                                    } else if($nivel[$i] == 2){
                                                        $nivels = 'Docente';
                                                    } else $nivels = 'Personal';
                                                ?>
                                                    <tr>
                                                        <form method="POST">
                                                            <td>
                                                                <input type="hidden" value="<?php echo $usu_cedula[$i]; ?>" name="usu_cedula" />
                                                                <?php echo $usu_cedula[$i]." - ".$nombre[$i]." (".$nivels.")"; ?>
                                                            </td>
                                                            <td><button type="button" class='btn btn-info' id="btn-modifyUser" onclick="modifyUser(<?php echo $usu_cedula[$i].", '".$nombre[$i]."', ".$nivel[$i]; ?>);"><i class='glyphicon glyphicon-pencil'></i></button>
                                                            <button type="submit" class='btn btn-danger' name="deleteUser" id="deleteUser"><i class='glyphicon glyphicon-remove'></i></button></td>
                                                        </form>
                                                    </tr>
                                                <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="row" id="modUsuarioDiv" style="display:none;">
                                            <form class="form-horizontal" role="form" method="post" id="usuarioConsultaForm" name="usuarioConsultaForm">
                                                <div class="col-md-12 ">
                                                    <div class="form-group">
                                                        <label for="cedula" class="col-sm-4 control-label">Nombre:</label>
                                                        <div class="col-md-8">
                                                            <p id="usu_nombre"></p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="cedula" class="col-sm-4 control-label">Cedula:</label>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" id="usu_cedula" name="usu_cedula" min="1" readonly />
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nivel_usu" class="col-sm-4 control-label">Nivel:</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" name="usu_nivel" id="usu_nivel" required>
                                                                <option value="">Selecciona el nivel</option>
                                                                <option value="1">Administrador</option>
                                                                <option value="2">Docente</option>
                                                                <option value="3">Personal</option>
                                                            </select>
                                                        </div>
                                                    </div> 
                                                    <div id="div-btn" class="form-group">
                                                        <button type="submit" class="btn btn-success" id="modUsuario">Aceptar</button>
                                                        <button type="button" class="btn btn-info" id="cancelarModUsuario">Cancelar</button>
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
