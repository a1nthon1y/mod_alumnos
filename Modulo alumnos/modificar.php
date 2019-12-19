<?php
/*include ("connection.php");
$conn = new connection();
$db = $conn->connect();*/
$error;
//include ("upload.php");

if(isset($_POST['modPerfil'])) {
    modificarPerfil();
}

function modificarPerfil(){
    global $error, $db;
    $query = "SELECT * FROM Personas WHERE cedula = '$_POST[per_cedula]'";
    $result = $db->query($query);
    if($result->num_rows > 0) {
        $query = "UPDATE  Personas SET primerNombre = '$_POST[per_nombre1]', segundoNombre = '$_POST[per_nombre2]', primerApellido = '$_POST[per_apellido1]', segundoApellido = '$_POST[per_apellido2]', correo = '$_POST[per_email]', telefono = '$_POST[per_telefono]', direccion = '$_POST[per_direccion]' WHERE cedula =  '$_POST[per_cedula]'";
        if($result = $db->query($query)){
            echo "<script>alert('¡Datos Actualizados con exito!');</script>";
        }else {
            $error = "Error en el proceso: no se pudieron actualizar los datos";
        }
        if($_FILES["avatar"]["name"] != ''){
            upload($_POST['per_cedula']);
        }
        
    }else {
        $error = 'No hay personas registrada con esa cedula';
    }
}

if(isset($_POST['modUsuario'])) {
    modificarUsuario();
}

function modificarUsuario(){
    global $error, $db;
    $query = "SELECT * FROM Usuario WHERE Personas_cedula = '$_POST[usu_cedula]'";
    $result = $db->query($query);
    if($result->num_rows > 0) {
        $query = "UPDATE Usuario SET nivel = '$_POST[usu_nivel]' WHERE Personas_cedula =  '$_POST[usu_cedula]'";
        if($result = $db->query($query)){
            echo "<script>alert('¡Datos Actualizados con exito!');</script>";
        }else {
            $error = "Error en el proceso: no se pudieron actualizar los datos";
        }
    }else {
        $error = 'No hay usuario registrado con esa cedula';
    }
}

if(isset($_POST['deleteUser'])) {
        deleteUsuario();
}

function deleteUsuario(){
    global $error, $db;
    $query = "SELECT * FROM Usuario WHERE Personas_cedula = '$_POST[usu_cedula]'";
    $result = $db->query($query);
    if($result->num_rows > 0) {
        $query = "DELETE FROM Usuario WHERE Personas_cedula = '$_POST[usu_cedula]'";
        if($result = $db->query($query)){
            echo "<script>alert('¡Usuario eliminado!');</script>";
        }else {
            $error = "Error en el proceso: no se elimnar el usuario";
        }
    }else {
        $error = 'No hay usuario registrado con esa cedula';
    }
}

if(isset($_POST['modHorarioP'])) {
    modificarHorarioP();
}

function modificarHorarioP(){
    global $error, $db;
    $query = "SELECT * FROM Horario_Personal WHERE idHorario_Personal = '$_POST[idHorarioP]'";
    $result = $db->query($query);
    if($result->num_rows > 0) {
        $query = "UPDATE Horario_Personal SET dia = '$_POST[diaHorarioP]', hora_inicio = '$_POST[inicioHorarioP]', hora_fin = '$_POST[finHorarioP]' WHERE idHorario_Personal = '$_POST[idHorarioP]'";
        if($result = $db->query($query)){
            echo "<script>alert('¡Datos Actualizados con exito!');</script>";
        }else {
            echo "<script>alert('Error en el proceso: no se pudieron actualizar los datos');</script>";
        }
    }else {
        echo "<script>alert('¡No hay datos con ese id!');</script>";
    }
}

if(isset($_POST['deleteHorarioP'])) {
        deleteHorarioP();
}

function deleteHorarioP(){
    global $error, $db;
    $query = "SELECT * FROM Horario_Personal WHERE idHorario_Personal = '$_POST[idHorarioP]'";
    $result = $db->query($query);
    if($result->num_rows > 0) {
        $query = "DELETE FROM Horario_Personal WHERE idHorario_Personal = '$_POST[idHorarioP]'";
        if($result = $db->query($query)){
            echo "<script>alert('¡Horario eliminado!');</script>";
        }else {
            $error = "Error en el proceso: no se elimino el horario";
        }
    }else {
        $error = 'No hay usuario registrado con esa cedula';
    }
}


