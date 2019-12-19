<?php
include ("header.php");
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
                <h2>Docentes</h2>
            </div>
            <div class="panel-body">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#docentes">Docentes</a></li>
                </ul>
                <div class="tab-content">
                    <div id="docentes" class="tab-pane fade active in" style="margin-top:10px;">
                        <div class="panel panel-default">
                             <div class="panel-body">
                                 <div class="row">
                					<div class="col-md-12">
                						<div class="table-responsive">
                                            <form class='form-horizontal' role='form'>
                                                <table id="datatables-1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr style="font-size:12px;">
                                                            <th>Dia</th>
                                                            <th>Hora</th>
                                                            <th>Cedula</th>
                                                            <th>Nombre</th>
                                                            <th>Materia</th>
                                                            <th>Grado</th>
                                                        </tr>
                                                    </thead>
                                                     <tfoot>
                                                        <tr style="font-size:12px;">
                                                            <th>Dia</th>
                                                            <th>Hora</th>
                                                            <th>Cedula</th>
                                                            <th>Nombre</th>
                                                            <th>Materia</th>
                                                            <th>Grado</th>
                                                        </tr>
                                                    </tfoot>
                                                    <tbody>
                                                        <?php 
                                                            consultarDocentes2();
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
                </div>
            </div>
        </div>
    </div>
</div>
</center>
