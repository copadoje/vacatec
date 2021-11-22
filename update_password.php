<?php 

include "config.php";
include "utils.php";

$userr = ($_POST['usuario']);
$pssa = ($_POST['passwordact']);
$pssn = ($_POST['passwordnew']);

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

$password = md5($pssa);

$consulta="SELECT * FROM usuarios WHERE username='$userr' and password='$password'";
$resultado = mysqli_query($conexion, $consulta);
$filas=mysqli_num_rows($resultado);
if ($filas>0) {
                $new = md5($pssn);
                $actualizar = "UPDATE usuarios SET password ='$new'WHERE username='$userr'"; 
                $resultado = mysqli_query($conexion,$actualizar);
                $data['status'] = 'OK';
                $data['result'] = 'PASSWORD ACTUALIZADO EXITOSAMENTE';
            }
else {
        $data['status'] = 'ERROR';
        $data['result'] = 'PASSWORD INCORRECTO';    
    }

    //  END

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