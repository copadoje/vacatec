<?php 

include "config.php";
include "utils.php";

$user = ($_POST['username']);
$key = ($_POST['key']);

$data = array();
    
    $consulta="SELECT * FROM session WHERE username='$user'";
    $resultado = mysqli_query($conexion, $consulta);
    

    $filas=mysqli_num_rows($resultado);
    if ($filas>0) {
        while ($row = mysqli_fetch_array($resultado)) {
            $db_key =  $row['keygen'];
        } 
        if($db_key == $key){

            $delete = "DELETE FROM session WHERE username='$user'";
            $resultado = mysqli_query($conexion,$delete);
            $data['status'] = 'OK';
            $data['result'] = 'USUARIO DESCONECTADO';

        }else{
            $delete = "DELETE FROM session WHERE username='$user'";
            $resultado = mysqli_query($conexion,$delete);
            $data['status'] = 'ERROR';
            $data['result'] = 'EL USUARIO NO EXISTE PERDERAS LA SESION'; 
        }

            }else{
                $data['status'] = 'ERROR';
                $data['result'] = 'USUARIO NO ESTA CONECTADO'; 

            }

echo json_encode($data);

?>