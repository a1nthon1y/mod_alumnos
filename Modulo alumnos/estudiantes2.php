<?php
include ("header.php");
include("valUser.php");
require_once("registro.php");
require_once("consultar.php");
require_once("imagen.php");
require_once("representante.php");
?>

<center>
<!-- Estos dos div Paneles y Container es para que todos los paneles mantengan el mismo ancho a excepcion del de login -->
<div id="Paneles">
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>Listado de Estudiantes</h2>
            </div>
            <div class="panel-body">
                <ul class="nav nav-tabs">
            <?php consultarGrados3();
                for($i=0; $i<$gradosTotal; $i++){
                    if($i==0) $class = 'active';
                    else $class = '';
            ?>
                    <li class="<?php echo $class; ?>"><a data-toggle="tab" href="#<?php echo str_replace(' ', '', $gradoNombre[$i]).str_replace(' ', '', $seccion[$i]); ?>"><?php echo $grado[$i]." ".$seccion[$i]; ?></a></li>
            <?php } ?>
                </ul>
                <div class="tab-content">
            <?php //consultarGrados3();
                for($i=0; $i<$gradosTotal; $i++){ 
                    if($i==0) $class = 'tab-pane fade active in';
                    else $class = 'tab-pane fade';
            ?>
                    <div id="<?php echo str_replace(' ', '', $gradoNombre[$i]).str_replace(' ', '', $seccion[$i]); ?>" class="<?php echo $class; ?>" style="margin-top:10px;">
                        <div class="panel panel-default">
                             <div class="panel-body">
                                 <div class="row">
                					<div class="col-md-12">
                						<div class="table-responsive">
                                            <form class='form-horizontal' role='form'>
                                                <table id="datatables-1-<?php echo $i+1; ?>" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr style="font-size:12px;">
                                                            <th>Cedula</th>
                                                            <th>Nombre completo</th>
                                                            <th>Correo</th>
                                                            <th>Telefono</th>
                                                            <th>Estado</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody style="overflow:none">
                                                        <?php 
                                                            consultarEstudianteGrado($grado[$i], $seccion[$i]);
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </form>
                                        </div>
                					</div>
                				</div>
                             </div>
                         </div>
                    </div>
            <?php } ?>  
                </div>
            </div>
        </div>
    </div>
</div>
</center>
