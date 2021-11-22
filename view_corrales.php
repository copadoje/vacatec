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
$corrales = array();

$consulta="SELECT * FROM corrales";
$resultado = mysqli_query($conexion, $consulta);
$filas=mysqli_num_rows($resultado);

if ($filas>0) {
     while ($row = mysqli_fetch_array($resultado)) {
            $corrales[] = array('id' => $row['id'], 'prom_edad' => $row['prom_edad'],'status' => $row['status'], 'fecha_inicio' => $row['fecha_inicio'], 'num_vacas' => $row['num_vacas'], 'num_machos' => $row['num_machos'], 'num_hembras' => $row['num_hembras']);
             }   
        $data['status'] = 'OK';
        $data['result'] = $corrales;
         }
else {
        $data['status'] = 'ERROR';
        $data['vacas'] = 'NO HAY CORRALES';    
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