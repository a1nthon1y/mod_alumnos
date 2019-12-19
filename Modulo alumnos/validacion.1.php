<?php    
   /* if(!isset($_SESSION)) 
    { 
        session_start(); 
    }else{
        if(!(isset($_SESSION['user']))){
            session_destroy();
            session_start(); 
        }
    }*/
    
    include ("connection.php");
    $conn = new connection();
    $db = $conn->connect();
    $error;

    if(isset($_POST['ingUser'])) {
        $user = $_POST['user'];
        $password = $_POST['password'];
        validarUsuario($user, $password);
    }
    
    
    function validaNombre($Nombre){
        if(trim($Nombre) == '' || preg_match("/^[a-zA-Z]+$/", $Nombre) != 1){
            return false;
        }else{
            return true;
        }
    }

    function validaApellido($Apellido){
        if(trim($Apellido) == '' || preg_match("/^[a-zA-Z]+$/", $Apellido) != 1){
            return false;
        }else{
            return true;
        }
    }

    function validaUsuario($Usuario){
        if(trim($Usuario) == '' || preg_match("/^[a-zA-Z0-9\-_]+$/", $Usuario) != 1){
            return false;
        }else{
            return true;
        }
    }

    function validaClave($Clave){
        if(trim($Clave) == '' || preg_match("/^[a-zA-Z0-9]+$/", $Clave) != 1){
            return false;
        }else{
            return true;
        }
    }

    function validaClaves($Clave1, $Clave2){
        if($Clave1 != $Clave2){
            return false;
        }else{
            return true;
        }
    }    

    function validaEmail($email){
        if(filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE){
            return false;
        }else{
            return true;
        }
    }

    function validaUsuarioRepetido($Nombre, $Apellido, $Correo, $Usuario, $Clave, $error_nombre, $error_apellido, $error_usuario, $error_correo, $error_clave){
        $BDD_Conn = mysqli_connect("localhost","root","");
        if(!mysqli_connect_errno()){            
            if($error_nombre == '' && $error_apellido == '' && $error_usuario == '' && $error_correo == '' && $error_clave == ''){
                $BDD = mysqli_select_db($BDD_Conn,"Cart_BDD");
                if(!$BDD){
                    echo "Error de conexion con la base de datos";
                } else{
                    $Insert = mysqli_query($BDD_Conn,"INSERT INTO Cliente values('$Usuario','$Clave','$Nombre','$Apellido','$Correo')");
                    if(!$Insert){
                        return false;
                    }else{
                        return true;
                    }
                }
            }else{
                return true;
            }
        }else{
            echo "Failed to connect to MySQL: " . mysqli_connect_errno();
        }
    }    

    function validarUsuario($user, $password){
        global $error, $db;
        
        $query = "SELECT * FROM usuario_personal WHERE Personal_cedula = '$user'";            
        $result = $db->query($query);
        $row = $result->fetch_assoc();
        if($row){                
            if($row['Personal_cedula'] == $user && $row['password'] == $password){
                $_SESSION['user'] = $user;
                $_SESSION['nivel'] = $row['Nivel_Usuario_idNivel_Usuario'];
                $query2 = "SELECT * FROM personal WHERE cedula = $user";
                $result2 = $db->query($query2);
                $row2 = $result2->fetch_assoc();
                if($row2){
                    $_SESSION['primerNombre'] = $row2['primerNombre'];
                    $_SESSION['segundoNombre'] = $row2['segundoNombre'];
                    $_SESSION['primerApellido'] = $row2['primerApellido'];
                    $_SESSION['segundoApellido'] = $row2['segundoApellido'];
                    $_SESSION['cedula'] = $row2['cedula'];
                    $_SESSION['tarjeta'] = $row2['tarjetaID'];
                    $_SESSION['cargo'] = $row2['Cargo_idCargo'];
                    $_SESSION['correo'] = $row2['correo'];
                    $_SESSION['telefono'] = $row2['telefono'];
                    
                    header('Location: index.php');   
                } else {
                    return false;
                }
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
?>