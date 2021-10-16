<?php 

include "config.php";
include "utils.php";

$user = ($_POST['username']);
$nombre =  ($_POST['nombre']);
$apellido = ($_POST['apellido']);
$correo = ($_POST['correo']);
$pss = ($_POST['password']);
$nivel = ($_POST['nivel']);
$data = array();

$password = md5($pss);

//Verificamos si ya existe el usuario//
$consulta="SELECT * FROM usuarios WHERE username='$user'";
$resultado = mysqli_query($conexion, $consulta);

$filas=mysqli_num_rows($resultado);
if ($filas>0) {
                $data['status'] = 'ERROR';
                $data['result'] = 'EL USUARIO YA EXISTE';
            }
else {
        $insertar = "INSERT INTO usuarios(username, nombre, apellido, correo, password, nivel) VALUES ('$user','$nombre','$apellido','$correo','$password','$nivel')";
        $resultado = mysqli_query($conexion,$insertar);
        $data['status'] = 'OK';
        $data['result'] = 'USUARIO REGISTRADO EXITOSAMENTE';    
    }

echo json_encode($data);

?>