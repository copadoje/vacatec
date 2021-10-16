<?php 

include "config.php";
include "utils.php";

$user = ($_POST['username']);
$pss = ($_POST['password']);
$data = array();

$password = md5($pss);

$consulta="SELECT * FROM usuarios WHERE username='$user'and password='$password'";
$resultado = mysqli_query($conexion, $consulta);

$filas=mysqli_num_rows($resultado);
if ($filas>0) {
                $usuario_info = $resultado->fetch_assoc();
                $data['status'] = 'OK';
                $data['result'] = $usuario_info;
            }
else {
        $data['status'] = 'ERROR';
        $data['result'] = 'USUARIO O PASSWORD INCORRECTO';    
    }

echo json_encode($data);

?>