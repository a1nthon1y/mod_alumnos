<?php
 
 require ('../workspace/frameworks/fpdf181/mc_table.php');
      include ("connection.php");
     $db = new connection();
     $db = $db->connect();
     
    $pdf=new PDF_MC_Table();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',16);
    generarReporte($pdf);
    if(isset($_POST['descargar'])) {
        $pdf->Output("Reporte" . " - " . $_POST['repor_estudiantes'] . ".pdf", "D", true);
    } else if(isset($_POST['enviar'])) {
        enviarArchivo($pdf);
    }
 
 function consultarBD() {
     global $db;
     $query = "SELECT correo FROM Personas WHERE cedula IN (SELECT cedulaRepresentante FROM Alumno_Representante WHERE cedulaEstudiante = '$_POST[repor_estudiantes]')";
     $result = $db->query($query);
     $row =  $result->fetch_assoc();
     return $row['correo'];
 }
 
 function enviarArchivo($pdf) {
    require '../workspace/frameworks/PHPMailer/PHPMailerAutoload.php'; 
    $mail = new PHPMailer;
    $mail->isSMTP();                             //Set mailer to use SMTP
    $mail->Host = "smtp.gmail.com";              // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                      // Enable SMTP authentication
    $mail->Username = "tesisurbe05@gmail.com";   // SMTP username
    $mail->Password = "arduino05";               // SMTP password
    $mail->SMTPsecure = "tls";                   // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                           // TCP port to dbect to
    $mail->addStringAttachment($pdf->Output("S"), "Reporte" . " - " . $_POST['repor_estudiantes'] . ".pdf");
    $mail->setFrom('tesisurbe05@gmail.com', 'Tesis Urbe');
    $mail->Subject = "Reporte - " . $_POST['repor_estudiantes'];
    $mail->Body = "Aqui se encuentra el reporte de asistencia solicitado\nEste es un mensaje automatizado, por favor no envie ni responda a este correo.";
    if(!$mail->send()) {
    echo "<script>alert('El mensaje no ha podido ser enviado');</script>";
    echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
    echo "<script>alert('El correo ha sido enviado con exito!');</script>";
    }
    header('Refresh:0.0001; url=Reportes.php');
 } 


  function generarReporte($pdf) {
    global $db;
        Headerr($pdf);
        //PRIMER QUERY
		$query = "SELECT * FROM Personas WHERE cedula = '$_POST[repor_estudiantes]'";
		$result = $db->query($query);
		$row = $result->fetch_assoc();

        $texto = utf8_decode("Cédula: ") . $row['cedula'];
        $texto2 = "Nombre completo: " . $row['primerNombre'] . " " . $row['segundoNombre']." " . $row['primerApellido'] . " " . $row['segundoApellido'].' / '.$texto3 = utf8_decode("Teléfono: ") . $row['telefono'];
        
        //SEGUNDO QUERY
        $query = "SELECT idCurso, grado,Año,seccion FROM Curso_has_Personas INNER JOIN Curso WHERE Personas_cedula = '$_POST[repor_estudiantes]' AND Curso_idCurso = idCurso";
		$result = $db->query($query);
		$row = $result->fetch_assoc();

        $texto4 = "Grado: " . $row['grado'].' / '.utf8_decode("Sección: ") . $row['seccion'].' / '.utf8_decode(" Año escolar: ") . $row['Año'];
    
        $pdf->Cell(0,170, $texto,0,0,'C');
        $pdf->Cell(-190,180, $texto2,0,0,'C');
        $pdf->Ln(10);
        $pdf->Cell(0,190, $texto4,0,0,'C');
        $pdf->Ln(100);
        $pdf->SetWidths(array(70,40,40,40));;
        
        //TERCER QUERY
        $query = "SELECT idMateria, nombre, Relacion_Curso_idCurso, COUNT(*) as 'Asistencias' FROM Asistencia_Curso INNER JOIN Materia WHERE Curso_has_Personas_Personas_cedula = '$_POST[repor_estudiantes]' AND Relacion_Materia_idMateria = idMateria GROUP BY nombre";
        $result = $db->query($query);
        
        //QUINTO QUERY
        $query3 = "SELECT COUNT(*) as 'Retrasos' FROM Asistencia_Curso INNER JOIN Materia WHERE Curso_has_Personas_Personas_cedula = '$_POST[repor_estudiantes]' AND Relacion_Materia_idMateria = idMateria AND retraso = 1 GROUP BY nombre"; 
        $result3 = $db->query($query3); //$_POST[repor_estudiantes]

    $i=0;
    	//TIENEN QUE AGREGAR ESTO
    while($row = $result->fetch_assoc() AND $row3 = $result3->fetch_assoc()) {
		if($i==0) $pdf->Row(array("MATERIAS","ASISTENCIAS","FALTAS","RETRASOS"));
	
		$faltas = contarFaltas($row['Asistencias'],$row['idMateria'],$row['Relacion_Curso_idCurso']); //FALTAS
		
		$pdf->Row(array($row['nombre'],$row['Asistencias'],$faltas,$row3['Retrasos']));
		$i++;
        }
        //TIENEN QUE AGREGAR ESTO
        
  }
  
  //TIENEN QUE AGREGAR ESTO
  function contarFaltas($asistencias, $idMateria, $idCurso) {
      $fechaIni = openFile(1);
      $date1 = date_create($fechaIni);
      $date2 = date_create(date("Y/m/d"));
      $diff = date_diff($date1,$date2);
      $diff = $diff->format("%R%a days");
      $diff = ceil($diff/7); //Diferencia entre las fechas en semanas (fecha de inicio y fecha actual)
      $numeroClases = cantidadClases($idMateria, $idCurso);
      $faltas = ($diff * $numeroClases) - $asistencias;
      return $faltas;
  }
  
  function cantidadClases($idMateria, $idCurso) {
      global $db;
      $query = "SELECT COUNT(*) as 'noClases' FROM Relacion WHERE Curso_idCurso = '$idCurso' AND Materia_idMateria = '$idMateria'";
      $result = $db->query($query);
      $row = $result->fetch_assoc();
      return $row['noClases'];
  }
  //TIENEN QUE AGREGAR ESTO
      
  function Headerr($pdf) {
    $name = openFile(0);
    $image1 = "../workspace/fotos/institucion/" . $name;
    //$pdf->Image($image1,10,6,60); 
    $pdf->Cell(90);
    $pdf->Cell(50,50, substr($name,0,strpos($name,".")),0,0,'C');
    $pdf->Ln(35);
    $pdf->Cell(90);
    $pdf->Cell(25,30, "REPORTE DE ASISTENCIAS",0,0,'C'); 
    $pdf->Cell(-30,50, "Datos del estudiante",0,0,'C');
    //$pdf->Image(findImage(),80,75,60); 
    $pdf->SetFont('Arial','B',14);
    $pdf->Cell(-85);
  }
  
  //TIENEN QUE AGREGAR ESTO
  function openFile($opc) {
      $myFile = '../workspace/fotos/institucion/nombre.txt';
      $line = file($myFile);
      if($opc == 0) return $line[0];
      return $line[1];
  }
 
  function findImage() {
       $foto = '../workspace/fotos/' . $_POST['repor_estudiantes'] . ".";
       if(file_exists($foto . "jpg")) $foto = $foto . "jpg";
       else if(file_exists($foto . "png")) $foto = $foto . "png";
       else if(file_exists($foto . "jpeg")) $foto = $foto . "jpeg";
       return $foto;
  }
  //TIENEN QUE AGREGAR ESTO