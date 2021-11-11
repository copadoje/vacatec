<?php 

include "config.php";
include "utils.php";

/*
1- MAIZ
2- SOYA
3- SILO
4- RASTROJO PICADO
5- SEMILLA DE ALGODON
6- DDG
7- AVENA
8- MELAZA
*/

$formula = ($_POST['formula']);
$kg = ($_POST['kg']);
$confirma = 0;

$data = array();

$consulta="SELECT * FROM formulas WHERE id='$formula' and status='1'";
$resultado = mysqli_query($conexion, $consulta);

$filas=mysqli_num_rows($resultado);
if ($filas>0) {
    
    //Obtenemos las variables de la Base de datos
    while ($row = mysqli_fetch_array($resultado)) {
        $maiz = $row['maiz'];
        $soya = $row['soya'];
        $silo = $row['silo'];
        $rastrojo = $row['rastrojo'];
        $algodon = $row['algodon'];
        $ddg = $row['ddg'];
        $avena = $row['avena'];
        $melaza = $row['melaza'];
        $costo = $row['costo'];
        $existencia = $row['existencia'];
    }  

    //Actualizamos la existencia
    if(is_null($existencia)){
        $existencia_n = $kg;
    }else{
        $existencia_n = $kg + $existencia;
    }

    //Maiz
    //Si el insumo es requerido
    if($maiz>0){
        $consulta="SELECT * FROM insumos WHERE id='1'";
        $resultado = mysqli_query($conexion, $consulta);

        while ($row = mysqli_fetch_array($resultado)) {
            $precio_maiz = $row['precio'];
            $existencia_maiz = $row['existencia'];
            $total_maiz = $row['total'];
        }  

        $kg_maiz = (($kg*$maiz)/100);
        
        //Si hay existencia
        if($existencia_maiz>=$kg_maiz){
            $nexistencia_maiz=$existencia_maiz-$kg_maiz
            $ntotal_maiz = $nexistencia_maiz*$precio_maiz;
        }else{
            $confirma=1;
        }

    }
    // Fin Maiz


    //Soya
    if($confirma!=1){

        //Si el insumo es requerido
    if($soya>0){
        $consulta="SELECT * FROM insumos WHERE id='2'";
        $resultado = mysqli_query($conexion, $consulta);

        while ($row = mysqli_fetch_array($resultado)) {
            $precio_soya = $row['precio'];
            $existencia_soya = $row['existencia'];
            $total_soya = $row['total'];
        }  

        $kg_soya = (($kg*$soya)/100);
        
        //Si hay existencia
        if($existencia_soya>=$kg_soya){
            $nexistencia_soya=$existencia_soya-$kg_soya;
            $ntotal_soya = $nexistencia_soya*$precio_soya;
        }else{
            $confirma=1;
        }

    }
    }
    // Fin Soya


     //Silo
     if($confirma!=1){

        //Si el insumo es requerido
    if($silo>0){
        $consulta="SELECT * FROM insumos WHERE id='3'";
        $resultado = mysqli_query($conexion, $consulta);

        while ($row = mysqli_fetch_array($resultado)) {
            $precio_silo = $row['precio'];
            $existencia_silo = $row['existencia'];
            $total_silo = $row['total'];
        }  

        $kg_silo = (($kg*$silo)/100);
        
        //Si hay existencia
        if($existencia_silo>=$kg_silo){
            $nexistencia_silo=$existencia_silo-$kg_silo;
            $ntotal_silo = $nexistencia_silo*$precio_silo;
        }else{
            $confirma=1;
        }

    }
    }
    // Fin Silo

     //Rastrojo
     if($confirma!=1){

        //Si el insumo es requerido
    if($rastrojo>0){
        $consulta="SELECT * FROM insumos WHERE id='3'";
        $resultado = mysqli_query($conexion, $consulta);

        while ($row = mysqli_fetch_array($resultado)) {
            $precio_rastrojo = $row['precio'];
            $existencia_rastrojo = $row['existencia'];
            $total_rastrojo = $row['total'];
        }  

        $kg_rastrojo = (($kg*$rastrojo)/100);
        
        //Si hay existencia
        if($existencia_rastrojo>=$kg_rastrojo){
            $nexistencia_rastrojo=$existencia_rastrojo-$kg_rastrojo;
            $ntotal_rastrojo = $nexistencia_rastrojo*$precio_rastrojo;
        }else{
            $confirma=1;
        }

    }
    }
    // Fin Rastrojo

                $existencia_n = $kg + $existencia;
                $price = $kg *$precio;
                $total_n = $total + $price;
                $actualizar = "UPDATE insumos SET existencia ='$existencia_n', total ='$total_n' WHERE id='$insumo'"; 
                $resultado = mysqli_query($conexion,$actualizar);   
                $data['status'] = 'OK';
                $data['result'] = 'INSUMO SURTIDO EXITOSAMENTE';  
            }
else {
    $data['status'] = 'ERROR';
    $data['result'] = 'LA FORMULA NO EXISTE O ES INACTIVA';
    }

echo json_encode($data);

?>