<?php
include ("header.php");
include("valAdmin.php");
require_once("registro.php");
require_once("consultar.php");
require_once("modificar.php");
require_once("imagen.php");

?>

<center>
<!-- Estos dos div Paneles y Container es para que todos los paneles mantengan el mismo ancho a excepcion del de login -->
<div id="Paneles">
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>Módulo de Personal</h2>
            </div>
            <div class="panel-body">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#registro">Registro</a></li>
                    <li><a data-toggle="tab" href="#consulta">Consulta</a></li>
                </ul>
                <div class="tab-content">
            <!-- REGISTRO -->
                    <div id="registro" class="tab-pane fade in active" style="margin-top:10px;">
                        <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data" id="personalForm" name="personalForm">
                            <div class="row">
                                <div class="col-xs-6 col-sm-7">
                                    <div class="panel panel-default">
                                        <div class="panel-body" style="padding-top:4px;">
                                            <h3>Datos del trabajador</h3>
                                            <div class="form-group">
                                                <label for="cedula" class="col-sm-5 control-label">Cedula:</label>
                                                <div class="col-sm-7">
                                                    <input type="number" class="form-control" name="per_cedula" placeholder="Cedula" min="1" autofocus required>
                                                </div> 
                                            </div>
                                            <div class="form-group">
                                                 <label for="nombre1" class="col-sm-5 control-label">Primer Nombre:</label>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control" name="per_nombre1" placeholder="Primer Nombre" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="nombre2" class="col-sm-5 control-label">Segundo Nombre:</label>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control" name="per_nombre2" placeholder="Segundo Nombre" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="apellido1" class="col-sm-5 control-label">Primer Apellido:</label>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control" name="per_apellido1" placeholder="Primer Apellido" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="apellido2" class="col-sm-5 control-label">Segundo Apellido:</label>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control" name="per_apellido2" placeholder="Segundo Apellido" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="email" class="col-sm-5 control-label">Email:</label>
                                                <div class="col-sm-7">
                                                    <input type="email" class="form-control" name="per_email" placeholder="Email" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="telefono" class="col-sm-5 control-label">Telefono:</label>
                                                <div class="col-sm-7">
                                                    <input type="number" class="form-control" name="per_telefono" placeholder="Telefono" required>
                                                </div>
                                            </div>
                                            <div class="form-group" style="margin-bottom: 0px">
                                                <label for="direccion" class="col-sm-5 control-label" align="center">Direccion:</label>
                                                <div class="col-sm-7">
                                                    <input type="textarea" class="form-control" rows="3" name="per_direccion" placeholder="Direccion" required>
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
                                                        <img src="imagenes/default_avatar_male.jpg" alt="Foto de perfil" id="preview">
                                                    </div>
                                                    <a class="file-input-wrapper btn btn btn-primary"><i class="glyphicon glyphicon-camera"></i>  Foto<input type="file" id="avatar" name="avatar" class="btn btn-primary" title="Foto" onchange="PreviewImg(this);" required/></a>
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
                                                        <button type="button" id="botonID" class="btn btn-default btn-sm-" onclick='lectorTarjeta.php?action=ON'>
                                                            <span class="glyphicon glyphicon-plus" style="color:#980303"></span>
                                                        </button>   
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
                                                            <select class="form-control" name="per_cargo" required>
                                                                <option value="">Selecciona el cargo</option>
                                                                <?php 
                                                                global $db;
                                                                $query = "SELECT * FROM Cargo";
                                                                $result = $db->query($query);
                                                                if($result->num_rows > 0){
                                                                    while($row = $result->fetch_assoc()) {
                                                                       echo "<option value='".$row[idCargo]."'>".$row[descripcion]."</option>"; 
                                                                    }
                                                                } else{
                                                                    echo "<option value=''>No hay cargos registrados</option>";
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-sm-12" id="divPersonalHorario" style="display:none">
                                            <div class="panel panel-default" style="margin-bottom: 8px">
                                                <div class="panel-body"  style="padding: 10px">
                                                    <div class="form-group"  style="margin-bottom: 0px">
                                                        <label for="cargo" class="col-sm-3 control-label">Horario:</label>
                                                        <div class="col-sm-9">
                                                            <select class="form-control" name="per_horario" id="per_horario">
                                                                <option value="">Selecciona el horario</option>
                                                                <?php consultarHorarioPersonal2(); ?>
                                                            </select>
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
                                <button type="submit" class="btn btn-success" name="acepPersonal">Aceptar</button>
                                <button type="reset" class="btn btn-info" name="cancelar">Cancelar</button>
                            </div>
                        </form>
                    </div>
            
            <!-- CONSULTA -->
                    <div id="consulta" class="tab-pane fade" style="margin-top:10px;">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h3>Modificar Personal</h3>
                                <div class="row">
                					<div class="col-md-12">
                						<div class="table-responsive" id="personalTableDiv">
                                            <table id="datatables-1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr style="font-size:12px;">
                                                        <th>Cedula</th>
                                                        <th>Tarjeta ID</th>
                                                        <th>Nombre completo</th>
                                                        <th>Estado</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                 <tfoot>
                                                    <tr style="font-size:12px;">
                                                        <th>Cedula</th>
                                                        <th>Tarjeta ID</th>
                                                        <th>Nombre completo</th>
                                                        <th>Estado</th>
                                                        <th></th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                    <?php consultarPersonal(); 
                                                    for($i=0; $i<count($cedula); $i++){
                                                    ?>
                                                    <tr style="font-size:12px;">
                                                        <form class='form-horizontal' role='form'>
                                                            <td><?php echo $cedula[$i]; ?></td>
                                                            <td><?php echo $tarjetaID[$i]; ?></td>
                                                            <td><?php echo $primerNombre[$i]." ".$segundoNombre[$i]." ".$primerApellido[$i]." ".$segundoApellido[$i]; ?></td>
                                                            <td><?php echo $estadoN[$i]; ?>  <button type="button" class='btn btn-default' id="btn-status" onclick="modifyPersonalStatus(<?php echo "'".$cedula[$i]."', '".$estado[$i]."', '".$estadoN[$i]."'"; ?>);"><i class='glyphicon glyphicon-pencil'></i></button></td>
                                                            <td>
                                                                <button type="button" class='btn btn-info' id="btn-modifyPersonal" onclick="modifyPersonal(<?php echo "'".$cedula[$i]."', '".$tarjetaID[$i]."', '".$primerNombre[$i]."', '".$segundoNombre[$i]."', '".$primerApellido[$i]."', '".$segundoApellido[$i]."', '".$correo[$i]."', '".$telefono[$i]."', '".$direccion[$i]."', '".$estado[$i]."', '".$cargoid[$i]."'"; ?>);"><i class='glyphicon glyphicon-pencil'></i></button>
                                                                <!--<button type="submit" class='btn btn-danger' name="deletePersonal" id="deletePersonal"><i class='glyphicon glyphicon-remove'></i></button>-->
                                                            </td> 
                                                        </form>  
                                                    </tr>
                                            <?php   } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="row" id="modPersonalDiv" style="display:none;">
                                            <form class="form-horizontal" role="form" method="post" id="personalConsultaForm" name="personalConsultaForm">
                                                <div class="col-xs-6 col-sm-7">
                                                    <div class="panel panel-default">
                                                        <div class="panel-body" style="padding-top:4px;">
                                                            <h3>Datos del estudiante</h3>
                                                            <div class="form-group">
                                                                <label for="cedula" class="col-sm-5 control-label">Cedula:</label>
                                                                <div class="col-sm-4">
                                                                    <input type="text" class="form-control" name="per_cedula" id="per_cedula" min="1" readonly required>
                                                                </div> 
                                                            </div>
                                                            <div class="form-group">
                                                                 <label for="nombre1" class="col-sm-5 control-label">Primer Nombre:</label>
                                                                <div class="col-sm-7">
                                                                    <input type="text" class="form-control" name="per_nombre1" id="per_nombre1" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="nombre2" class="col-sm-5 control-label">Segundo Nombre:</label>
                                                                <div class="col-sm-7">
                                                                    <input type="text" class="form-control" name="per_nombre2" id="per_nombre2" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="apellido1" class="col-sm-5 control-label">Primer Apellido:</label>
                                                                <div class="col-sm-7">
                                                                    <input type="text" class="form-control" name="per_apellido1" id="per_apellido1" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="apellido2" class="col-sm-5 control-label">Segundo Apellido:</label>
                                                                <div class="col-sm-7">
                                                                    <input type="text" class="form-control" name="per_apellido2" id="per_apellido2" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="email" class="col-sm-5 control-label">Email:</label>
                                                                <div class="col-sm-7">
                                                                    <input type="email" class="form-control" name="per_email" id="per_email" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="telefono" class="col-sm-5 control-label">Telefono:</label>
                                                                <div class="col-sm-7">
                                                                    <input type="number" class="form-control" name="per_telefono" id="per_telefono" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 0px">
                                                                <label for="direccion" class="col-sm-5 control-label" align="center">Direccion:</label>
                                                                <div class="col-sm-7">
                                                                    <input type="textarea" class="form-control" rows="3" name="per_direccion" id="per_direccion" required>
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
                                                                    <div class="file-preview" id="divPreviewimg">
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
                                                                            <input type="text" class="form-control" name="tarjeta" id='per_tarjeta' readonly style="padding-left:4px;padding-right:2px;">
                                                                        </div> 
                                                                        <button type="button" id="botonID" class="btn btn-default btn-sm-" onclick='lectorTarjeta.php?action=ON'>
                                                                            <span class="glyphicon glyphicon-plus" style="color:#980303"></span>
                                                                        </button>   
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
                                                                            <select class="form-control" name="per_cargo" id="per_cargo" required>
                                                                                <option value="">Selecciona el cargo</option>
                                                                                <?php 
                                                                                global $db;
                                                                                $query = "SELECT * FROM Cargo";
                                                                                $result = $db->query($query);
                                                                                if($result->num_rows > 0){
                                                                                    while($row = $result->fetch_assoc()) {
                                                                                       echo "<option value='".$row[idCargo]."'>".$row[descripcion]."</option>"; 
                                                                                    }
                                                                                } else{
                                                                                    echo "<option value=''>No hay cargos registrados</option>";
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                    </div> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-12" id="divPersonalHorario" style="display:none">
                                                            <div class="panel panel-default" style="margin-bottom: 8px">
                                                                <div class="panel-body"  style="padding: 10px">
                                                                    <div class="form-group"  style="margin-bottom: 0px">
                                                                        <label for="cargo" class="col-sm-3 control-label">Horario:</label>
                                                                        <div class="col-sm-9">
                                                                            <select class="form-control" name="per_horario" id="per_horario">
                                                                                <option value="">Selecciona el horario</option>
                                                                                <?php consultarHorarioPersonal2(); ?>
                                                                            </select>
                                                                        </div>
                                                                    </div> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="div-btn" class="form-group">
                                                    <div style="color:red;"><?php echo $error; ?></div>
                                                    <button type="submit" class="btn btn-success" name="modPersonal">Aceptar</button>
                                                    <button type="button" class="btn btn-info" name="cancelarModPersonal" id="cancelarModPersonal">Cancelar</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="row" id="modPersonalStatusDiv" style="display:none;">
                                            <form class="form-horizontal" role="form" method="post" id="personalStatusForm" name="personalStatusForm">
                                                <div class="col-xs-6 col-sm-7">
                                                    <div class="panel panel-default">
                                                        <div class="panel-body" style="padding-top:4px;">
                                                            <h3>Estado del estudiante Actual</h3>
                                                            <font color='green'><h4 id="statusActual"></h4></font>
                                                            <div class="form-group">
                                                                <input type="hidden" name="statusCedula" id="statusCedula" />
                                                                <input type="hidden" name="statusAct" id="statusAct" />
                                                                <p>¿Esta seguro que desea cambiar el estado a...?</p>
                                                                <button type="submit" class="btn btn-success" name="modPersonalStatus" id="modPersonalStatus"></button>
                                                                <button type="button" class="btn btn-danger" name="cancelarModPersonalStatus" id="cancelarModPersonalStatus">Cancelar</button>
                                                            </div>
                                                        </div>
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
