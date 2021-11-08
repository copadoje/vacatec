<?php 

include "config.php";
include "utils.php";

$nombre =  ($_POST['nombre']);
$ingredientes = ($_POST['Ingredientes']);
$costo = ($_POST['costoxkg']);
$existencia = ($_POST['kg']);

$data = array();

$password = md5($pss);

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