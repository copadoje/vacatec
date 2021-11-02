<?php 

include "config.php";
include "utils.php";

$arete = ($_POST['arete']);
$sexo =  ($_POST['sexo']);
$peso_inicial = ($_POST['peso_ini']);
$fecha_compra = ($_POST['fecha_compra']);
$edad = ($_POST['edad']);
$numero_corral = ($_POST['numero_corral']);
$origen = ($_POST['origen']);

$data = array();

$consulta="SELECT * FROM vacas WHERE arete='$arete' and status='1'";
$resultado = mysqli_query($conexion, $consulta);

$filas=mysqli_num_rows($resultado);
if ($filas>0) {
                $data['status'] = 'ERROR';
                $data['result'] = 'EL NUMERO DE ARETE YA EXISTE';
            }
else {

    $statuscorral=1;
    $consulta="SELECT * FROM corrales WHERE id='$numero_corral' and status='$statuscorral'";
    $resultado = mysqli_query($conexion, $consulta);
    if ($filas<1) {

        $hoy =strftime( "%Y-%m-%d", time() );

        $insertar = "INSERT INTO vacas(arete, sexo, peso_ini, fecha_compra, edad, numero_corral, status, procedencia, fecha_registro) VALUES ('$arete','$sexo','$peso_inicial','$fecha_compra','$edad','$numero_corral', '1', '$origen', '$hoy')";
        $resultado = mysqli_query($conexion,$insertar);

        $data['status'] = 'OK';
        $data['result'] = 'VACA REGISTRADA EXITOSAMENTE';    
    } else{
        $data['status'] = 'ERROR';
        $data['result'] = 'EL NUMERO DE CORRAL NO EXISTE O NO ESTA DISPONIBLE';
    }

    }

echo json_encode($data);

?>