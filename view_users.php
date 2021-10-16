<?php 

include "config.php";
include "utils.php";

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

echo json_encode($data);

?>