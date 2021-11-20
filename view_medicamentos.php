<?php 

include "config.php";
include "utils.php";

$data = array();
$medicamentos = array();

$consulta="SELECT * FROM medicamentos";
$resultado = mysqli_query($conexion, $consulta);
$filas=mysqli_num_rows($resultado);

if ($filas>0) {
     while ($row = mysqli_fetch_array($resultado)) {
            $medicamentos[] = array('id' => $row['id'], 'producto' => $row['producto'],'nombre' => $row['nombre'], 'costo' => $row['costo'], 'cantidad' => $row['cantidad'], 'arete' => $row['arete'], 'corral' => $row['corral'], 'total' => $row['total'], 'fecha' => $row['fecha'] );
             }   
        $data['status'] = 'OK';
        $data['result'] = $medicamentos;
         }
else {
        $data['status'] = 'ERROR';
        $data['vacas'] = 'NO HAY MEDICAMENTOS';    
    }

echo json_encode($data);

?>