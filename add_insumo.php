<?php 

include "config.php";
include "utils.php";

$insumo = ($_POST['insumo']);
$precio =  ($_POST['precio']);

$data = array();

//Verificamos si ya existe el usuario//
$consulta="SELECT * FROM insumos WHERE insumo='$insumo'";
$resultado = mysqli_query($conexion, $consulta);

$filas=mysqli_num_rows($resultado);
if ($filas>0) {
                $data['status'] = 'ERROR';
                $data['result'] = 'EL INSUMO YA EXISTE';
            }
else {
        $insertar = "INSERT INTO insumos(insumo, precio, existencia, total) VALUES ('$insumo','$precio','0','0')";
        $resultado = mysqli_query($conexion,$insertar);
        $data['status'] = 'OK';
        $data['result'] = 'INSUMO REGISTRADO EXITOSAMENTE';    
    }

echo json_encode($data);

?>