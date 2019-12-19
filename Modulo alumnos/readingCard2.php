<?php
  include ("connection.php");
  $conn = new connection();
  $db = $conn->connect();

  $message=$_POST['message']; 

  exec("Registro_Asistencia2.exe {$message}",$output,$returnStatus);

  foreach($output as $line)
  {
    global $db;
    $query = "SELECT * FROM Personas INNER JOIN Curso_has_Personas ON Personas.cedula = Curso_has_Personas.Personas_cedula WHERE Personas.tarjetaID = '$line' AND Curso_has_Personas.Curso_idCurso = '$_POST[curso]'"; 
    $result = $db->query($query);
    if($result->num_rows > 0){
      while(($row = $result->fetch_assoc())){
        $datos['nombre'] = $row['primerNombre'].' '.$row['segundoNombre'].' '.$row['primerApellido'].' '.$row['segundoApellido'];
        $datos['cedula'] = $row['cedula'];
        echo json_encode($datos);
        //echo '<option id="'.$row['cedula'].'">'.$row['cedula'].' - '.$row['primerNombre'].' '.$row['segundoNombre'].' '.$row['primerApellido'].' '.$row['segundoApellido'].'</option>';
      }
    }
    
   	/*?>
   	<script>
   		$(document).ready(function() {
   			$('#origenEstudiante').append('<option>'+<?php $line; ?>+'</option>');
   		});
	  </script>
   	<?php*/
  }
  $outkill = shell_exec('taskkill /F /IM "Registro_Asistencia2.exe"');
  //echo "Return Status: {$returnStatus}";
?>