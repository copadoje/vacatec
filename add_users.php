<?php 

include "config.php";
include "utils.php";

$userr = ($_POST['usuario']);
$nombre =  ($_POST['nombre']);
$apellido = ($_POST['apellido']);
$correo = ($_POST['correo']);
$pss = ($_POST['password']);
$nivel = ($_POST['nivel']);

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

$password = md5($pss);

//Verificamos si ya existe el usuario//
$consulta="SELECT * FROM usuarios WHERE username='$userr'";
$resultado = mysqli_query($conexion, $consulta);

$filas=mysqli_num_rows($resultado);
if ($filas>0) {
                $data['status'] = 'ERROR';
                $data['result'] = 'EL USUARIO YA EXISTE';
            }
else {
        $insertar = "INSERT INTO usuarios(username, nombre, apellido, correo, password, nivel) VALUES ('$userr','$nombre','$apellido','$correo','$password','$nivel')";
        $resultado = mysqli_query($conexion,$insertar);
        $data['status'] = 'OK';
        $data['result'] = 'USUARIO REGISTRADO EXITOSAMENTE';    
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