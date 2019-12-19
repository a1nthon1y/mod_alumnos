<?php
include ("header.php");
include("valUser.php");
require_once("registro.php");
require_once("consultar.php");
require_once("imagen.php");

?>

<center>
<!-- Estos dos div Paneles y Container es para que todos los paneles mantengan el mismo ancho a excepcion del de login -->
<div id="Paneles">
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>Listado de Personal</h2>
            </div>
            <div class="panel-body">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#docentes">Docentes</a></li>
                    <li class=""><a data-toggle="tab" href="#personal">Personal</a></li>
                </ul>
                <div class="tab-content">
                    <div id="docentes" class="tab-pane fade active in" style="margin-top:10px;">
                        <div class="panel panel-default">
                             <div class="panel-body">
                                 <div class="row">
                					<div class="col-md-12">
                						<div class="table-responsive">
                                            <form class='form-horizontal' role='form'>
                                                <table id="datatables-1-1" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
                                                        <?php consultarPersonal3(2); ?>
                                                    </tbody>
                                                </table>
                                            </form>
                                        </div>
                					</div>
                				</div>
                             </div>
                         </div>
                    </div>
                    <div id="personal" class="tab-pane fade" style="margin-top:10px;">
                        <div class="panel panel-default">
                             <div class="panel-body">
                                 <div class="row">
                					<div class="col-md-12">
                						<div class="table-responsive">
                                            <form class='form-horizontal' role='form'>
                                                <table id="datatables-1-2" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
                                                        <?php consultarPersonal3(3); ?>
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
