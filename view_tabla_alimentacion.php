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
$alimenta = array();

$consulta="SELECT * FROM control_pastura";
$resultado = mysqli_query($conexion, $consulta);
$filas=mysqli_num_rows($resultado);

if ($filas>0) {
     while ($row = mysqli_fetch_array($resultado)) {
            $alimenta[] = array('id' => $row['id'], 'corral' => $row['corral'],'formula' => $row['formula'], 'num_animales' => $row['num_animales'], 'dias_animal' => $row['dias_animal'], 'kg_ofrecidos' => $row['kg_ofrecidos'], 'kg_acumulados' => $row['kg_acumulados'], 'consumo_animal' => $row['consumo_animal'], 'consumo_promedio' => $row['consumo_promedio'], 'costo_kg' => $row['costo_kg'], 'costo_total' => $row['costo_total'], 'fecha' => $row['fecha'] );
             }   
        $data['status'] = 'OK';
        $data['result'] = $alimenta;
         }
else {
        $data['status'] = 'ERROR';
        $data['vacas'] = 'NO HAY ALIMNETACION EN EL REGISTRO';    
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