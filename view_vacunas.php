<?php 

include "config.php";
include "utils.php";

$data = array();
$vacunas = array();

$consulta="SELECT * FROM vacunas";
$resultado = mysqli_query($conexion, $consulta);
$filas=mysqli_num_rows($resultado);

if ($filas>0) {
     while ($row = mysqli_fetch_array($resultado)) {
            $vacunas[] = array('id' => $row['id'], 'vacuna' => $row['vacuna'],'presentacion' => $row['presentacion'], 'costo' => $row['costo'], 'existencia' => $row['existencia'], 'total' => $row['total'] );
             }   
        $data['status'] = 'OK';
        $data['result'] = $vacunas;
         }
else {
        $data['status'] = 'ERROR';
        $data['vacas'] = 'NO HAY VACUNAS';    
    }

echo json_encode($data);

?>