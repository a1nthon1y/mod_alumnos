<?php
  
    if($_REQUEST){
      include ("connection.php");
      $conn = new connection();
      $db = $conn->connect();
      global $error, $db;
            
      switch($_REQUEST['action']){
        case 'registro':
          if($_REQUEST['rel_cedula']){
            
            $query = "SELECT Personas.primerNombre, Personas.primerApellido FROM Personas WHERE Personas.cedula = '$_REQUEST[rel_cedula]'";
            $result = $db->query($query);
            //$result = mysql_query($query);
            if($result->num_rows > 0){
              while(($row = $result->fetch_assoc())){
    ?>
              <thead class="thead">
                <tr>
                  <th colspan="4">Horario registrado para <font color="red"><?php echo $row['primerNombre']." ".$row['primerApellido']; ?></font></th>
                </tr>
                <tr>
                  <th>Dia</th>
                  <th>Horas</th>
                  <th>Materia</th>
                  <th>Curso</th>
                </tr>
              </thead>
              <tbody class="tbody" id="bodyTabla" name="rel_horario" style="max-height:100px;overflow-y:scroll;">
    <?php     }
              $query = "SELECT Hora.dia, Hora.hora_inicio, Hora.hora_fin, Curso.grado, Curso.seccion, Materia.nombre FROM Personas INNER JOIN Relacion ON Personas.cedula = Relacion.Personas_cedula INNER JOIN Curso ON Curso.idCurso = Relacion.Curso_idCurso INNER JOIN Materia ON Materia.idMateria = Relacion.Materia_idMateria INNER JOIN Hora ON Hora.idHora = Relacion.Hora_idHora WHERE Personas.cedula = '$_REQUEST[rel_cedula]'";    
              $result = $db->query($query);
              if($result->num_rows > 0){
                while(($row = $result->fetch_assoc())){
                  $dia = $row['dia'];
                  $inicio = date('g:i a', strtotime($row['hora_inicio']));
                  $fin = date('g:i a', strtotime($row['hora_fin']));
                  $hora = $inicio." ".$fin;
                  $materia = $row['nombre'];
                  $grado = $row['grado']." ".$row['seccion'];
        ?>  
                    <tr style="font-size:12px;">
                      <td><?php echo $dia; ?></td>
                      <td><?php echo $hora; ?></td>
                      <td><?php echo $materia; ?></td>
                      <td><?php echo $grado; ?></td>
                    </tr>
      <?php
                }
              } else {
                echo "<tr><td>No hay Horario registrado</td></tr>";
              }
              echo "</tbody>";
            }
          }
          break;
        
        case 'consulta':
          global $db, $inicio, $fin, $inicio2, $fin2, $horas2, $curso, $materia, $horas, $dia, $error;
          $query = "SELECT Hora.dia, Hora.hora_inicio, Hora.hora_fin, Curso.grado, Curso.seccion, Materia.nombre FROM Personas INNER JOIN Relacion ON Personas.cedula = Relacion.Personas_cedula INNER JOIN Curso ON Curso.idCurso = Relacion.Curso_idCurso INNER JOIN Materia ON Materia.idMateria = Relacion.Materia_idMateria INNER JOIN Hora ON Hora.idHora = Relacion.Hora_idHora WHERE Personas.cedula = '$_POST[cedula]'";
          $result = $db->query($query);
          if($result->num_rows > 0){
            $query2 = "SELECT * FROM Hora";
            $result2 = $db->query($query2);
            if($result2->num_rows > 0){
              $i=0;
              while(($row2 = $result2->fetch_assoc())){
                $inicio2[$i] = date("g:i a",strtotime($row2['hora_inicio']));
                $fin2[$i] = date("g:i a",strtotime($row2['hora_fin']));
                $horas2[$i] = $inicio2[$i]." - ".$fin2[$i];
                $i++;
              }
            }
            $i=0;
            while(($row = $result->fetch_assoc())){
              $inicio[$i] = date("g:i a",strtotime($row['hora_inicio']));
              $fin[$i] = date("g:i a",strtotime($row['hora_fin']));
              $horas[$i] = $inicio[$i]." - ".$fin[$i];
              $dia[$i] = $row['dia'];
              $materia[$i] = $row['nombre'];
              $curso[$i] = $row['grado']." ".$row['seccion'];
              $i++;
            }
          } else {
              $error="No hay horario registrado";
          }
          break;
        
      }
      
      
    }
?>