<?php 

include "config.php";
include "utils.php";

$data = array();
$formulas = array();

$consulta="SELECT * FROM formulas";
$resultado = mysqli_query($conexion, $consulta);
$filas=mysqli_num_rows($resultado);

if ($filas>0) {
     while ($row = mysqli_fetch_array($resultado)) {
            $formulas[] = array('id' => $row['id'], 'nombre' => $row['nombre'],'maiz' => $row['maiz'], 'soya' => $row['soya'], 'rastrojo' => $row['rastrojo'], 'algodon' => $row['algodon'], 'ddg' => $row['ddg'], 'avena' => $row['avena'], 'melaza' => $row['melaza'], 'costo' => $row['costo'], 'existencia' => $row['existencia'], 'status' => $row['status'] );
             }   
        $data['status'] = 'OK';
        $data['result'] = $formulas;
         }
else {
        $data['status'] = 'ERROR';
        $data['vacas'] = 'NO HAY FORMULAS';    
    }

echo json_encode($data);

?>