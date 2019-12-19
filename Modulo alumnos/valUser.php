<?php 
if(!isset($_SESSION)) 
{ 
    header('Location: index.php');
}else{
    if(!(isset($_SESSION['user']))){
        session_destroy();
        header('Location: index.php');
    }
}
?>