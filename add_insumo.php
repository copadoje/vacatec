<?php 

include "config.php";
include "utils.php";

$insumo = ($_POST['insumo']);
$precio =  ($_POST['precio']);

$user = ($_POST['username']);
$key = ($_POST['key']);

$consulta="SELECT * FROM session WHERE username='$user'";
$resultado = mysqli_query($conexion, $consulta);

$filas=mysqli_num_rows($resultado);
    if ($filas>0) {
        while ($row = mysqli_fetch_array($resultado)) {
            $db_key =  $row['keygen'];
        } 
        if($db_key == $key){

            //AQUI VA EL CODIGO

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

    // END

        }else{
            $data['status'] = 'ERROR';
            $data['result'] = 'POR MOTIVOS DE SEGURIDAD PERDERAS LA SESION'; 
        }
    
    } else{
        $data['status'] = 'ERROR';
        $data['result'] = 'USUARIO NO ESTA CONECTADO'; 

    }

echo json_encode($data);

?>