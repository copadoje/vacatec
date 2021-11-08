<?php 

include "config.php";
include "utils.php";

$arete = ($_POST['arete']);

$data = array();

$consulta="SELECT * FROM vacas WHERE arete='$arete'";
$resultado = mysqli_query($conexion, $consulta);

$filas=mysqli_num_rows($resultado);
if ($filas>0) {
                $vaca_info = $resultado->fetch_assoc();
                $data['status'] = 'OK';
                $data['result'] = $vaca_info;
            }
else {
        $data['status'] = 'ERROR';
        $data['result'] = 'EL ARETE NO EXISTE EN LA ENGORDA';    
    }

echo json_encode($data);

?>