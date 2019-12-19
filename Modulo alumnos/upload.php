<?php 

//TIENEN QUE MODIFICAR/AGREGAR ESTO
   function upload($cedula, $opc = 2, $fecha = 0) {
        if($_FILES["avatar"]["error"] != 1) {
            $name = $_FILES["avatar"]["name"];
            $ext = substr($name,strpos($name,".") + 1);
            $ext = strtolower($ext);
            if($opc == 1) {
                $target_dir = "fotos/institucion/";
                file_put_contents('../workspace/fotos/institucion/nombre.txt', $cedula . "." . $ext . "\n" . $fecha);
            } else if($opc == 2) $target_dir = "fotos/";
            $target_file = $target_dir . $cedula . "." . $ext;
            $uploadOk1 = checkifimage($_FILES["avatar"]["tmp_name"]);
            $uploadOk2 = alreadyExists($target_file);
            $uploadOk3 = checkSize($_FILES["avatar"]["size"]);
            $uploadOk4 = allowedTypeFiles($ext);
            if($uploadOk1 and $uploadOk2 and $uploadOk3 and $uploadOk4) {
                if(!move_uploaded_file($_FILES["avatar"]["tmp_name"],$target_file)) {  
                    echo "<script>alert('No ha sido posible subir su foto');</script>";
                } else echo "<script>alert('Foto almacenada con exito!');</script>";
            } else echo "<script>alert('No ha cumplido con los requisitos exigidos para la imagen');</script>";
        } else echo "<script>alert('Existen problemas con el archivo que tratas de subir');</script>";
     return false;
   }
    
        function checkifimage($tmp_name) {
            if(getimagesize($tmp_name)) return true;
            return false;  
        }
        
        function alreadyExists($target_file) {
            if(!file_exists($target_file)) return true;
            if(unlink($target_file)) return true;
            return false; 
        }
        
        function checkSize($size_file){
            if($size_file <= 15000000) return true;
            return false;
        }
        
        function allowedTypeFiles($file_type) {
             $type = array('jpg','png','jpeg');
             if(in_array($file_type,$type)) return true;
             return false;
        }
    
?>