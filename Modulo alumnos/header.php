<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}else{
    if(!(isset($_SESSION['user']))){
        session_destroy();
        session_start(); 
    }
}
   /* if(!isset($_SESSION['user']) and $_SERVER['REQUEST_URI'] != "/index.php") {
        header("Location: index.php");
    } */ 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>TESIS</title>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html" charset="utf-8" /> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="styles.css">

        <link rel="stylesheet" href="../frameworks/bootstrap-3.3.6-dist/css/bootstrap.css">
        <link rel="stylesheet" href="../frameworks/bootstrap-3.3.6-dist/css/bootstrap-theme.min.css">
        
        <script src="../frameworks/jquery-1.11.1.min.js"></script>
        <!--<script src="../frameworks/jquery-2.1.4.min.js"></script>-->
        <script src="../frameworks/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
        
        <!-- SCRIPT PARA validar -->
        <link href="../frameworks/jquery/bootstrap-validator/css/bootstrapValidator.min.css" rel="stylesheet" type="text/css" />
        <script src="../frameworks/jquery/bootstrap-validator/js/bootstrapValidator.min.js"></script>
	    <script src="../frameworks/jquery/form-validation.js"></script>
	    
        <style type="text/css">
            .file-input-wrapper { overflow: hidden; position: relative; cursor: pointer; z-index: 1; }.file-input-wrapper input[type=file], .file-input-wrapper input[type=file]:focus, .file-input-wrapper input[type=file]:hover { position: absolute; top: 0; left: 0; cursor: pointer; opacity: 0; filter: alpha(opacity=0); z-index: 99; outline: 0; }.file-input-name { margin-left: 8px; }
        </style>
            
       
        <!-- SCRIPT PARA TABLAS -->
        
        <link href="../frameworks/jquery/jquery-datatables/css/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="../frameworks/jquery/jquery-datatables/extensions/TableTools/css/dataTables.tableTools.css" rel="stylesheet" type="text/css" />
        <script src="../frameworks/jquery/jquery-datatables/js/jquery.dataTables.min.js"></script>
    	<script src="../frameworks/jquery/jquery-datatables/js/dataTables.bootstrap.js"></script>
    	<script src="../frameworks/jquery/jquery-datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
    	<script src="../frameworks/jquery/datatables.js"></script>
        
        <script src="selectBox.js"></script>
        <script src="filas.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-default">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>                        
              </button>
              <a class="navbar-brand" href="index.php">Institucion Educativa</a>
            </div>
<?php   if(isset($_SESSION['user'])){ ?>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
        <?php   switch ($_SESSION['nivel_id']) {
                    case '1':
                        $_SESSION['nivel_nombre']="Administrador";
                        Admin();
                    break;
                    case '2':
                        $_SESSION['nivel_nombre']="Docente";
                        Profesor();
                    break;
                    case '3':
                        $_SESSION['nivel_nombre']="Personal";
                        Personal();
                    break;
                } ?>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a><span class="glyphicon glyphicon-user"></span>
                       <?php echo ($_SESSION['primerNombre']." ".$_SESSION['primerApellido']); ?>
                    </a></li>
                    <li><a href="cerrarSesion.php"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
                </ul>
            </div>
<?php   } else menu();?>
          </div>
        </nav>
        
        <div class="container" style="margin-bottom:0px; height:100%;">
            <center>
            
