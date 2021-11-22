<?php 

include "config.php";
include "utils.php";

/*  STATUS CORRALES:
   1- DISPONIBLE
   2- NO DISPONIBLE
   3- DESHABILITADO */

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

            $query = mysqli_query($conexion, "SELECT * from corrales_exis"); 
                while ($row = mysqli_fetch_array($query)) {
                $cantidad = $row['cantidad'];
            }  

            $consulta="SELECT * FROM corrales";
            $resultado = mysqli_query($conexion, $consulta);
            $filas=mysqli_num_rows($resultado);
            if ($filas>$cantidad-1) {
                            $data['status'] = 'ERROR';
                            $data['result'] = 'LLEGASTE AL LIMITE DE CORRALES';
                        }
                else{
                    $insertar = "INSERT INTO corrales(status) VALUES ('1')";
                    $resultado = mysqli_query($conexion,$insertar);
                    $data['status'] = 'OK';
                    $data['result'] = 'CORRAL CREADO EXITOSAMENTE';  
                        }

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