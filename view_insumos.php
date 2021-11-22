<?php 

include "config.php";
include "utils.php";

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
$insumos = array();

$consulta="SELECT * FROM insumos";
$resultado = mysqli_query($conexion, $consulta);
$filas=mysqli_num_rows($resultado);

if ($filas>0) {
     while ($row = mysqli_fetch_array($resultado)) {
            $insumos[] = array('id' => $row['id'], 'insumo' => $row['insumo'],'precio' => $row['precio'], 'existencia' => $row['existencia'], 'total' => $row['total'] );
             }   
        $data['status'] = 'OK';
        $data['result'] = $insumos;
         }
else {
        $data['status'] = 'ERROR';
        $data['vacas'] = 'NO HAY INSUMOS';    
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