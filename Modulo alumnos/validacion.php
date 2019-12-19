<?php    
    /*include ("connection.php");
    $conn = new connection();
    $db = $conn->connect();*/
    $error;  

    if(isset($_POST['btnLogin'])) {
        $user = $_POST['user'];
        $password = $_POST['password'];
        validarUsuario($user, $password);
    }
    
    function validarUsuario($user, $password){
        global $error, $db;
        $query = "SELECT * FROM Usuario INNER JOIN Personas ON Personas.cedula = Usuario.Personas_cedula WHERE Usuario.Personas_cedula = '$user'";            
        $result = $db->query($query);
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if($row){  
                if($row['Personas_cedula'] == $user && $row['clave'] == $password){
                    $_SESSION['user'] = $user;
                    $_SESSION['nivel_id'] = $row['nivel'];
                    
                    $_SESSION['primerNombre'] = $row['primerNombre'];
                    $_SESSION['segundoNombre'] = $row['segundoNombre'];
                    $_SESSION['primerApellido'] = $row['primerApellido'];
                    $_SESSION['segundoApellido'] = $row['segundoApellido'];
                    $_SESSION['cedula'] = $row['cedula'];
                    $_SESSION['tarjeta'] = $row['tarjetaID'];
                    $_SESSION['correo'] = $row['correo'];
                    $_SESSION['telefono'] = $row['telefono'];
                    $_SESSION['direccion'] = $row['direccion'];
                    
                    $query2 = "SELECT * FROM Cargo WHERE idCargo = '$row[Cargo_idCargo]'"; 
                    $result2 = $db->query($query2);
                    $row2 = $result2->fetch_assoc();
                    if($row2){
                        $_SESSION['cargo'] = $row2['descripcion'];
                    }else{
                        $_SESSION['cargo'] = 'No tiene cargo';
                    }
                            
                    $query3 = "SELECT * FROM Horario_Personal WHERE idHorario_Personal = '$row[Horario_Personal_idHorario_Personal]'"; 
                    $result3 = $db->query($query3);
                    $row3 = $result2->fetch_assoc();
                    if($row3){
                        $_SESSION['horario'] = $row3['dia']." ".date("g:i ", strtotime($row3['hora_inicio']))." - ".date("g:i ", strtotime($row3['hora_fin']));
                    }else{
                        $_SESSION['horario'] = 'Horario de clase';
                    }
                    header('Location: index.php');  
                }else{
                    $error = 'Usuario y/o contraseña inválido';
                }
            }else{
                $error = 'Usuario y/o contraseña inválido';
            }
        } else {
            $error = 'Usuario y/o contraseña inválido';
        } 
    }
    
    function validarInstitucion() {
        global $error, $db;
        $query = "SELECT * FROM institucion";            
        $result = $db->query($query);
        if($result->num_rows > 0) {
            return true;
        }
    }
    
?>