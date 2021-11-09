<?php 

include "config.php";
include "utils.php";

/*
1- MAIZ
2- SOYA
3- SILO
4- RASTROJO PICADO
5- SEMILLA DE ALGODON
6- DDG
7- AVENA
8- MELAZA
*/

$insumo = ($_POST['insumo']);
$kg = ($_POST['kg']);

$data = array();

//Verificamos si ya existe el usuario//
$consulta="SELECT * FROM insumos WHERE insumo='$insumo'";
$resultado = mysqli_query($conexion, $consulta);

while ($row = mysqli_fetch_array($resultado)) {
        $precio = $row['precio'];
        $existencia = $row['existencia'];
        $total = $row['total'];
    }  

$filas=mysqli_num_rows($resultado);
if ($filas>0) {
                $existencia_n = $kg + $existencia;
                $price = $kg *$precio;
                $total_n = $total + $price;
                $insertar = "INSERT INTO insumos(insumo, precio, existencia, total) VALUES ('$insumo','$precio','0','0')";
                $resultado = mysqli_query($conexion,$insertar);
                $data['status'] = 'OK';
                $data['result'] = 'INSUMO REGISTRADO EXITOSAMENTE';  
            }
else {
    $data['status'] = 'ERROR';
    $data['result'] = 'LA FORMULA NO EXISTE';
    }

echo json_encode($data);

?>