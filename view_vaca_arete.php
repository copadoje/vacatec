<?php 

include "config.php";
include "utils.php";

$arete = ($_POST['arete']);

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

$consulta="SELECT * FROM vacas WHERE arete='$arete'";
$resultado = mysqli_query($conexion, $consulta);

$filas=mysqli_num_rows($resultado);
if ($filas>0) {
                $vaca_info = $resultado->fetch_assoc();
                $data['status'] = 'OK';
                $data['result'] = $vaca_info;
            }
else {
        $data['status'] = 'ERROR';
        $data['result'] = 'EL ARETE NO EXISTE EN LA ENGORDA';    
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