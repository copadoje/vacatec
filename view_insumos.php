<?php 

include "config.php";
include "utils.php";

$data = array();
$insumos = array();

$consulta="SELECT * FROM insumos";
$resultado = mysqli_query($conexion, $consulta);
$filas=mysqli_num_rows($resultado);

if ($filas>0) {
     while ($row = mysqli_fetch_array($resultado)) {
            $insumos[] = array('id' => $row['id'], 'insumo' => $row['insumo'],'precio' => $row['precio'], 'existencia' => $row['existencia'], 'total' => $row['total'] );
             }   
        $data['status'] = 'OK';
        $data['result'] = $insumos;
         }
else {
        $data['status'] = 'ERROR';
        $data['vacas'] = 'NO HAY INSUMOS';    
    }

echo json_encode($data);

?>