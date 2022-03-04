<?php include "conexion.php"; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="">
    <title>Tarea MySql PHP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/css/bootstrap.min.css">
</head>
    
<body>
    <div class="container">
        <h1 class="text-centeer text-info">REGISTRO PERSONAL</h1>
        <div class="row">
            <div class="col-md-8
            ">
                <form action="index.php" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" name="trabajador_nombre" id="trabajador_nombre" placeholder="Nombres">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="trabajador_apellido" id="trabajador_apellido" placeholder="Apellidos">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="trabajador_dni" id="trabajador_dni" placeholder="DNI">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" name="registrar" value="Registrar">
                        <input type="submit" class="btn btn-success" style="margin-top: 5px;" name="registrar_ingreso" value="Registrar Ingreso">
                        <input type="submit" class="btn btn-success" style="margin-top: 5px;"name="registrar_salida" value="Registrar Salida">
                        <input type="submit" class="btn btn-success" style="margin-top: 5px; background-color: skyblue;" name="personal" value="Personal">
                    </div>
                </form>
                <?php
                    // Para Registrar
                    if(isset($_POST['registrar'])){
                        $trabajador_nombre = $_POST['trabajador_nombre'];
                        $trabajador_apellido = $_POST['trabajador_apellido'];
                        $trabajador_dni = $_POST['trabajador_dni'];
                        $query = "INSERT INTO trabajadores (trabajador_nombre,trabajador_apellido,trabajador_dni) VALUES 
                            ('{$trabajador_nombre}','{$trabajador_apellido}','{$trabajador_dni}')";
                        $query_resultado = mysqli_query($conexion,$query);

                        if(!$query_resultado){
                            die("Fallo en la conexión ". mysqli_error($conexion));
                        }
                    }

                    // Para ver Información del Personal
                    if(isset($_POST['personal'])){
                ?>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombres</th>
                                    <th>Apellido</th>
                                    <th>DNI</th>
                                </tr>
                            </thead>
                            <tbody>
                <?php
                            $query = "SELECT * FROM trabajadores";
                            $query_resultado = mysqli_query($conexion,$query);
                            if(!$query_resultado){
                                die("Fallo en la conexión " . mysqli_error($conexion));
                            }
                            // para imprimir en html
                            while($fila = mysqli_fetch_array($query_resultado)){
                ?>
                                <tr>
                                    <td><?php echo $fila['trabajador_id']?></td>
                                    <td><?php echo $fila['trabajador_nombre']?></td>
                                    <td><?php echo $fila['trabajador_apellido']?></td>
                                    <td><?php echo $fila['trabajador_dni']?></td>
                                    <td><a href="index.php?ingresos=<?php echo $fila['trabajador_id'] ?>" class="btn btn-success btn-sm">Ingresos</a></td>
                                    <td><a href="index.php?salidas=<?php echo $fila['trabajador_id'] ?>" class="btn btn-danger btn-sm">Salidas</a></td>
                                </tr>  
                <?php                                              
                            }              
                    }
                ?>
                            </tbody>
                        </table>
                
            </div>
            <!-- Para registrar Ingresos de personal -->
            <div class="col-md-8">
                <?php
                    if(isset($_POST['registrar_ingreso'])){
                        include "reg_ingreso.php";
                    }      
                ?>
            </div>
            <!-- Para registrar Salidas de personal -->
            <div class="col-md-8">
                <?php
                    if(isset($_POST['registrar_salida'])){
                        include "reg_salida.php";
                    }      
                ?>
            </div>
            <!-- Para mostrar record de ingresos -->
            <div class="col-md-5">
                <?php
                    if(isset($_GET['ingresos'])){
                ?>
                        <h3 style="text-align: center;">INGRESOS DE PERSONAL</h3>
                <?php
                        $ide = $_GET['ingresos'];
                        $nomb = "SELECT trabajadores.trabajador_nombre, trabajadores.trabajador_apellido, trabajadores.trabajador_dni FROM trabajadores WHERE trabajadores.trabajador_id = {$ide}";
                        $query_nomb = mysqli_query($conexion,$nomb);
                        $titulo = mysqli_fetch_array($query_nomb);
                        echo $titulo['trabajador_nombre'].' '.$titulo['trabajador_apellido'].'  -  '.$titulo['trabajador_dni'];
                ?>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Fecha Ingreso</th>
                                    <th>Hora Ingreso</th>
                                </tr>
                            </thead>
                            <tbody>
                <?php
                        $idin = $_GET['ingresos'];
                        $record_ingresos = "SELECT ingresos.ingresos_trabajador_id, ingresos.ingresos_fecha, ingresos.ingresos_fecha, ingresos.ingresos_hora FROM ingresos WHERE ingresos.ingresos_trabajador_id = {$idin}";
                        $query_idin = mysqli_query($conexion,$record_ingresos);
                        while($fila_in = mysqli_fetch_array($query_idin)){
                ?>
                                <tr>
                                    <td><?php echo $fila_in['ingresos_trabajador_id']?></td>
                                    <td><?php echo $fila_in['ingresos_fecha']?></td>
                                    <td><?php echo $fila_in['ingresos_hora']?></td>
                                </tr>
                <?php
                        }
                    }
                ?>
                            </tbody>
                        </table>
            </div>
            <!-- Para mostrar record de salidas -->
            <div class="col-md-5">
                <?php
                    if(isset($_GET['salidas'])){
                ?>
                        <h3 style="text-align: center;">SALIDAS DE PERSONAL</h3>
                <?php
                        $ide = $_GET['salidas'];
                        $nomb = "SELECT trabajadores.trabajador_nombre, trabajadores.trabajador_apellido, trabajadores.trabajador_dni FROM trabajadores WHERE trabajadores.trabajador_id = {$ide}";
                        $query_nomb = mysqli_query($conexion,$nomb);
                        $titulo = mysqli_fetch_array($query_nomb);
                        echo $titulo['trabajador_nombre'].' '.$titulo['trabajador_apellido'].'  -  '.$titulo['trabajador_dni'];
                ?>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Fecha Salida</th>
                                    <th>Hora Salida</th>
                                </tr>
                            </thead>
                            <tbody>
                <?php
                        $idin = $_GET['salidas'];
                        $record_salidas = "SELECT salidas.salidas_trabajador_id, salidas.salidas_fecha, salidas.salidas_fecha, salidas.salidas_hora FROM salidas WHERE salidas.salidas_trabajador_id = {$idin}";
                        $query_idin = mysqli_query($conexion,$record_salidas);
                        while($fila_in = mysqli_fetch_array($query_idin)){
                ?>
                                <tr>
                                    <td><?php echo $fila_in['salidas_trabajador_id']?></td>
                                    <td><?php echo $fila_in['salidas_fecha']?></td>
                                    <td><?php echo $fila_in['salidas_hora']?></td>
                                </tr>
                <?php
                        }
                    }
                ?>
                            </tbody>
                        </table>
            </div>
        </div>





    </div>
</body>
</html>