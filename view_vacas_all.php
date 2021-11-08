<?php 

include "config.php";
include "utils.php";

$data = array();
$vacas = array();

$consulta="SELECT * FROM vacas";
$resultado = mysqli_query($conexion, $consulta);
$filas=mysqli_num_rows($resultado);

if ($filas>0) {
     while ($row = mysqli_fetch_array($resultado)) {
            $vacas[] = array('id' => $row['id'], 'arete' => $row['arete'],'sexo' => $row['sexo'], 'peso_ini' => $row['peso_ini'], 'fecha_compra' => $row['fecha_compra'], 'edad' => $row['edad'], 'numero_corral' => $row['numero_corral'], 'gasto' => $row['gasto'], 'status' => $row['status'], 'procedencia' => $row['procedencia'], 'fecha_registro' => $row['fecha_registro'], 'fecha_finalizacion' => $row['fecha_finalizacion'] );
             }   
        $data['status'] = 'OK';
        $data['result'] = $vacas;
         }
else {
        $data['status'] = 'ERROR';
        $data['vacas'] = 'NO HAY USUARIOS';    
    }

echo json_encode($data);

?>