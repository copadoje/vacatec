<?php 

include "config.php";
include "utils.php";

$data = array();
$corrales = array();

$consulta="SELECT * FROM corrales";
$resultado = mysqli_query($conexion, $consulta);
$filas=mysqli_num_rows($resultado);

if ($filas>0) {
     while ($row = mysqli_fetch_array($resultado)) {
            $corrales[] = array('id' => $row['id'], 'prom_edad' => $row['prom_edad'],'status' => $row['status'], 'fecha_inicio' => $row['fecha_inicio'], 'num_vacas' => $row['num_vacas'], 'num_machos' => $row['num_machos'], 'num_hembras' => $row['num_hembras'], 'fecha_fin' => $row['fecha_fin']);
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