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
$users = array();

$consulta="SELECT * FROM usuarios";
$resultado = mysqli_query($conexion, $consulta);
$filas=mysqli_num_rows($resultado);

/*while($stmt->fetch()){
    $data[] = array('id' => $row['id'], 'username' => $row['username'], );
}*/



if ($filas>0) {
                 while ($row = mysqli_fetch_array($resultado)) {
                         $users[] = array('id' => $row['id'], 'username' => $row['username'],'nombre' => $row['nombre'], 'apellido' => $row['apellido'], 'correo' => $row['correo'], 'password' => $row['password'], 'nivel' => $row['nivel'] );
                        }   
                $data['status'] = 'OK';
                $data['result'] = $users;
            }
else {
        $data['status'] = 'ERROR';
        $data['result'] = 'NO HAY USUARIOS';    
    }

    // END
            

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