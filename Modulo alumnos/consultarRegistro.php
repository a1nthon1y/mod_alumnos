<?php
include ("connection.php");
$conn = new connection();
$db = $conn->connect();

switch ($_REQUEST['action']) {
    case 'retraso':
        $query = "SELECT * FROM Asistencia_Curso WHERE Relacion_Personas_cedula = '$_POST[text]' AND retraso = 1";
        $result = $db->query($query);
        
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
               // $hora = conHora($row['Relacion_Hora_idHora']);
               // echo $hora[0] . " " . $hora[1] . " " . $hora[2];
                $horas = conHora($row['Relacion_Hora_idHora']);
                echo "<option value='". $row['idAsistenciaEst'] . "'>" . conMateria($row['Relacion_Materia_idMateria']) . " / "  . $horas[0] . ": " . date('g:i a', strtotime($horas[1])) . " - " . date('g:i a', strtotime($horas[2])) . " / " . date('d-m-Y g:i a', strtotime($row['fecha_hora'])) . " / " . returnJustificado($row['justificado']) . "</option>";
            }
        } else {
            echo "<option value='' disabled>El estudiante no posee retrasos</option>";
        }
        break;
    
    case 'asistencia':
        $query = "SELECT * FROM Asistencia_Curso WHERE Relacion_Personas_cedula = '$_POST[text]'";
        $result = $db->query($query);
        
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
               // $hora = conHora($row['Relacion_Hora_idHora']);
               // echo $hora[0] . " " . $hora[1] . " " . $hora[2];
                $horas = conHora($row['Relacion_Hora_idHora']);
                echo "<tr><td>".conMateria($row['Relacion_Materia_idMateria'])."</td>
                <td>".$horas[0].": ".date('g:i a', strtotime($horas[1]))." - ".date('g:i a', strtotime($horas[2]))."</td>
                <td>".date('d-m-Y g:i a', strtotime($row['fecha_hora']))."</td>
                <td>".returnRetraso($row['retraso'])."</td></tr>";
            }
        } else {
            echo "<option value='' disabled>El estudiante no posee asistencias</option>";
        }
        break;
}


 function conMateria($idMateria) {
     global $db;
     $query = "SELECT nombre FROM Materia WHERE idMateria = '$idMateria'";
     $result = $db->query($query);
     $row = $result->fetch_assoc();
     echo $query;
     return $row['nombre'];
 }
 
 function conHora($idHora) {
     global $db;
     $query = "SELECT * FROM Hora WHERE idHora = '$idHora'";
     $result = $db->query($query);
     $row = $result->fetch_assoc();
     $horas[0] = $row['dia'];
     $horas[1] = $row['hora_inicio'];
     $horas[2] = $row['hora_fin'];
     return $horas;
 }
 
 function returnJustificado($justi) {
     if($justi == 0) return "No justificado";
     return "Justificado";
 }
 
 function returnRetraso($retraso) {
     if($retraso == 0) return "-";
     return "Retraso";
 }

?> 