function modificarGrado(){
    global $error, $db;
    $query = "SELECT * FROM Curso WHERE idCurso = '$_POST[idCurso]'";
    $result = $db->query($query);
    if($result->num_rows > 0) {
        $query = "UPDATE Curso SET grado = '$_POST[grado]' WHERE idCurso = '$_POST[idCurso]'";
        if($result = $db->query($query)){
            echo "<script>alert('¡Datos Actualizados con exito!');</script>";
        }else {
            echo "<script>alert('Error en el proceso: no se pudieron actualizar los datos');</script>";
        }
    }else {
        echo "<script>alert('¡No hay datos con ese id!');</script>";
    }
}


function deleteGrado(){
    global $error, $db;
    $query = "SELECT * FROM Curso WHERE idCurso = '$_POST[idCurso]'";
    $result = $db->query($query);
    if($result->num_rows > 0) {
        $query = "DELETE FROM Curso WHERE idCurso = '$_POST[idCurso]'";
        if($result = $db->query($query)){
            echo "<script>alert('¡Curso eliminado!');</script>";
        }else {
            echo "<script>alert('¡Error en el proceso: no se elimino el curso!');</script>";
        }
    }else {
        $error = 'No hay usuario registrado con esa cedula';
    }
}

function modificarMateria(){
    global $error, $db;
    $query = "SELECT * FROM Materia WHERE idMateria = '$_POST[idMateria1]'";
    $result = $db->query($query);
    if($result->num_rows > 0) {
        $query = "UPDATE Materia SET nombre = '$_POST[nombre]', idMateria = '$_POST[idMateria]' WHERE idMateria = '$_POST[idMateria1]'";
        if($result = $db->query($query)){
            echo "<script>alert('¡Datos Actualizados con exito!');</script>";
        }else {
            echo "<script>alert('Error en el proceso: no se pudieron actualizar los datos');</script>";
        }
    }else {
        echo "<script>alert('¡No hay datos con ese id!');</script>";
    }
}

function deleteMateria(){
    global $error, $db;
    $query = "SELECT * FROM Materia WHERE idMateria = '$_POST[idMateria1]'";
    $result = $db->query($query);
    if($result->num_rows > 0) {
        $query = "DELETE FROM Materia WHERE idMateria = '$_POST[idMateria1]'";
        if($result = $db->query($query)){
            echo "<script>alert('¡Materia eliminado!');</script>";
        }else {
            echo "<script>alert('¡Error en el proceso: no se elimino la materia!');</script>";
        }
    }else {
        echo "<script>alert('¡No hay datos con ese id!');</script>";
    }
}

function modificarCargo(){
    global $error, $db;
    $query = "SELECT * FROM Cargo WHERE idCargo = '$_POST[idCargo]'";
    $result = $db->query($query);
    if($result->num_rows > 0) {
        $query = "UPDATE Cargo SET descripcion = '$_POST[cargo]' WHERE idCargo = '$_POST[idCargo]'";
        if($result = $db->query($query)){
            echo "<script>alert('¡Datos Actualizados con exito!');</script>";
        }else {
            echo "<script>alert('Error en el proceso: no se pudieron actualizar los datos');</script>";
        }
    }else {
        echo "<script>alert('¡No hay datos con ese id!');</script>";
    }
}


