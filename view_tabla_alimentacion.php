<?php 

include "config.php";
include "utils.php";

$data = array();
$alimenta = array();

$consulta="SELECT * FROM control_pastura";
$resultado = mysqli_query($conexion, $consulta);
$filas=mysqli_num_rows($resultado);

if ($filas>0) {
     while ($row = mysqli_fetch_array($resultado)) {
            $alimenta[] = array('id' => $row['id'], 'corral' => $row['corral'],'formula' => $row['formula'], 'num_animales' => $row['num_animales'], 'dias_animal' => $row['dias_animal'], 'kg_ofrecidos' => $row['kg_ofrecidos'], 'kg_acumulados' => $row['kg_acumulados'], 'consumo_animal' => $row['consumo_animal'], 'consumo_promedio' => $row['consumo_promedio'], 'costo_kg' => $row['costo_kg'], 'costo_total' => $row['costo_total'], 'fecha' => $row['fecha'] );
             }   
        $data['status'] = 'OK';
        $data['result'] = $alimenta;
         }
else {
        $data['status'] = 'ERROR';
        $data['vacas'] = 'NO HAY ALIMNETACION EN EL REGISTRO';    
    }

echo json_encode($data);

?>