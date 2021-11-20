<?php 

include "config.php";
include "utils.php";

$data = array();
$corrales = array();

$consulta="SELECT * FROM corrales_exis";
$resultado = mysqli_query($conexion, $consulta);
$filas=mysqli_num_rows($resultado);

if ($filas>0) {
     while ($row = mysqli_fetch_array($resultado)) {
            $corrales[] = array('id' => $row['id'], 'cantidad' => $row['cantidad']);
             }   
        $data['status'] = 'OK';
        $data['result'] = $corrales;
         }
else {
        $data['status'] = 'ERROR';
        $data['vacas'] = 'NO HAY CORRALES';    
    }

echo json_encode($data);

?>