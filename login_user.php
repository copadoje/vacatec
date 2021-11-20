<?php 

include "config.php";
include "utils.php";

$user = ($_POST['username']);
$pss = ($_POST['password']);
$data = array();

$password = md5($pss);

$consulta="SELECT * FROM usuarios WHERE username='$user'and password='$password'";
$res = mysqli_query($conexion, $consulta);



$filas=mysqli_num_rows($res);
if ($filas>0) {
    
    $consulta="SELECT * FROM session WHERE username='$user'";
    $resultado = mysqli_query($conexion, $consulta);

    $filas=mysqli_num_rows($resultado);
    if ($filas<1) {
        $key = bin2hex(openssl_random_pseudo_bytes(64));
        $insertar = "INSERT INTO session(username, keygen) VALUES ('$user','$key')";
        $resultado = mysqli_query($conexion,$insertar);

                $usuario_info = $res->fetch_assoc();
                $data['status'] = 'OK';
                $data['key'] = $key;
                $data['result'] = $usuario_info;
            }else{
                $data['status'] = 'ERROR';
                $data['result'] = 'USUARIO YA CONECTADO'; 

            }
        }
else {
        $data['status'] = 'ERROR';
        $data['result'] = 'USUARIO O PASSWORD INCORRECTO';    
    }

echo json_encode($data);

?>