<?php
 include ("dbConfig.php");
   
   class connection {
        var $host = host;
        var $user = user; 
        var $password = pass;
        var $db = db;
        var $dbc;

        function connect() {
            $conn = mysqli_connect($this->host, $this->user, $this->password, $this->db);
            if(!$conn){
                die('Error en la conexion con la Base de Datos!');
            } else {
                $this->dbc = $conn; 
            }
            mysqli_set_charset($this->dbc, "utf8"); 
            return $this->dbc;
        }
    }
?>