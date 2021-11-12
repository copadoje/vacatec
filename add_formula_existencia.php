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

$maiz_c=0;
$soya_c=0;
$silo_c=0;
$rastrojo_c=0;
$algodon_c=0;
$ddg_c=0;
$avena_c=0;
$melaza_c=0;

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

    //1- Maiz
    //Si el insumo es requerido
    if($maiz>0){
        $maiz_c=1;
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
            $nexistencia_maiz=$existencia_maiz-$kg_maiz;
            $ntotal_maiz = $nexistencia_maiz*$precio_maiz;
        }else{
            $confirma=1;
        }

    }
    // Fin Maiz


    //2- Soya
    if($confirma!=1){

        //Si el insumo es requerido
    if($soya>0){
        $soya_c=1;
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


     //3- Silo
     if($confirma!=1){

        //Si el insumo es requerido
    if($silo>0){
        $silo_c=1;
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

      //4- Rastrojo
      if($confirma!=1){

        //Si el insumo es requerido
    if($rastrojo>0){
        $rastrojo_c=1;
        $consulta="SELECT * FROM insumos WHERE id='4'";
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


       //5- Algodon
       if($confirma!=1){

        //Si el insumo es requerido
    if($algodon>0){
        $algodon_c=1;
        $consulta="SELECT * FROM insumos WHERE id='5'";
        $resultado = mysqli_query($conexion, $consulta);

        while ($row = mysqli_fetch_array($resultado)) {
            $precio_algodon = $row['precio'];
            $existencia_algodon = $row['existencia'];
            $total_algodon = $row['total'];
        }  

        $kg_algodon = (($kg*$algodon)/100);
        
        //Si hay existencia
        if($existencia_algodon>=$kg_algodon){
            $nexistencia_algodon=$existencia_algodon-$kg_algodon;
            $ntotal_algodon = $nexistencia_algodon*$precio_algodon;
        }else{
            $confirma=1;
        }

    }
    }
    // Fin Algodon


        //6- DDG
        if($confirma!=1){

            //Si el insumo es requerido
        if($ddg>0){
            $ddg_c=1;
            $consulta="SELECT * FROM insumos WHERE id='6'";
            $resultado = mysqli_query($conexion, $consulta);
    
            while ($row = mysqli_fetch_array($resultado)) {
                $precio_ddg = $row['precio'];
                $existencia_ddg = $row['existencia'];
                $total_ddg = $row['total'];
            }  
    
            $kg_ddg = (($kg*$ddg)/100);
            
            //Si hay existencia
            if($existencia_ddg>=$kg_ddg){
                $nexistencia_ddg=$existencia_ddg-$kg_ddg;
                $ntotal_ddg = $nexistencia_ddg*$precio_ddg;
            }else{
                $confirma=1;
            }
    
        }
        }
        // Fin DDG


        //7- Avena
        if($confirma!=1){

            //Si el insumo es requerido
        if($avena>0){
            $avena_c=1;
            $consulta="SELECT * FROM insumos WHERE id='7'";
            $resultado = mysqli_query($conexion, $consulta);
    
            while ($row = mysqli_fetch_array($resultado)) {
                $precio_avena = $row['precio'];
                $existencia_avena = $row['existencia'];
                $total_avena = $row['total'];
            }  
    
            $kg_avena = (($kg*$avena)/100);
            
            //Si hay existencia
            if($existencia_avena>=$kg_avena){
                $nexistencia_avena=$existencia_avena-$kg_avena;
                $ntotal_avena = $nexistencia_avena*$precio_avena;
            }else{
                $confirma=1;
            }
    
        }
        }
        // Fin Avena
        

        //8- Melaza
        if($confirma!=1){

            //Si el insumo es requerido
        if($melaza>0){
            $melaza_c=1;
            $consulta="SELECT * FROM insumos WHERE id='8'";
            $resultado = mysqli_query($conexion, $consulta);
    
            while ($row = mysqli_fetch_array($resultado)) {
                $precio_melaza = $row['precio'];
                $existencia_melaza = $row['existencia'];
                $total_melaza = $row['total'];
            }  
    
            $kg_melaza = (($kg*$melaza)/100);
            
            //Si hay existencia
            if($existencia_melaza>=$kg_melaza){
                $nexistencia_melaza=$existencia_melaza-$kg_melaza;
                $ntotal_melaza = $nexistencia_melaza*$precio_melaza;
            }else{
                $confirma=1;
            }
    
        }
        }
        // Fin Melaza


        //Condicion por si no hay algun insumo

        if($confirma==1){
            //Hicieron falta insumos
            $data['status'] = 'ERROR';
            $data['result'] = 'NO HAY LA CANTIDAD SUFICIENTE DE INSUMO';
        }else{
            //Hay insumos suficientes
            //Maiz
            if($maiz_c==1){
                $actualizar = "UPDATE insumos SET existencia ='$nexistencia_maiz', total ='$ntotal_maiz' WHERE id='1'"; 
                $resultado = mysqli_query($conexion,$actualizar); 
            }
            //Soya
            if($soya_c==1){
                $actualizar = "UPDATE insumos SET existencia ='$nexistencia_soya', total ='$ntotal_soya' WHERE id='2'"; 
                $resultado = mysqli_query($conexion,$actualizar); 
            }
            //Silo
            if($silo_c==1){
                $actualizar = "UPDATE insumos SET existencia ='$nexistencia_silo', total ='$ntotal_silo' WHERE id='3'"; 
                $resultado = mysqli_query($conexion,$actualizar); 
            }
            //Rastrojo
            if($rastrojo_c==1){
                $actualizar = "UPDATE insumos SET existencia ='$nexistencia_rastrojo', total ='$ntotal_rastrojo' WHERE id='4'"; 
                $resultado = mysqli_query($conexion,$actualizar); 
            }
            //Algodon
            if($algodon_c==1){
                $actualizar = "UPDATE insumos SET existencia ='$nexistencia_algodon', total ='$ntotal_algodon' WHERE id='5'"; 
                $resultado = mysqli_query($conexion,$actualizar); 
            }
            //DDG
            if($ddg_c==1){
                $actualizar = "UPDATE insumos SET existencia ='$nexistencia_ddg', total ='$ntotal_ddg' WHERE id='6'"; 
                $resultado = mysqli_query($conexion,$actualizar); 
            }
            //Avena
            if($avena_c==1){
                $actualizar = "UPDATE insumos SET existencia ='$nexistencia_avena', total ='$ntotal_avena' WHERE id='7'"; 
                $resultado = mysqli_query($conexion,$actualizar); 
            }
            //Melaza
            if($melaza_c==1){
                $actualizar = "UPDATE insumos SET existencia ='$nexistencia_melaza', total ='$ntotal_melaza' WHERE id='8'"; 
                $resultado = mysqli_query($conexion,$actualizar); 
            }

            
            $actualizar = "UPDATE formulas SET existencia ='$existencia_n' WHERE id='$formula'"; 
            $resultado = mysqli_query($conexion,$actualizar);   
                $data['status'] = 'OK';
                $data['result'] = 'FORMULA SURTIDA EXITOSAMENTE'; 
        

        }

            } //Fin If
else {
    $data['status'] = 'ERROR';
    $data['result'] = 'LA FORMULA NO EXISTE O ES INACTIVA';
    }

echo json_encode($data);

?>