<?php 

include "config.php";
include "utils.php";

$user = ($_POST['username']);
$pssa = ($_POST['passwordact']);
$pssn = ($_POST['passwordnew']);
$data = array();

$password = md5($pssa);

$consulta="SELECT * FROM usuarios WHERE username='$user' and password='$password'";
$resultado = mysqli_query($conexion, $consulta);
$filas=mysqli_num_rows($resultado);
if ($filas>0) {
                $new = md5($pssn);
                $actualizar = "UPDATE usuarios SET password ='$new'WHERE username='$user'"; 
                $resultado = mysqli_query($conexion,$actualizar);
                $data['status'] = 'OK';
                $data['result'] = 'PASSWORD ACTUALIZADO EXITOSAMENTE';
            }
else {
        $data['status'] = 'ERROR';
        $data['result'] = 'PASSWORD INCORRECTO';    
    }

echo json_encode($data);

?>