function deleteCargo(){
    global $error, $db;
    $query = "SELECT * FROM Cargo WHERE idCargo = '$_POST[idCargo]'";
    $result = $db->query($query);
    if($result->num_rows > 0) {
        $query = "DELETE FROM Cargo WHERE idCargo = '$_POST[idCargo]'";
        if($result = $db->query($query)){
            echo "<script>alert('¡Cargo eliminado!');</script>";
        }else {
            echo "<script>alert('¡Error en el proceso: no se elimino el Cargo!');</script>";
        }
    }else {
        echo "<script>alert('¡Error en el proceso: No hay Cargo registrado con esa id!');</script>";
    }
}


    if(isset($_POST['modEstudiante'])) {
        modificarEstudiante();
    }

    function modificarEstudiante() {
        global $error, $db;
        $query = "SELECT * FROM Personas WHERE cedula = '$_POST[cedula]'";
        $result = $db->query($query);
        if($result->num_rows > 0){
            $query2 = "UPDATE Personas SET primerNombre = '$_POST[nombre1]', segundoNombre = '$_POST[nombre2]', primerApellido = '$_POST[apellido1]', segundoApellido = '$_POST[apellido2]', correo = '$_POST[email]', telefono = '$_POST[telefono]' WHERE cedula = '$_POST[cedula]'";
            if($result2 = $db->query($query2)) {
                echo "<script>alert('Estudiante: ".$_POST['nombre1']." ".$_POST['apellido1']." modificado con exito.');</script>";
            } else{
                echo "<script>alert('Error en el proceso: no se pudo modificar al estudiante');</script>";
            }
        } else {
            echo "<script>alert('No existe estudiante con esta cedula');</script>";
        }
    }
    
    if(isset($_POST['modEstudianteStatus'])) {
        modificarEstudianteStatus();
    }

    function modificarEstudianteStatus() {
        global $error, $db;
        $query = "SELECT * FROM Personas WHERE cedula = '$_POST[statusCedula]'";
        $result = $db->query($query);
        $estadoNuevo = 1;
        $estadoN = 'Activado';
        if($result->num_rows > 0){
            while(($row = $result->fetch_assoc())){
                $nombre = $row['primerNombre']." ".$row['segundoNombre']." ".$row['primerApellido']." ".$row['segundoApellido'];
                $estadoActual = $row['estado'];
            }
            if($estadoActual == 1){
                $estadoNuevo = 2;
                $estadoN = 'Desactivado';
            } else{
                $estadoNuevo = 1;
                $estadoN = 'Activado';
            }
            $query2 = "UPDATE Personas SET estado = '$estadoNuevo' WHERE cedula = '$_POST[statusCedula]'";
            if($result2 = $db->query($query2)) {
                echo "<script>alert('Estudiante: ".$nombre." ha sido ".$estadoN.".');</script>";
            } else{
                echo "<script>alert('Error en el proceso: no se pudo modificar al estudiante');</script>";
            }
        } else {
            echo "<script>alert('No existe estudiante con esta cedula');</script>";
        }
    }
    
    if(isset($_POST['modPersonal'])) {
        modificarPersonal();
    }

    function modificarPersonal() {
        global $error, $db;
        $query = "SELECT * FROM Personas WHERE cedula = '$_POST[per_cedula]'";
        $result = $db->query($query);
        if($result->num_rows > 0){
            $query2 = "UPDATE Personas SET Cargo_idCargo = '$_POST[per_cargo]', primerNombre = '$_POST[per_nombre1]', segundoNombre = '$_POST[per_nombre2]', primerApellido = '$_POST[per_apellido1]', segundoApellido = '$_POST[per_apellido2]', correo = '$_POST[per_email]', telefono = '$_POST[per_telefono]', direccion = '$_POST[per_direccion]' WHERE cedula = '$_POST[per_cedula]'";
            if($result2 = $db->query($query2)) {
                echo "<script>alert('Trabajador: ".$_POST['per_nombre1']." ".$_POST['per_apellido1']." modificado con exito.');</script>";
            } else{
                echo "<script>alert('Error en el proceso: no se pudo modificar al Trabajador');</script>";
            }
        } else {
            echo "<script>alert('No existe Trabajador con esta cedula');</script>";
        }
    }
    
    if(isset($_POST['modPersonalStatus'])) {
        modificarPersonalStatus();
    }

    function modificarPersonalStatus() {
        global $error, $db;
        $query = "SELECT * FROM Personas WHERE cedula = '$_POST[statusCedula]'";
        $result = $db->query($query);
        $estadoNuevo = 1;
        $estadoN = 'Activado';
        if($result->num_rows > 0){
            while(($row = $result->fetch_assoc())){
                $nombre = $row['primerNombre']." ".$row['segundoNombre']." ".$row['primerApellido']." ".$row['segundoApellido'];
                $estadoActual = $row['estado'];
            }
            if($estadoActual == 1){
                $estadoNuevo = 2;
                $estadoN = 'Desactivado';
            } else{
                $estadoNuevo = 1;
                $estadoN = 'Activado';
            }
            $query2 = "UPDATE Personas SET estado = '$estadoNuevo' WHERE cedula = '$_POST[statusCedula]'";
            if($result2 = $db->query($query2)) {
                echo "<script>alert('Trabajador: ".$nombre." ha sido ".$estadoN.".');</script>";
            } else{
                echo "<script>alert('Error en el proceso: no se pudo modificar al trabajador');</script>";
            }
        } else {
            echo "<script>alert('No existe Trabajador con esta cedula');</script>";
        }
    }


?>