<?php //MENU!
function Admin(){
    echo "<li><a href='index.php'><i class='glyphicon glyphicon-home'></i> Inicio</a></li>
          <li class='dropdown'><a class='dropdown-toggle' data-toggle='dropdown' href='#'><i class='glyphicon glyphicon-wrench'></i> Configuración <span class='caret'></span></a>
            <ul class='dropdown-menu'>
                <li><a href='institucion.php'><i class='glyphicon glyphicon-home'></i> Institución</a></li>
                <li><a href='usuarios.php'><i class='glyphicon glyphicon-user'></i> Usuarios</a></li>
            </ul>
          </li>
          <li class='dropdown'><a class='dropdown-toggle' data-toggle='dropdown' href=''><i class='glyphicon glyphicon-time'></i> Horario <span class='caret'></span></a>
            <ul class='dropdown-menu'>
                <li><a href='horarioPersonal.php'><i class='glyphicon glyphicon-calendar'></i> Personal</a></li>
                <li><a href='horarioClases.php'><i class='glyphicon glyphicon-calendar'></i> Clases</a></li>
                <li class='divider'></li>
                <li><a href='relacion.php'><i class='glyphicon glyphicon-resize-small'></i> Relacion</a></li>
            </ul>
          </li>
          <li class='dropdown'><a class='dropdown-toggle' data-toggle='dropdown' href=''><i class='glyphicon glyphicon-home'></i> Curso <span class='caret'></span></a>
            <ul class='dropdown-menu'>
                <li><a href='grado.php'><i class='glyphicon glyphicon-record'></i> Grados</a></li>
                <li><a href='materias.php'><i class='glyphicon glyphicon-book'></i> Materias</a></li>
            </ul>
          </li>
          <li class='dropdown'><a class='dropdown-toggle' data-toggle='dropdown' href='#'><i class='glyphicon glyphicon-user'></i> Personas <span class='caret'></span></a>
            <ul class='dropdown-menu'>
                <li><a href='estudiantes.php'><i class='glyphicon glyphicon-user'></i> Estudiante</a></li>
                <li class='divider'></li>
                <li class='dropdown-submenu'><a class='dropdown-toggle' data-toggle='dropdown' href='#'><i class='glyphicon glyphicon-user'></i> Personal</a>
                    <ul class='dropdown-menu'>
        				<li><a href='cargo.php'><i class='glyphicon glyphicon-tag'></i> Cargo</a></li>
        				<li><a href='personal.php'><i class='glyphicon glyphicon-user'></i> Personal</a></li>
    				</ul>
                </li>
                <li class='divider'></li>
                <li><a href='control.php'><i class='glyphicon glyphicon-resize-small'></i> Control de asistencia</a></li>
                <li><a href='retraso.php'><i class='glyphicon glyphicon-list-alt'></i> Gestionar retrasos</a></li>
            </ul>
          </li>
          <li><a href='Reportes.php'><i class='glyphicon glyphicon-list-alt'></i> Reportes</a></li>";
}

function Personal(){
    echo "<li><a href='index.php'><i class='glyphicon glyphicon-home'></i> Inicio</a></li>
          <li><a href='perfil.php'><i class='glyphicon glyphicon-user'></i> Perfil</a></li>
          <li class='dropdown'><a class='dropdown-toggle' data-toggle='dropdown' href='#'><i class='glyphicon glyphicon-user'></i> Personas <span class='caret'></span></a>
            <ul class='dropdown-menu'>
                <li><a href='estudiantes2.php'><i class='glyphicon glyphicon-user'></i> Estudiante</a></li>
                <li><a href='personal2.php'><i class='glyphicon glyphicon-user'></i> Personal</a></li>
                <li class='divider'></li>
                <li><a href='control.php'><i class='glyphicon glyphicon-resize-small'></i> Control de asistencia</a></li>
            </ul>
          </li>
          <li><a href='Reportes.php'><i class='glyphicon glyphicon-list-alt'></i> Reportes</a></li>";
}

function Profesor(){
    echo "<li><a href='index.php'><i class='glyphicon glyphicon-home'></i> Inicio</a></li>
          <li><a href='perfil.php'><i class='glyphicon glyphicon-user'></i> Perfil</a></li>
          <li class='dropdown'><a class='dropdown-toggle' data-toggle='dropdown' href='#'><i class='glyphicon glyphicon-home'></i> Personas <span class='caret'></span></a>
            <ul class='dropdown-menu'>
                <li><a href='estudiantes2.php'><i class='glyphicon glyphicon-user'></i> Estudiante</a></li>
                <li><a href='personal2.php'><i class='glyphicon glyphicon-user'></i> Personal</a></li>
                <li class='divider'></li>
                <li><a href='control.php'><i class='glyphicon glyphicon-resize-small'></i> Control de asistencia</a></li>
            </ul>
          </li>
          <li class='dropdown'><a class='dropdown-toggle' data-toggle='dropdown' href=''><i class='glyphicon glyphicon-calendar'></i> Clases <span class='caret'></span></a>
            <ul class='dropdown-menu'>
                <li><a href='asistencia.php'><i class='glyphicon glyphicon-pencil'></i> Asistencia</a></li>
                <li><a href='horarioDocente.php'><i class='glyphicon glyphicon-time'></i> Horario</a></li>
            </ul>
          </li>
          <li><a href='Reportes.php'><i class='glyphicon glyphicon-list-alt'></i> Reportes</a></li>";
}

function menu(){
    echo '<div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav"><li><a href="index.php">
                <li><i class="glyphicon glyphicon-home"></i> Inicio</a></li>
            </ul>
        </div>';
}
?>            
