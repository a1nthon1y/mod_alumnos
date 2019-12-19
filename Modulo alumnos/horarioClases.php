<?php

include ("header.php");
include("valAdmin.php");
require_once("registro.php");
require_once("consultar.php");
//$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if($error == ''){ ?>	    		
		<div class="alert alert-success">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		  	<strong>Horario de clases ingresado con Exito!</strong>
		</div>									
<?php  
    } else if($error=='Ya esta cargado'){ ?>	    		
		<div class="alert alert-danger">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		  	<strong>Los datos ya estan cargados</strong>
		</div>									
<?php   	} else{ ?>	    		
		<div class="alert alert-danger">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		  	<strong>Hubo un error: los datos no fueron cargados correctamente.</strong>
		</div>									
<?php   	}
}
?>

<center>
<!-- Estos dos div Paneles y Container es para que todos los paneles mantengan el mismo ancho a excepcion del de login -->
<div id="Paneles">
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>Módulo de Horas de Clases</h2>
            </div>
            <div class="panel-body">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#registro">Registro</a></li>
                    <li><a data-toggle="tab" href="#editar">Editar</a></li>
                </ul>
                <div class="tab-content">
            <!-- REGISTRO -->
                    <div id="registro" class="tab-pane fade in active" style="margin-top:10px;">
                        <div class="panel panel-default">
                          <div class="panel-body">
                              <form method="POST" >
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group" style="height:auto">
                                            <div class="table-responsive" id="divTabla"> 
                                              <table class="table" id="tablaHora">
                                                <thead class="thead">
                                                  <tr>
                                                    <th>Dia</th>
                                                    <th>Hora Inicial</th>
                                                    <th>Hora Final</th>
                                                    <th>Descripción</th>
                                                    <th>Duración</th>
                                                  </tr>
                                                </thead>
                                                <tbody class="tbody">
                                          <?php $hora[0] = date('g:i a', strtotime('07:00:00'));
                                                for($i=0; $i<10; $i++){ 
                                                  echo '<tr>
                                                          <td>Lunes a Viernes</td>';
                                                  if($i==2){
                                                    $hora[$i+1] = date('g:i a', strtotime('+30 minutes', strtotime($hora[$i])));
                                                    echo '<td>'.$hora[$i].'</td>
                                                          <td>'.$hora[$i+1].'</td>
                                                          <td>Receso</td>
                                                          <td>30 min</td>';
                                                  } else if($i==7){
                                                    $hora[$i+1] = date('g:i a', strtotime('+10 minutes', strtotime($hora[$i])));
                                                    echo '<td>'.$hora[$i].'</td>
                                                          <td>'.$hora[$i+1].'</td>
                                                          <td>Receso</td>
                                                          <td>10 min</td>';
                                                  } else{
                                                    $hora[$i+1] = date('g:i a', strtotime('+40 minutes', strtotime($hora[$i])));
                                                    echo '<td>'.$hora[$i].'</td>
                                                          <td>'.$hora[$i+1].'</td>
                                                          <td>Clases</td>
                                                          <td>40 min</td>';
                                                  }
                                          ?>
                                                  </tr>
                                          <?php } ?>
                                                </tbody>
                                              </table>
                                             </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <center>
                                    <button type="submit" class="btn btn-success" name="acepHorasC">Cargar horas</button>
                                    </center>
                                </div>
                              </form>
                          </div>  
                        </div>
                    </div>
            
            <!-- EDITAR -->
                    <div id="editar" class="tab-pane fade" style="margin-top:10px;">
                        <div class="panel panel-default">
                          <div class="panel-heading">EN CONSTRUCCION</div>
                          <div class="panel-body">
                              <form method="POST" >
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group" style="height:auto">
                                            <div class="table-responsive" id="divTabla"> 
                                              <table class="table" id="tablaHora">
                                                <thead class="thead">
                                                  <tr>
                                                    <th>Dia</th>
                                                    <th>Hora Inicial</th>
                                                    <th>Hora Final</th>
                                                    <th>Descripción</th>
                                                    <th>Duración</th>
                                                  </tr>
                                                </thead>
                                                <tbody class="tbody" style="scrollover:auto">
                                          <?php $hora[0] = date('g:i a', strtotime('07:00:00'));
                                                for($i=0; $i<10; $i++){ 
                                                  echo '<tr>
                                                          <td>Lunes a Viernes</td>';
                                                  if($i==2){
                                                    $hora[$i+1] = date('g:i a', strtotime('+30 minutes', strtotime($hora[$i])));
                                                    echo '<td><input class="form-control" type="text" value="'.$hora[$i].'" required /></td>
                                                          <td><input class="form-control" type="text" value="'.$hora[$i+1].'" required /></td>
                                                          <td><input class="form-control" type="text" value="Receso" required/></td>
                                                          <td><input class="form-control" type="number" value="30" required /></td>';
                                                  } else if($i==7){
                                                    $hora[$i+1] = date('g:i a', strtotime('+10 minutes', strtotime($hora[$i])));
                                                    echo '<td><input class="form-control" type="text" value="'.$hora[$i].'" required /></td>
                                                          <td><input class="form-control" type="text" value="'.$hora[$i+1].'" required /></td>
                                                          <td><input class="form-control" type="text" value="Receso" required/></td>
                                                          <td><input class="form-control" type="number" value="10" required /></td>';
                                                  } else{
                                                    $hora[$i+1] = date('g:i a', strtotime('+40 minutes', strtotime($hora[$i])));
                                                    echo '<td><input class="form-control" type="text" value="'.$hora[$i].'" required /></td>
                                                          <td><input class="form-control" type="text" value="'.$hora[$i+1].'" required /></td>
                                                          <td><input class="form-control" type="text" value="Clases" required/></td>
                                                          <td><input class="form-control" type="number" value="40" required /></td>';
                                                  }
                                          ?>
                                                  </tr>
                                          <?php } ?>
                                                </tbody>
                                              </table>
                                             </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <center>
                                    <button type="submit" class="btn btn-success" name="#" disabled>Actualizar</button>
                                    <button type="reset" class="btn btn-danger">Cancelar</button>
                                    </center>
                                </div>
                              </form>
                          </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        
    </div>
</div>
</center>
