<?php
if(!isset($_SESSION)) 
{ 
    header('Location: index.php');
}else{
    if($_SESSION['nivel_id'] != 2){
        session_destroy();
        header('Location: index.php');
    }
}
?>