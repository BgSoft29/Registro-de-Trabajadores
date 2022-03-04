<?php include "conexion.php"; ?>
<form action="reg_ingreso.php" method="post">
    <label for="dnii">REGISTRO INGRESO</label>
    <input type="text" name="dnii" placeholder="DNI" class="form-control">
    <input type="submit" name="enviar_ingresoo" class="btn btn-warning" style="margin-top: 4px;">
</form>
<?php
    if(isset($_POST['enviar_ingresoo'])){
        $dni = $_POST['dnii'];
        $fechaIngreso = date('m-d-Y');
        $horaIngreso = date('H:i:s');
        $id = "SELECT trabajadores.trabajador_id FROM trabajadores WHERE trabajadores.trabajador_dni = {$dni}";
        $query_id = mysqli_query($conexion,$id);
        $fila = mysqli_fetch_array($query_id);
        $f = $fila['trabajador_id'];
        // echo $f;
        // Para insertar registros en base de datos
        $query = "INSERT INTO ingresos(ingresos_trabajador_id,ingresos_fecha,ingresos_hora) VALUES
        ('{$f}','{$fechaIngreso}','{$horaIngreso}')";
        $query_resultado = mysqli_query($conexion,$query);

        if(!$query_resultado){
            die("Fallo en la conexión " . mysqli_error($conexion));
        }
?>
        <h1 style="text-align: center;">Registro de Ingreso al trabajador Completado!!</h1>
<?php       
    }
        
?>