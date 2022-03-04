<?php include "conexion.php"; ?>
<form action="reg_salida.php" method="post">
    <label for="dnii">REGISTRO SALIDA</label>
    <input type="text" name="dnii" placeholder="DNI" class="form-control">
    <input type="submit" name="enviar_salidaa" class="btn btn-warning" style="margin-top: 4px;">
</form>
<?php
    if(isset($_POST['enviar_salidaa'])){
        $dni = $_POST['dnii'];
        $fechaSalida = date('m-d-Y');
        $horaSalida = date('H:i:s');
        $id = "SELECT trabajadores.trabajador_id FROM trabajadores WHERE trabajadores.trabajador_dni = {$dni}";
        $query_id = mysqli_query($conexion,$id);
        $fila = mysqli_fetch_array($query_id);
        $f = $fila['trabajador_id'];
        // echo $f;
        // Para insertar salidas en base de datos
        $query = "INSERT INTO salidas(salidas_trabajador_id,salidas_fecha,salidas_hora) VALUES
        ('{$f}','{$fechaSalida}','{$horaSalida}')";
        $query_resultado = mysqli_query($conexion,$query);

        if(!$query_resultado){
            die("Fallo en la conexión " . mysqli_error($conexion));
        }
?>
        <h1 style="text-align: center;">Registro de Salida al trabajador Completado!!</h1>
<?php       
    }
        
?>