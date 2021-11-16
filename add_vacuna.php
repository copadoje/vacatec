<?php 

include "config.php";
include "utils.php";

$name = ($_POST['nombre']);
$dosis =  ($_POST['dosis']);
$costo =  ($_POST['costo']);

$data = array();

//Verificamos si ya existe el usuario//
$consulta="SELECT * FROM vacunas WHERE vacuna='$name'";
$resultado = mysqli_query($conexion, $consulta);

$filas=mysqli_num_rows($resultado);
if ($filas>0) {
                $data['status'] = 'ERROR';
                $data['result'] = 'EL INSUMO YA EXISTE';
            }
else {
        $insertar = "INSERT INTO vacunas(vacuna, presentacion, costo, existencia, total) VALUES ('$name','$dosis','$costo','0','0')";
        $resultado = mysqli_query($conexion,$insertar);
        $data['status'] = 'OK';
        $data['result'] = 'VACUNA REGISTRADA EXITOSAMENTE';    
    }

echo json_encode($data);

?>