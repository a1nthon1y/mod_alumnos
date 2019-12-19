<?php
/*include ("connection.php");
$conn = new connection();
$db = $conn->connect();*/
  
    function consultarGrado($cursoID){   //consulta de un solo grado para cambiar nombre
      global $db;
      $query = "SELECT * FROM curso where cursoID='$cursoID'"; 
      $result = $db->query($query);
      if($result->num_rows > 0){
        $gradoID = $row['cursoID'];
        $gradoNombre=$row['grado'];
      }
    }
    
    function consultarGrados1(){ 
      global $db, $gradoId, $gradoNombre, $gradoSeccion;
      $query = "SELECT * FROM Curso"; 
      $result = $db->query($query);
      if($result->num_rows > 0){
        $i=0;
        while(($row = $result->fetch_assoc())){
          $gradoId[$i] = $row['idCurso'];
          $gradoNombre[$i] = $row['grado'];
          $gradoSeccion[$i] = $row['seccion'];
          $i++;
        }
      }
    }
    
    function consultarGrados2(){  //tabla
      global $db;
      $query = "SELECT * FROM Curso"; 
      $result = $db->query($query);
      if($result->num_rows > 0){
        while(($row = $result->fetch_assoc())){
          $gradoNombre = $row['grado'];
          $gradoSeccion = $row['seccion'];
          echo "<tr><td>".$gradoNombre." ".$gradoSeccion."</td></tr>";
        }
      }else{
        echo "<tr><td>No ha registrado grados</td></tr>";
      }
    }
    
    function consultarGrados3(){  //saber cantidad de grados registrados
      global $db, $gradosTotal;
      global $grado;
      global $seccion;
      global $gradoNombre, $id;
      $query = "SELECT * FROM Curso"; 
      $result = $db->query($query);
      if($result->num_rows > 0){
        $gradosTotal = $result->num_rows;
        $i=0;
        while($row = $result->fetch_assoc()){
          //$gradoNombre[$i] = $row['grado'];
          $id[$i] = $row['idCurso'];
          $grado[$i] = $row['grado'];
          $seccion[$i] = $row['seccion'];
          $gradoNombre[$i] = $row['grado'];
          $i++;
        }
      }else{
        echo "NO HAY CURSOS";
      }
    }
    
    function consultarGrados4(){   //select
      global $db;
      $query = "SELECT * FROM Curso"; 
      $result = $db->query($query);
      if($result->num_rows > 0){
        echo "<option value=''>Seleccione un curso</option>";
        while(($row = $result->fetch_assoc())){
          $gradoId = $row['idCurso'];
          $gradoNombre = $row['grado'];
          $gradoSeccion = $row['seccion'];
          echo "<option value='".$gradoId."'>".$gradoNombre." - ".$gradoSeccion."</option>";
        }
      }
    }
    
    function consultarEstudianteGrado($grado, $seccion){  
      global $db, $cedula, $nombre;
      global $correo, $telefono;
      global $estado;
      $query = "SELECT idCurso FROM Curso WHERE grado = '$grado' and seccion = '$seccion'"; 
      $result = $db->query($query);
      if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
          $idCurso = $row['idCurso'];
          $query2 = "SELECT Personas_cedula FROM Curso_has_Personas WHERE Curso_idCurso = '$idCurso'";
          $result2 = $db->query($query2);
          if($result2->num_rows > 0){
            while($row2 = $result2->fetch_assoc()){
              $cedula = $row2['Personas_cedula'];
              $query3 = "SELECT * FROM Personas WHERE cedula = '$cedula'";
              $result3 = $db->query($query3);
              if($result3->num_rows > 0){
                $i=0;
                while($row3 = $result3->fetch_assoc()){
                  $cedula = $row3['cedula'];
                  $nombre = $row3['primerNombre']." ".$row3['segundoNombre']." ".$row3['primerApellido']." ".$row3['segundoApellido'];
                  $correo = $row3['correo'];
                  $telefono = $row3['telefono'];
                  $estado = $row3['estado'];
                  if($estado == 1) $estado="Activo";
                  else $estado="Inactivo";
                  ?>
                    <tr style="font-size:12px;">
                      <td><?php echo $cedula; ?></td>
                      <td><?php echo $nombre; ?></td>
                      <td><?php echo $correo; ?></td>
                      <td><?php echo $telefono; ?></td>
                      <td><?php echo $estado; ?></td>
                    </tr>
                  <?php
                  $i++;
                }
              }else{
                echo "<tr><td>No hay estudiante con esas especificaciones</td></tr>";
              }
            }
          }else{
            return false;
          }
        }
      }else{
        echo "<tr><td>No hay curso con esas especificaciones</td></tr>";
      }
    }
    
          
    
    function consultarMateria(){  //multiselect
      global $db;
      $query = "SELECT * FROM Materia"; 
      $result = $db->query($query);
      if($result->num_rows > 0){
        while(($row = $result->fetch_assoc())){
          $materiaID = $row['idMateria'];
          $materiaNombre=$row['nombre'];
          echo "<option value='".$materiaID."'>".$materiaNombre."</option>";
        }
      } else {
          echo "Resgistre materias en el módulo Materia";
      }
    }
    
    function consultarMateria2(){ //tabla
      global $db;
      $query = "SELECT * FROM Materia"; 
      $result = $db->query($query);
      if($result->num_rows > 0){
        while(($row = $result->fetch_assoc())){
          $materiaID = $row['idMateria'];
          $materiaNombre=$row['nombre'];
          echo "<tr><td>".$materiaID." - ".$materiaNombre."</td></tr>";
        }
      } else {
          echo "<tr><td>No hay materias registradas</td></tr>";
      }
    }
    
    function consultarMaterias3($grado){ //por grado
      global $db;
      $query = "SELECT * FROM materia INNER JOIN relacionCursoMateria ON materia.materiaID = relacionCursoMateria.relacion_materiaID INNER JOIN curso ON cursoID.curso = relacionCursoMateria.relacion_cursoID WHERE cursoID = "+$grado+""; 
      $result = $db->query($query);
      if($result->num_rows > 0){
        while(($row = $result->fetch_assoc())){
          $materiaID = $row['materiaID'];
          $materiaNombre=$row['nombre'];
          echo "<tr><td>".$materiaID." - ".$materiaNombre."</td></tr>";
        }
      } else {
          echo "<tr><td>No hay materias registradas</td></tr>";
      }
    }
    
    function consultarMateria1(){ //Consultar
      global $db;
      $query = "SELECT * FROM materia"; 
      $result = $db->query($query);
      if($result->num_rows > 0){
        while(($row = $result->fetch_assoc())){
          $materiaID = $row['materiaID'];
          $materiaNombre=$row['nombre'];
          echo "<option value='".$materiaID."'>".$materiaNombre."</option>";
        }
      } else {
          echo "Resgistre materias en el módulo Materia";
      }
    }
    
    function consultarMateria5(){ //modificar
      global $db, $id, $nombre;
      $query = "SELECT * FROM Materia"; 
      $result = $db->query($query);
      if($result->num_rows > 0){
        $i=0;
        while(($row = $result->fetch_assoc())){
          $id[$i] = $row['idMateria'];
          $nombre[$i] = $row['nombre'];
          $i++;
        }
      } else {
          echo "<tr><td>No hay materias registradas</td></tr>";
      }
    }
    
    function consultarEstudiante() {
        global $error, $db, $cedula, $tarjetaID, $primerNombre, $segundoNombre, $primerApellido, $segundoApellido;
        global $correo, $telefono, $estado, $estadoN, $curso;
        $query = "SELECT * FROM Personas INNER JOIN Curso_has_Personas ON Personas.cedula = Curso_has_Personas.Personas_cedula WHERE Personas.tipo = 1";
        $result = $db->query($query);
      if($result->num_rows > 0){
        $i=0;
        while(($row = $result->fetch_assoc())){
          $cedula[$i] = $row['cedula'];
          $tarjetaID[$i] = $row['tarjetaID'];
          $primerNombre[$i] = $row['primerNombre'];
          $segundoNombre[$i] = $row['segundoNombre'];
          $primerApellido[$i] = $row['primerApellido'];
          $segundoApellido[$i] = $row['segundoApellido'];
          $correo[$i] = $row['correo'];
          $telefono[$i] = $row['telefono'];
          $estado[$i] = $row['estado'];
          if($estado[$i] == 1) $estadoN[$i] = "Activo";
          else $estadoN[$i] = "Inactivo";
          
          $curso[$i] = $row['Curso_idCurso'];
          $i++;
        }
      } else {
          echo "No hay estudiantes registrados";
      }
    }
    
    function consultarPersonal() {
        global $error, $db, $cedula, $tarjetaID, $primerNombre, $segundoNombre, $primerApellido, $segundoApellido;
        global $correo, $telefono, $estado, $estadoN, $direccion, $cargo, $cargoid;
        $query = "SELECT * FROM Personas INNER JOIN Cargo ON Personas.Cargo_idCargo = Cargo.idCargo WHERE Personas.tipo = 2 or Personas.tipo = 3";
        $result = $db->query($query);
      if($result->num_rows > 0){
        $i=0;
        while(($row = $result->fetch_assoc())){
          $cedula[$i] = $row['cedula'];
          $tarjetaID[$i] = $row['tarjetaID'];
          $primerNombre[$i] = $row['primerNombre'];
          $segundoNombre[$i] = $row['segundoNombre'];
          $primerApellido[$i] = $row['primerApellido'];
          $segundoApellido[$i] = $row['segundoApellido'];
          $cargo[$i] = $row['descripcion'];
          $cargoid[$i] = $row['idCargo'];
          $correo[$i] = $row['correo'];
          $telefono[$i] = $row['telefono'];
          $direccion[$i] = $row['direccion'];
          $estado[$i] = $row['estado'];
          if($estado[$i] == 1) $estadoN[$i] = "Activo";
          else $estadoN[$i] = "Inactivo";
          $i++;
          /*?>
            <tr style="font-size:12px;">
              <td><?php echo $cedula; ?></td>
              <td><?php echo $tarjetaID; ?></td>
              <td><?php echo $nombre; ?></td>
              <td><?php echo $cargo; ?></td>
              <td><?php echo $correo; ?></td>
              <td><?php echo $telefono; ?></td>
              <td><?php echo $estado; ?></td>
            </tr>
          <?php*/
        }
      } else {
          echo "<tr><td>No hay trabajadores registrados</td></tr>";
      }
    }
    
    function consultarPersonal2() {   //para el modulo usuario
      global $error, $db;
      $query = 'SELECT * FROM Personas WHERE tipo = 2 AND NOT EXISTS (SELECT * FROM Usuario where Usuario.Personas_cedula = Personas.cedula)';
      $query2 = 'SELECT * FROM Personas WHERE tipo = 3 AND NOT EXISTS (SELECT * FROM Usuario where Usuario.Personas_cedula = Personas.cedula)';
      $result = $db->query($query);
      $result2 = $db->query($query2);
      if($result->num_rows > 0){
        while(($row = $result->fetch_assoc())){
          $cedula = $row['cedula'];
          $nombre = $row['primerNombre']." ".$row['segundoNombre']." ".$row['primerApellido']." ".$row['segundoApellido'] ;
          ?>
            <option value="<?php echo $cedula; ?>"><?php echo $cedula." - ".$nombre; ?></option>
          <?php
        }
      }
        if($result2->num_rows > 0){
          while($row2 = $result2->fetch_assoc()){
            $cedula = $row2['cedula'];
            $nombre = $row2['primerNombre']." ".$row2['segundoNombre']." ".$row2['primerApellido']." ".$row2['segundoApellido'] ;
            ?>
              <option value="<?php echo $cedula; ?>"><?php echo $cedula." - ".$nombre; ?></option>
            <?php
          }
        }
    }
    
    
    function consultarPersonal3($i) {
        global $error, $db;
        $query = "SELECT * FROM Personas WHERE tipo = $i";
        $result = $db->query($query);
      if($result->num_rows > 0){
        while(($row = $result->fetch_assoc())){
          $cedula = $row['cedula'];
          $tarjetaID = $row['tarjetaID'];
          $nombre = $row['primerNombre']." ".$row['segundoNombre']." ".$row['primerApellido']." ".$row['segundoApellido'] ;
          $correo = $row['correo'];
          $telefono = $row['telefono'];
          $estado = $row['estado'];
          ?>
            <tr>
              <td><?php echo $cedula; ?></td>
              <td><?php echo $nombre; ?></td>
              <td><?php echo $correo; ?></td>
              <td><?php echo $telefono; ?></td>
              <td><?php echo $estado; ?></td>
            </tr>
          <?php
        }
      } else {
          echo "<tr><td>No hay trabajadores registrados</td></tr>";
      }
    }
    
    function consultarDocente() {
        global $error, $db;
        $query = "SELECT * FROM Personas WHERE tipo = 2";
        $result = $db->query($query);
      if($result->num_rows > 0){
        echo "<option value=''>Seleccione un Docente</option>";
        while(($row = $result->fetch_assoc())){
          $cedula = $row['cedula'];
          $nombre = $row['primerNombre']." ".$row['segundoNombre']." ".$row['primerApellido']." ".$row['segundoApellido'] ;
          echo "<option value='".$cedula."'>".$cedula."-".$nombre."</option>";
        }
      } else {
          echo "<option value=''>No hay docente registrado</option>";
      }
    }
    
    function consultarDocentes2() {
      global $error, $db;
      $query = "SELECT * FROM Personas INNER JOIN Relacion ON Personas.cedula = Relacion.Personas_cedula INNER JOIN Curso ON Curso.idCurso = Relacion.Curso_idCurso INNER JOIN Materia ON Materia.idMateria = Relacion.Materia_idMateria INNER JOIN Hora ON Hora.idHora = Relacion.Hora_idHora WHERE Personas.tipo = 2";
      $result = $db->query($query);
      if($result->num_rows > 0){
        $i=0;
        while(($row = $result->fetch_assoc())){
          $cedula = $row['cedula'];
          $nombre = $row['primerNombre']." ".$row['segundoNombre']." ".$row['primerApellido']." ".$row['segundoApellido'];
          $dia = $row['dia'];
          $hora = $row['hora_inicio']." ".$row['hora_fin'];
          $materia = $row['nombre'];
          $grado = $row['grado'];
?>
            <tr style="font-size:12px;">
              <td><?php echo $dia; ?></td>
              <td><?php echo $hora; ?></td>
              <td><?php echo $cedula; ?></td>
              <td><?php echo $nombre; ?></td>
              <td><?php echo $materia; ?></td>
              <td><?php echo $grado; ?></td>
            </tr>
<?php
          $i++;
        }
      } else {
          echo "<option value=''>No hay docente registrado</option>";
      }
    }
    
    /*function consultarHorarioDocenteEspecifico($rel_cedula) {
      global $error, $db;
      $query = "SELECT * FROM Personas INNER JOIN Relacion ON Personas.cedula = Relacion.Personas_cedula INNER JOIN Curso ON Curso.idCurso = Relacion.Curso_idCurso INNER JOIN Materia ON Materia.idMateria = Relacion.Materia_idMateria INNER JOIN Hora ON Hora.idHora = Relacion.Hora_idHora WHERE Personas.cedula = '$rel_cedula'";
      $result = $db->query($query);
      if($result->num_rows > 0){
        $i=0;
        while(($row = $result->fetch_assoc())){
          $inicio = date('g:i a', strtotime($row['hora_inicio']));
          $fin = date('g:i a', strtotime($row['hora_fin']));
          $hora[$i] = $inicio." - ".$fin;
          $materia = $row['nombre'];
          $grado = $row['grado']." ".$row['seccion'];
?>
            <tr style="font-size:12px;">
              <td><?php echo $hora; ?></td>
              <td><?php echo $materia." a ".$grado; ?></td>
            </tr>
<?php
          $i++;
        }
      } else {
          echo "<option value=''>No hay docente registrado</option>";
      }
    }*/
    
    function consultarCedulaRepresentante(){ //Consultar
      global $db;
      $query = "SELECT * FROM Personas WHERE tipo = 4"; 
      $result = $db->query($query);
      if($result->num_rows > 0){
        while(($row = $result->fetch_assoc())){
          $cedula = $row['cedula'];
          $nombre = $row['primerNombre']." ".$row['primerApellido'];
          echo "<option value='".$cedula."'>".$cedula." - ".$nombre."</option>";
        }
      } else {
          echo "<option value=''>No hay registros</option>";
      }
    }
    
    function consultarCargo(){
      global $db;
      $query = "SELECT * FROM Cargo"; 
      $result = $db->query($query);
      if($result->num_rows > 0){
        while(($row = $result->fetch_assoc())){
          $cargoID = $row['idCargo'];
          $cargoDesc=$row['descripcion'];
          echo "<tr><td>".$cargoDesc."</td></tr>";
        }
      } else {
          echo "<tr><td>No hay cargos registrados</td></tr>";
      }
    }
    
    function consultarCargo2(){
      global $db, $id, $cargo;
      $query = "SELECT * FROM Cargo"; 
      $result = $db->query($query);
      if($result->num_rows > 0){
        $i=0;
        while(($row = $result->fetch_assoc())){
          $id[$i] = $row['idCargo'];
          $cargo[$i] = $row['descripcion'];
          $i++;
        }
      } else {
          echo "<tr><td>No hay cargos registrados</td></tr>";
      }
    }
    
    function consultarHorarioPersonal(){
      global $db;
      $query = "SELECT * FROM Horario_Personal"; 
      $result = $db->query($query);
      if($result->num_rows > 0){
        while(($row = $result->fetch_assoc())){
          $inicio = date("g:i a",strtotime($row['hora_inicio']));
          $fin = date("g:i a",strtotime($row['hora_fin']));
          $horas = $inicio." - ".$fin;
          
          if($row['dia']=='Todos') $dia = $row['dia']." los dias";
          else $dia = $row['dia'];
          
          echo "<tr><td>".$dia.": ".$horas."</td></tr>";
        }
      } else {
          echo "<tr><td>No hay horarios registrados</td></tr>";
      }
    }
    
    function consultarHorarioPersonal2(){
      global $db;
      $query = "SELECT * FROM Horario_Personal";
      $result = $db->query($query);
      if($result->num_rows > 0){
        while($row = $result->fetch_assoc()) {
            $inicio = date("g:i a",strtotime($row['hora_inicio']));
            $fin = date("g:i a",strtotime($row['hora_fin']));
            $horas = $inicio." - ".$fin;
              
            if($row['dia']=='Todos') $dia = $row['dia']." los dias";
            else $dia = $row['dia'];
            
            echo "<option value='".$row['idHorario_Personal']."'>".$dia.": ".$horas."</option>"; 
        } 
      } else {
          echo "<option value=''>No hay horarios registrados</option>";
      }
    }
    
    function consultarHorarioPersonal3(){
      global $db, $inicio, $fin, $horas, $id, $dias, $dia;
      $query = "SELECT * FROM Horario_Personal"; 
      $result = $db->query($query);
      if($result->num_rows > 0){
        $i=0;
        while(($row = $result->fetch_assoc())){
          $id[$i] = $row['idHorario_Personal'];
          $inicio[$i] = $row['hora_inicio'];
          $fin[$i] = $row['hora_fin'];
          $horas[$i] = date("g:i a",strtotime($row['hora_inicio']))." - ".date("g:i a",strtotime($row['hora_fin']));
          $dias[$i] = $row['dia'];
          if($row['dia']=='Todos') $dia[$i] = $row['dia']." los dias";
          else $dia[$i] = $row['dia'];
          
          $i++;
        }
      } else {
          echo "<tr><td>No hay horarios registrados</td></tr>";
      }
    }
    
    function consultarHorarioClases(){ //para modulo relacion
      global $db, $inicio, $fin, $id;
      $query = "SELECT * FROM Hora"; 
      $result = $db->query($query);
      if($result->num_rows > 0){
        $i=0;
        while(($row = $result->fetch_assoc())){
          $id[$i] = $row['idHora'];
          $inicio[$i] = date('g:i a', strtotime($row['hora_inicio']));
          $fin[$i] = date('g:i a', strtotime($row['hora_fin']));
          //$horas = "<td>".$inicio." - ".$fin."</td>";
          //echo "<td>".$horas."</td>";
          $i++;
        }
      } else {
          echo "<td>No hay horarios registrados</td>";
      }
    }
    
    function consultarHorarioClases2(){
      global $db;
      $query = "SELECT * FROM Hora"; 
      $result = $db->query($query);
      if($result->num_rows > 0){
        while(($row = $result->fetch_assoc())){
          $idHora = $row['idHora'];
          $horas = $row['hora_inicio']." - ".$row['hora_fin'];
          $dia = $row['dia'];
          echo "<option value='".$idHora."'>".$dia." ".$horas."</option>";
        }
      } else {
          echo "<option value=''>No hay registros</option>";
      }
    }
    
    
    function consultarDocenteHorario(){
      global $db, $inicio, $fin, $inicio2, $fin2, $horas2, $curso, $materia, $horas, $dia, $error;
      $query = "SELECT Hora.dia, Hora.hora_inicio, Hora.hora_fin, Curso.grado, Curso.seccion, Materia.nombre FROM Personas INNER JOIN Relacion ON Personas.cedula = Relacion.Personas_cedula INNER JOIN Curso ON Curso.idCurso = Relacion.Curso_idCurso INNER JOIN Materia ON Materia.idMateria = Relacion.Materia_idMateria INNER JOIN Hora ON Hora.idHora = Relacion.Hora_idHora WHERE Personas.cedula = '$_SESSION[cedula]'";
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
    }
    
    function consultarAsistenciaPanel($cedula, $date){
      global $db, $estNombre, $estCedula, $materia, $curso, $mensaje, $dia;
      $dias = array('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes');
      $days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');
      for($i=0; $i<count($days); $i++){
        if(date("l", strtotime($date)) == $days[$i]){
          $dia = $dias[$i];
        }
      }
      $query = "SELECT * FROM Hora"; 
      $result = $db->query($query);
      if($result->num_rows > 0){
        while(($row = $result->fetch_assoc())){
          if(date("G:i:s", strtotime($date)) > date("G:i:s", strtotime($row['hora_inicio'])) && date("G:i:s", strtotime($date)) < date("G:i:s", strtotime($row['hora_fin']))){
            $hora = date("G:i:s", strtotime($row['hora_inicio']));
          }else {
              if(date("G:i:s", strtotime($date)) < date('7:00:00')){
                $hora = date('07:00:00');
              }
              if(date("G:i:s", strtotime($date)) > date('13:00:00')){
                $hora = date('08:50:00');
                //$mensaje="FUERA DEL HORARIO DE CLASE";
              }
          }
        }
      }
      //if($mensaje == ''){
        $query = "SELECT * FROM Personas INNER JOIN Relacion ON Personas.cedula = Relacion.Personas_cedula INNER JOIN Curso ON Curso.idCurso = Relacion.Curso_idCurso INNER JOIN Materia ON Materia.idMateria = Relacion.Materia_idMateria INNER JOIN Hora ON Hora.idHora = Relacion.Hora_idHora WHERE Personas.cedula = '$cedula' AND Hora.hora_inicio = '07:00:00' AND Hora.dia = 'Lunes'";
        $result = $db->query($query);
        if($result->num_rows > 0){
          while(($row = $result->fetch_assoc())){
            $inicio = date("g:i a",strtotime($row['hora_inicio']));
            $fin = date("g:i a",strtotime($row['hora_fin']));
            $horas = $inicio[$i]." - ".$fin[$i];
            $dia = $row['dia'];
            $materia = $row['nombre'];
            $curso = $row['grado']." ".$row['seccion'];
            $grado = $row['grado'];
            $seccion = $row['seccion'];
          }
          $query2 = "SELECT * FROM Personas INNER JOIN Curso_has_Personas ON Personas.cedula = Curso_has_Personas.Personas_cedula INNER JOIN Curso ON Curso_has_Personas.Curso_idCurso = Curso.idCurso WHERE Curso.grado = '$grado' AND Curso.seccion = '$seccion'";
          $result2 = $db->query($query2);
          if($result2->num_rows > 0){
            $j=0;
            while(($row2 = $result2->fetch_assoc())){
              $estNombre[$j] = $row2['cedula']." - ".$row2['primerNombre']." ".$row2['segundoNombre']." ".$row2['primerApellido']." ".$row2['segundoApellido'];
              $estCedula[$j] = $row2['cedula'];
              $j++;
            }
          } else{
            $estNombre[0] = 'No hay estudiantes registrados';
            $estCedula[0] = '';
          }
          
        } else {
            $mensaje="NO HAY CLASE ASIGNADA";
        }
      //}
      
    }
    
    function consultarUsuarios(){
      global $db, $nombre, $usu_cedula, $nivel;
      $query = "SELECT * FROM Usuario INNER JOIN Personas ON Personas.cedula = Usuario.Personas_cedula"; 
      $result = $db->query($query);
      if($result->num_rows > 0){
        $i=0;
        while(($row = $result->fetch_assoc())){
          $usu_cedula[$i] = $row['Personas_cedula'];
          $nombre[$i] = $row['primerNombre']." ".$row['segundoNombre']." ".$row['primerApellido']." ".$row['segundoApellido'];
          $nivel[$i] = $row['nivel'];
          $i++;
        }
      } else {
          echo "<tr><td>No hay usuarios registrados</td></tr>";
      }
    }
    
    function consultarCedulaUsuario(){
      global $db;
      $query = "SELECT * FROM Usuario WHERE Personas_cedula = '$_POST[usu_cedula]'"; 
      $result = $db->query($query);
      if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
          $pass = $row['clave'];
        }
        $query2 = "SELECT * FROM Personas WHERE cedula = '$_POST[usu_cedula]'"; 
        $result2 = $db->query($query2);
        if($result2->num_rows > 0){
          while($row2 = $result2->fetch_assoc()){
            $nombre = $row2['primerNombre']." ".$row2['segundoNombre']." ".$row2['primerApellido']." ".$row2['segundoApellido'];
            $cargo = $row2['Cargo_idCargo'];
          }
          $query3 = "SELECT * FROM Cargo WHERE idCargo = '$cargo'"; 
          $result3 = $db->query($query3);
          if($result3->num_rows > 0){
            while($row3 = $result3->fetch_assoc()){
              $cargo = $row3['descripcion'];
            }
        ?>
        
          <div class="panel-body">
            <form class="form-horizontal" role="form" id="formCambioClave" method="POST">
              <div class="row">
                <div class="col-sm-12" style="padding-bottom:8px;">
                  <label class="col-sm-5 control-label" style="padding-left:0px;padding-top:0px;">Usuario: </label>
                  <div class="col-sm-7">
                    <?php echo $_POST['usu_cedula']; ?>  
                  </div>
                </div>
                <div class="col-sm-12" style="padding-bottom:8px;">
                  <label class="col-sm-5 control-label" style="padding-left:0px;padding-top:0px;">Nombre completo: </label>
                  <div class="col-sm-7">
                    <?php echo $nombre; ?>  
                  </div>  
                </div>
                <div class="col-sm-12" style="padding-bottom:8px;">
                  <label class="col-sm-5 control-label" style="padding-left:0px;padding-top:0px;">Cargo: </label>
                  <div class="col-sm-7">
                    <?php echo $cargo; ?>  
                  </div>
                  <input type="hidden" value="<?php echo $_POST['usu_cedula']; ?>" name="usu_cedula" />
                  <input type="hidden" value="<?php echo $pass; ?>" name="usu_contrasVieja" id="usu_contrasVieja" />
                </div>
                <div class="col-sm-12" style="padding-bottom:8px;">
                  <label for="Contraseña" class="col-sm-6 control-label" style="padding-left:0px;">Contraseña nueva:</label>
                  <div class="col-sm-6">
                      <input type="password" class="form-control" name="usu_clave" id="usu_clave" placeholder="Contraseña" required>
                  </div>
                </div>
                <div class="col-sm-12" style="padding-bottom:8px;">
                  <label for="RepContraseña" class="col-sm-6 control-label" style="padding-left:0px;">Repetir contraseña:</label>
                  <div class="col-sm-6">
                      <input type="password" class="form-control" name="usu_clave2" id="usu_clave2" placeholder="Repetir contraseña" required>
                  </div>
                </div>
                <div class="col-sm-12" id="div-btn">
                  <center>
                  <button type="submit" class="btn btn-success" name="acepClaveNueva" >Aceptar</button>
                  <a type="reset" class="btn btn-info" name="cancelar" href="clave.php">Cancelar</a>
                  </center>
                </div>
              </div>
            </form>
          </div>
      <?php
          } else{
            echo "No hay cargo asociado al usuario.";
          }
        }else{
          echo "No hay datos para este usuario.";
        }
      } else { ?>
          <br/>No existe el usuario.
          <div class="panel-body">
          <div class="form-group">
            <form class="form" role="form" name="formClave" method="POST">
              <label for="user" class="col-sm-5 control-label" style="padding-left:0px;">Ingresa tu usuario:</label>
              <div class="col-sm-5" style="padding-left:0px;">
                  <input type="text" class="form-control" name="usu_cedula" placeholder="Usuario..." <?php if($error!=""){ echo "value='".$user."'"; }?> autofocus required>
              </div>
              <button type="submit" class="btn btn-default" name="acepCedula" ><i class="glyphicon glyphicon-search"></i></button>
            </form>
          </div>
        </div>
<?php }
    }
?>


      