<?php
  $message=$_POST['message']; 

  exec("Registro_Asistencia.exe {$message}",$output,$returnStatus);

  foreach($output as $line)
  {
   echo '<input type="text" class="form-control" name="tarjeta" id="tarjeta" value='.$line.' readonly style="padding-left:4px;padding-right:2px;">';
  }
  //echo "Return Status: {$returnStatus}";

  $outkill = shell_exec('taskkill /F /IM "Registro_Asistencia.exe"');
?>