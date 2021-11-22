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

            $consulta="SELECT * FROM insumos WHERE id='$insumo'";
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
                            $actualizar = "UPDATE insumos SET existencia ='$existencia_n', total ='$total_n' WHERE id='$insumo'"; 
                            $resultado = mysqli_query($conexion,$actualizar);   
                            $data['status'] = 'OK';
                            $data['result'] = 'INSUMO SURTIDO EXITOSAMENTE';  
                        }
            else {
                $data['status'] = 'ERROR';
                $data['result'] = 'EL INSUMO NO EXISTE';
                }
        //End
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