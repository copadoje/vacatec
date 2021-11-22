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
$medicamentos = array();

$consulta="SELECT * FROM medicamentos";
$resultado = mysqli_query($conexion, $consulta);
$filas=mysqli_num_rows($resultado);

if ($filas>0) {
     while ($row = mysqli_fetch_array($resultado)) {
            $medicamentos[] = array('id' => $row['id'], 'producto' => $row['producto'],'nombre' => $row['nombre'], 'costo' => $row['costo'], 'cantidad' => $row['cantidad'], 'arete' => $row['arete'], 'corral' => $row['corral'], 'total' => $row['total'], 'fecha' => $row['fecha'] );
             }   
        $data['status'] = 'OK';
        $data['result'] = $medicamentos;
         }
else {
        $data['status'] = 'ERROR';
        $data['vacas'] = 'NO HAY MEDICAMENTOS';    
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