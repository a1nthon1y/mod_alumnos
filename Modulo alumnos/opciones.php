<?php
include ("connection.php");
$conn = new connection();
$db = $conn->connect();
$query = "SELECT * FROM Personas INNER JOIN Curso_has_Personas WHERE cedula = Personas_cedula AND Curso_idCurso = '$_POST[text]'";
$result = $db->query($query);
if($result->num_rows > 0){
    echo "<option value=''>Seleccione un estudiante</option>";
    while($row = $result->fetch_assoc()) {
        echo "<option value='".$row[cedula]."'>".$row[cedula]." - ".$row[primerNombre]." ".$row[segundoNombre]." ".$row[primerApellido]." ".$row[segundoApellido]."</option>";  
    }
} else {
    echo "<option value=''>No hay estudiantes registrados</option>";
}
?> 

    
               
            