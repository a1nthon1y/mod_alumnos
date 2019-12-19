<?php
include ("connection.php");
$conn = new connection();
$db = $conn->connect();
$error;

include ("upload.php"); 
    //TIENEN QUE AGREGAR ESTO
    if(isset($_POST['acepInstitucion'])) {
        upload($_POST['institucion'], 1, $_POST['FechaIni']);
    }
     //TIENEN QUE AGREGAR ESTO
    
    if(isset($_POST['acepEstudiante'])) {
        registrarRepresentante();
    }
    
    if(isset($_POST['acepPersonal'])) {
        registrarPersonal();
    }   
    
    if(isset($_POST['acepUsuario'])) {
        registrarUsuario();
    }
    
    if(isset($_POST['acepHorasC'])) {
        global $db,$error;
        $query = "SELECT * FROM Hora"; 
        $result = $db->query($query);
        if($result->num_rows < 10){
           registrarHorarioClases(); 
        }else{
            $error="Ya esta cargado";
        }
        
    }
    
    if(isset($_POST['cambio'])) {
        actualizarRegistro();
    }
    
    function actualizarRegistro() {
        global $db;
        $updated;
        foreach($_POST['retrasos'] as $ret) {
            $just = consultarJustificacion($ret);
            if($just == 0) {
                $query = "UPDATE Asistencia_Estudiante SET justificado = 1 WHERE idAsistenciaEst = '$ret'";
                if($result = $db->query($query)) $updated = true;
                
            } else if($just == 1) {
                $query = "UPDATE Asistencia_Estudiante SET justificado = 0 WHERE idAsistenciaEst = '$ret'";
                if($result = $db->query($query)) $updated = true;
            }
        }
      if($updated) {
          echo "<script>alert('Registro/s actualizado/s con exito!');</script>";
      }  
    }
    
    function consultarJustificacion($ret) {
        global $db;
        $query = "SELECT justificado FROM Asistencia_Estudiante WHERE idAsistenciaEst = '$ret'";
        $result = $db->query($query);
        $row = $result->fetch_assoc();
        return $row['justificado'];
    }
    
    function registrarUsuario() {
        global $error, $db;
        $query = "SELECT * FROM Usuario WHERE cedula = '$_POST[usu_cedula]'";
        $result = $db->query($query);
        if($result->num_rows > 0) {
            $error = "Usuario ya registrado";
        }else {
            $query = "INSERT INTO Usuario VALUES ('$_POST[usu_cedula]','$_POST[usu_nivel]','$_POST[usu_contras]')";
            if($result = $db->query($query)){
                echo "<script>alert('¡Usuario creado con exito!');</script>";
            }else {
                $error = "Error en el proceso: no se pudo registrar al usuario";
            }
        }
    }
    
    /*function validarUsuario() {
        if(validaClaves($_POST['usu_contras'], $_POST['usu_contras2'])) {
           validarCedula($_POST['usu_cedula']);
        }
         else {
             $error = "Las contraseñas no coinciden";
         }
        
    }
    function validaClaves($Clave1, $Clave2){
        if($Clave1 != $Clave2){
            return false;
        }else{
            return true;
        }
    }   
    function validarCedula($cedula) {
        global $error, $db;
        $query = "SELECT tipo FROM Personas WHERE cedula = '$cedula'";
        $result = $db->query($query);
        if($result->num_rows > 0) {
             $row = $result->fetch_assoc();
             if($row['tipo'] == 2 or $row['tipo'] == 3) {
                 $query = "INSERT INTO Usuario VALUES ('$cedula','$_POST[nivel]','$_POST[usu_contras]')";
                 if($result = $db->query($query)){
                     echo "<script>alert('¡Registro con exito!');</script>";
                 }
                  else {
                      $error = "No ha sido posible registrar al usuario";
                  }
             }
              else {
                  $error = "Solo el personal y los docentes pueden registrar usuario";
              }
        } 
         else {
             $error = "No existen personas con esa cedula";
         }
    }
    
    function registrarInstitucion() {
        global $error, $db;
        $query = "SELECT * FROM institucion"; 
        $result = $db->query($query);
        if($result->num_rows > 0) {
            $error = "Solo se puede modificar el registro";
        } else {
            $query = "INSERT INTO institucion VALUES (DEFAULT,'$_POST[institucion]','$_POST[grados]', 'logo')";
            if($result = $db->query($query)) {
                upload();
            } else{
                $error = "Error en el proceso";
            }
        } 
    } */
    
    function registrarRepresentante() {
        global $error, $db;
        if(count($_POST) == 19) { //numero de campos post para saber si se esta llenado un repre
            $query = "SELECT * FROM Personas WHERE cedula = '$_POST[ren_cedula]'";
            $result = $db->query($query);
            if($result->num_rows > 0){
                $error = "El representante ya esta registrado";
            } else {
                $query2 = "INSERT INTO Personas VALUES ('$_POST[ren_cedula]',NULL,NULL,'00000001','$_POST[ren_nombre1]','$_POST[ren_nombre2]','$_POST[ren_apellido1]','$_POST[ren_apellido2]','$_POST[ren_direccion]','$_POST[ren_email]','$_POST[ren_telefono]','1','4')";
                if($result2 = $db->query($query2)) {
                    echo "<script>alert('Representante: ".$_POST['ren_nombre1']." ".$_POST['ren_apellido1']." almacenado con exito.');</script>";
                    registrarEstudiante();
                } else{
                    echo "<script>alert('Error en el proceso: no se pudo registrar al representante');</script>";
                    return;
                }
            }
        } else if(count($_POST) == 12) {

            $query = "SELECT * FROM Personas WHERE cedula = '$_POST[ren_cedula]'";
            $result = $db->query($query);
            if($result->num_rows > 0) {
                registrarEstudiante();
            } else {
                echo "<script>alert('Error en el proceso: no se encontro al representante');</script>";
                return;
            }
        }
    }
    
    function registrarEstudiante() {
        global $error, $db;
        $cedula = $_POST['doc'] . $_POST['cedula'];
        $query = "SELECT * FROM Personas WHERE cedula = '$cedula'";
        $result = $db->query($query);
        if($result->num_rows > 0){
            echo "<script>alert('El estudiante ya esta registrado');</script>";
        } else {
            $query2 = "INSERT INTO Personas VALUES ('$cedula',NULL,NULL,'$_POST[tarjeta]','$_POST[nombre1]','$_POST[nombre2]','$_POST[apellido1]','$_POST[apellido2]','La del representante','$_POST[email]','$_POST[telefono]','1','1')";
            if($result2 = $db->query($query2)) {
                echo "<script>alert('Estudiante: ".$_POST['nombre1']." ".$_POST['apellido1']." almacenado con exito.');</script>";
                asignar();
            } else{
                echo "<script>alert('Error en el proceso: no se pudo registrar al estudiante');</script>";
                return;
            }
        }
    }
    
    function asignar() {   //relacion entre estudiante y representante
        global $error, $db;
        $cedula = $_POST['doc'] . $_POST['cedula'];
        $cedula_ren = $_POST['ren_cedula'];
        $query = "INSERT INTO Alumno_Representante VALUES ('$cedula','$cedula_ren')";
        if($result = $db->query($query)) {
            if(registrarEstToCurso()) {
            echo "<script>alert('Relacion estuadiante-representante realizado con exito!');</script>";
                upload($cedula);
            }
        }
        else {
            echo "<script>alert('Error en el proceso: no se pudo establecer la relacion');</script>";
            return false;
        }
    }    
    
    function registrarEstToCurso() {
        global $db;
        $cedula = $_POST['doc'] . $_POST['cedula'];
        $year = date("Y");
        $query = "INSERT INTO Curso_has_Personas VALUES ('$cedula','$_POST[curso]','$year')";
        if($result = $db->query($query)){
            echo "<script>alert('Inscripción del estudiante en el curso realizado con exito!');</script>";
            return true;
        }
        else {
            echo "<script>alert('Error en el proceso: no se pudo realizar la inscripcion en el curso');</script>";
            return false;
        } 
        
    }
        
    function registrarPersonal(){
        global $error, $db;
        $query = "SELECT * FROM Personas WHERE cedula = '$_POST[per_cedula]'";
        $result = $db->query($query);
        if($result->num_rows > 0){
            $error = "El trabajador ya esta registrado";
        } else {
            if($_POST['per_cargo'] == 7){  //el 7 es por el cargo Docente para ver que tipo es.. 
                $tipo = 2;
            } else $tipo = 3;
            if($_POST['per_horario'] == '') $horario='NULL';
            else $horario=$_POST['per_horario'];
            //$horario = 21;
            $query2 = "INSERT INTO Personas VALUES ('$_POST[per_cedula]',$horario,'$_POST[per_cargo]','$_POST[tarjeta]','$_POST[per_nombre1]','$_POST[per_nombre2]','$_POST[per_apellido1]','$_POST[per_apellido2]','$_POST[per_direccion]','$_POST[per_email]','$_POST[per_telefono]','1','$tipo');";
            if($result2 = $db->query($query2)) {                //'$_POST[per_horario]'
                echo "<script>alert('Trabajador: ".$_POST['per_nombre1']." ".$_POST['per_apellido1']." almacenado con exito.');</script>";
                upload($_POST['per_cedula']);
                return true;
            } else{
                echo "<script>alert('Error en el proceso: no se pudo registrar al trabajador');</script>";
                return false;
            }
        }
    }    
        
    function registrarHorarioPersonal($diaHorarioP,$horaInicialP,$horaFinalP){
        global $error, $db;
        /*$query = "SELECT * FROM Horario_Personal WHERE grado = '$gradoNombre'"; 
        $result = $db->query($query);
        if($result->num_rows > 0) {
            return false;
        } else {*/
            $query = "INSERT INTO Horario_Personal VALUES ('Default', '$horaInicialP', '$horaFinalP', '$diaHorarioP')";
            if($result = $db->query($query)) {
               echo "<script>alert('Horario: ".$diaHorarioP." de ".date('g:i a', strtotime($horaInicialP))." a ".date('g:i a', strtotime($horaFinalP))." fue almacenado con exito.');</script>";   
                return true;    
                
            }else{
                echo "<script>alert('Error en el proceso: no se pudo registrar el horarior');</script>";
                return false;
            } 
        //}
    }
    
    function registrarHorarioClases(){
        global $error, $db;
        $hora[0] = date('g:i a', strtotime('07:00:00'));
        for($i=0; $i<10; $i++){
            if($i==2)  $hora[$i+1] = date('G:i a', strtotime('+30 minutes', strtotime($hora[$i])));
            else if($i==7) $hora[$i+1] = date('G:i a', strtotime('+10 minutes', strtotime($hora[$i])));
            else $hora[$i+1] = date('G:i a', strtotime('+40 minutes', strtotime($hora[$i])));
        }
        $dias = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes");
        for($i=0; $i<10; $i++){
            $inicio = $hora[$i];
            $final = $hora[$i+1];
            for($j=0; $j<5; $j++){
                $query = "INSERT INTO Hora VALUES ('Default', '$dias[$j]', '$inicio', '$final')";
                if($result = $db->query($query)) {
                   //echo "<script>alert('Horario: ".$diaHorarioC." de ".$horaInicialC." a ".$horaFinalC." con paso de ".$pasoC."min fue almacenado con exito.');</script>";   
                    $error = '';
                }else{
                    $error = 'Hubo un error';
                    //echo "<script>alert('Error en el proceso: no se pudo registrar la hora');</script>";
                }
            }
            
        }
        return $error;
    }
    
    function registrarGrados($gradoNombre, $gradoSeccion) {
        global $error, $db;
        $query = "SELECT * FROM Curso WHERE grado = '$gradoNombre' and seccion = '$gradoSeccion'"; 
        $result = $db->query($query);
        if($result->num_rows > 0) {
            return false;
        } else {
            $query = "INSERT INTO Curso VALUES ('Default', '$gradoNombre', '$gradoSeccion')";
            if($result = $db->query($query)) {
               echo "<script>alert('Grado: ".$gradoNombre." ".$gradoSeccion." fue almacenado con exito.');</script>";   
                return true;
            }else{
                echo "<script>alert('Error en el proceso: no se pudo registrar el grado');</script>";
                return false;
            } 
        } 
    }
    
    function registrarMaterias($materiaID, $nombre) {
        global $error, $db;
        $query = "SELECT * FROM Materia WHERE idMateria = $materiaID"; 
        $result = $db->query($query);
        if($result->num_rows > 0) {
            return false;
        } else {
            $query = "INSERT INTO Materia VALUES ('$materiaID', '$nombre')";
            if($result = $db->query($query)) {
               echo "<script>alert('Materia: ".$nombre." fue registrada con exito.');</script>";   
            return true;
            }else{
                echo "<script>alert('Error en el proceso: no se pudo registrar la materia');</script>";
                return false;
            }  
        } 
    }
    
    function registrarRelacion($rel_cedula, $rel_hora, $rel_materia, $rel_curso) {
        global $error, $db;
        $query = "SELECT * FROM Relacion WHERE Curso_idCurso = '$rel_curso' and Materia_idMateria = '$rel_materia' and Hora_idHora = '$rel_hora' and Personas_cedula = '$rel_cedula'"; 
        $result = $db->query($query);
        if($result->num_rows > 0) {
            echo "<script>alert('Error en el proceso: Relacion existente');</script>";
            return false;
        } else {
            $query = "SELECT * FROM Relacion WHERE Hora_idHora = '$rel_hora' and Personas_cedula = '$rel_cedula'"; 
            $result = $db->query($query);
            if($result->num_rows > 0) {
                echo "<script>alert('Error en el proceso: docente ya tiene asignada esa hora');</script>";
                $error="hora ya esta asignada";
                return false;
            } else {
                $query = "INSERT INTO Relacion VALUES ('$rel_curso', '$rel_materia', '$rel_hora', '$rel_cedula')";
                if($result = $db->query($query)) {
                    echo "<script>alert('Relacion fue registrada con exito.');</script>";   
                    return true;
                }else{
                    echo "<script>alert('Error en el proceso: no se pudo registrar la relacion');</script>";
                    $error="error no hubo relacion";
                    return false;
                } 
            }
        } 
    }
    
    /*function registrarCursos($cursoID, $materiaID) {
        global $error, $db;
        $query = "SELECT * FROM curso WHERE cursoID = '$cursoID'"; 
        $result = $db->query($query);
        if($result->num_rows > 0) {
            $query = "SELECT * FROM materia WHERE materiaID = '$materiaID'"; 
            $result = $db->query($query);
            if($result->num_rows > 0) {
                $query = "SELECT * FROM relacionCursoMateria WHERE relacion_cursoID = '$cursoID' and relacion_materiaID = '$materiaID'";
                if($result = $db->query($query)) {
                    $query = "INSERT INTO relacionCursoMateria VALUES ('$cursoID', '$materiaID')";
                    if($result = $db->query($query)) {
                        return true;
                     } else return false; 
                }else return false; 
            } else return false; 
        } else return false; 
    }*/
    
    function registrarCargos($cargoDesc) {
        global $error, $db;
        $query = "INSERT INTO Cargo VALUES ('Default', '$cargoDesc')";
        if($result = $db->query($query)) {
            return true;   
        } else{
            return false;
        } 
    }
    
    if(isset($_POST['acepClaveNueva'])) {
        registrarNuevaClave($_POST['usu_cedula'], $_POST['usu_clave']);
    }   
    
    function registrarNuevaClave($cedula, $clave) {
        global $error, $db;
        $query = "UPDATE Usuario SET clave = '$clave' WHERE Personas_cedula = '$cedula'";
        if($result = $db->query($query)) {
            echo "<script>alert('Su clave fue actualizada');</script>"; 
            //header('Location: clave.php');
            return true;   
        } else{
            echo "<script>alert('Error en el proceso: no se pudo actualizar la clave');</script>";
            return false;
        } 
    } 
?>