<?php
  $message=$_POST['message']; 
  $outkill = shell_exec('taskkill /F /IM "Registro_Asistencia2.exe"');
  exec("Registro_Asistencia3.exe {$message}",$output,$returnStatus);

/*foreach($output as $line)
  {
   echo $line;
  }
  echo "Return Status: {$returnStatus}";*/
  
  $outkill = shell_exec('taskkill /F /IM "Registro_Asistencia3.exe"');
?>