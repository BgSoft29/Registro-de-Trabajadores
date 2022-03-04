<?php
    $conexion = mysqli_connect('localhost','root','','dw2021_2');
    if(!$conexion){
        die('Fallo en la conexion'. mysqli_error($conexion));
    }
?>