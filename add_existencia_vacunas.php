<?php 

include "config.php";
include "utils.php";

/*
1- CLOSTRI-10
2- SINGLE SHOT
3- PROTECTOR-5
4- REVALOR G
5- MAXIBEEF
6- MASTER L5
7- INMUNOIDI DB
*/

$vacuna = ($_POST['vacuna']);
$qty = ($_POST['cantidad']);

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

        //Start
            $data = array();

        $consulta="SELECT * FROM vacunas WHERE id='$vacuna'";
        $resultado = mysqli_query($conexion, $consulta);

        while ($row = mysqli_fetch_array($resultado)) {
                $presentacion = $row['presentacion'];
                $costo = $row['costo'];
                $existencia = $row['existencia'];
                $total = $row['total'];
            }  

        $filas=mysqli_num_rows($resultado);
        if ($filas>0) {
                        $canti = ($qty * $presentacion);
                        $existencia_n =  $canti + $existencia;
                        $total_n = $total + ($costo*$canti);
                        $actualizar = "UPDATE vacunas SET existencia ='$existencia_n', total ='$total_n' WHERE id='$vacuna'"; 
                        $resultado = mysqli_query($conexion,$actualizar);   
                        $data['status'] = 'OK';
                        $data['result'] = 'VACUNA SURTIDA EXITOSAMENTE';  
                    }
        else {
            $data['status'] = 'ERROR';
            $data['result'] = 'LA VACUNA NO EXISTE';
            }
            //END
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