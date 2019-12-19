<?php 
include ("connection.php");
$conn = new connection();
$db = $conn->connect();
require_once("consultar.php");
?>
<script src="../frameworks/jquery-1.11.1.min.js"></script>
<script src="selectBox.js"></script>
<div class="panel panel-default">
    <div class="panel-body">
        <h3>Datos del representante</h3>
        <h4>Ingrese cedula del representante:</h4>
        <div class="col-md-8 col-md-offset-2">
            <input type="text" class="form-control" id="textbox" name="ren_cedula" min="1" placeholder="Cedula" required/><br/>
            <select class="form-control" size="4" name="ren_cedula" id="select">
                <?php echo consultarCedulaRepresentante(); ?>
            </select>
        </div>
    </div>
</div>