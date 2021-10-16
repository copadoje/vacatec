<?php 

include "config.php";
include "utils.php";

$user = ($_POST['username']);

$data = array();

$consulta="SELECT * FROM usuarios WHERE username='$user'";
$resultado = mysqli_query($conexion, $consulta);

$filas=mysqli_num_rows($resultado);
if ($filas>0) {
                $usuario_info = $resultado->fetch_assoc();
                $data['status'] = 'OK';
                $data['result'] = $usuario_info;
            }
else {
        $data['status'] = 'ERROR';
        $data['result'] = 'EL USUARIO NO EXISTE';    
    }

echo json_encode($data);

?>