<?php 

include "config.php";
include "utils.php";

$user = ($_POST['username']);
$key = ($_POST['key']);

$consulta="SELECT * FROM session WHERE username='$user'";
$resultado = mysqli_query($conexion, $consulta);

$filas=mysqli_num_rows($resultado);
    if ($filas>0) {
        while ($row = mysqli_fetch_array($resultado)) {
            $db_key =  $row['keygen'];
        } 
        if($db_key == $key){

            //AQUI VA EL CODIGO

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

        }else{
            $data['status'] = 'ERROR';
            $data['result'] = 'POR MOTIVOS DE SEGURIDAD PERDERAS LA SESION'; 
        }
    
    } else{
        $data['status'] = 'ERROR';
        $data['result'] = 'USUARIO NO ESTA CONECTADO'; 

    }

echo json_encode($data);

?>