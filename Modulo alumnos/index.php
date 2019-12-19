<?php
include ("header.php");
 include ("connection.php");
 $conn = new connection();
 $db = $conn->connect();
require_once('validacion.php');

if(isset($_SESSION['user']))
{ 
    inicio();
}else{
    ingresar($error, $user);
}

function inicio(){
?>
<div id="Paneles">
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>Bienvenido: <?php echo $_SESSION['primerNombre']." ".$_SESSION['primerApellido']." (".$_SESSION['nivel_nombre'].")"; ?></h2>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                <div class="list-group">
                    <a class="list-group-item">
                        <h4 class="list-group-item-heading">Nombre Completo</h4>
                        <p class="list-group-item-text"><?php echo $_SESSION['primerNombre']." ".$_SESSION['segundoNombre']." ".$_SESSION['primerApellido']." ".$_SESSION['segundoApellido'] ?></p>
                    </a>    
                    <a class="list-group-item">
                        <h4 class="list-group-item-heading">Cédula</h4>
                        <p class="list-group-item-text"><?php echo $_SESSION['cedula'] ?></p>
                    </a>
                    <a class="list-group-item">
                        <h4 class="list-group-item-heading">ID Tarjeta</h4>
                        <p class="list-group-item-text"><?php echo $_SESSION['tarjeta'] ?></p>
                    </a>
                    <a class="list-group-item">
                        <h4 class="list-group-item-heading">Cargo</h4>
                        <p class="list-group-item-text"><?php echo $_SESSION['cargo'] ?></p>
                    </a>
                    <a class="list-group-item">
                        <h4 class="list-group-item-heading">Correo Electrónico</h4>
                        <p class="list-group-item-text"><?php echo $_SESSION['correo'] ?></p>
                    </a>
                    <a class="list-group-item">
                        <h4 class="list-group-item-heading">Teléfono</h4>
                        <p class="list-group-item-text"><?php echo $_SESSION['telefono'] ?></p>
                    </a>
                </div>
            </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <?php 
                                    //Esto permite buscar la foto asociada en el momento que te registraste
                                    $foto = "fotos/" . $_SESSION['user'] . ".";
                                    if(file_exists($foto . "jpg")) $foto = $foto . "jpg";
                                    else if(file_exists($foto . "png")) $foto = $foto . "png";
                                    else if(file_exists($foto . "jpeg")) $foto = $foto . "jpeg";
                                    else $foto = "imagenes/default_avatar_male.jpg";
                                    echo "<img src=$foto class=img-thumbnail alt=Foto_usuario width=300 height=200>";
                                ?>
                            </div>
                            <div class="col-md-12" style="margin-top:20px;">
                                <a class="btn btn-default" name="change" href="perfil.php" title="Perfil"><i class="glyphicon glyphicon-user"></i></a>
                                <button class="btn btn-default" name="change" href="#"><i class="glyphicon glyphicon-pencil"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}

function ingresar($error, $user){
checkMasterAccount();
?>
    <div class="row" style="text-align:left">
        <div class="col-md-4 col-md-offset-1">
            <div class="panel panel-default" style="margin-top:70px;">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" id="formLogin">
                        <div class="form-group">
                            <label for="user" class="col-sm-3 control-label">Usuario</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="user" placeholder="Usuario..." <?php if($error!=""){ echo "value='".$user."'"; }?> autofocus required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-3 control-label">Contraseña</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" name="password" placeholder="Contraseña..." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <div class="checkbox">
                                    <label class="">
                                        <input type="checkbox" class="">Recordarme</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group last">
                            <div class="col-sm-offset-3 col-sm-9" style="color:red;">
                                <?php echo $error; ?>
                                <button type="submit" class="btn btn-success btn-sm" name="btnLogin" id="btnLogin">Ingresar</button>   <!-- se carga la pag y en validacion se verifica el usuario-->
                                <button type="reset" class="btn btn-default btn-sm">Cancelar</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="panel-footer">
                    <!--No está registrado? <a href="#" class="">Registrese aquí</a><br/>-->
                    No recuerda su clave? <a href="clave.php" class="">Recuperela aquí</a>
                </div>
            </div>
        </div>
    </div>
<?php
}

function checkMasterAccount() {
    global $db;
    $query = "SELECT * FROM Personas";
    $result = $db->query($query);
    if($result->num_rows == 0) {
        $query = "INSERT INTO Personas VALUES ('123',1,1,'00000','Admin','Admin','Admin','Admin','xxx','xxx','xxx','1',3)";
        echo $query;
        if($result = $db->query($query)) {
            $query = "INSERT INTO Usuario VALUES (123,1,123)";
            echo $query;
            $db->query($query);
        }
         
    }
}

    

?>