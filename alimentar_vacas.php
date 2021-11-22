<?php 

include "config.php";
include "utils.php";

$corral = ($_POST['corral']);
$kg = ($_POST['cantidad']);
$formula = ($_POST['formula']);

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

//Primero buscamos el corral
$consulta="SELECT * FROM corrales WHERE id='$corral' and status='1'";
$resultado = mysqli_query($conexion, $consulta);

$filas=mysqli_num_rows($resultado);
if ($filas>0) {
                
while ($row = mysqli_fetch_array($resultado)) {
    $corral_vacas = $row['num_vacas'];
}  

//Buscamos la formula
$consulta="SELECT * FROM formulas WHERE id='$formula' and status='1'";
$resultado = mysqli_query($conexion, $consulta);


$filas=mysqli_num_rows($resultado);
if ($filas>0) {
    while ($row = mysqli_fetch_array($resultado)) {
        $nombre_form =  $row['nombre'];
        $costo_form = $row['costo'];
        $existencia_form = $row['existencia'];
    }  

    //Verificamos que hay existencia suficiente
    if($existencia_form>=$kg){

    //Fecha de hoy
    $hoy =strftime( "%Y-%m-%d", time() );

    /*

          Hay existencia

    */
    
    $consulta="SELECT * FROM control_pastura WHERE corral='$corral'";
    $resultado = mysqli_query($conexion, $consulta);
    $filas=mysqli_num_rows($resultado);
    
    //Si ya hay un registro de ese corral
    if ($filas>0) {
        while ($row = mysqli_fetch_array($resultado)) {
            $dias_animale =  $row['dias_animal'];
            $kg_acumuladose = $row['kg_acumulados'];
        }  

        $dias_animal = $dias_animale + $corral_vacas;
        $kg_acumulados = $kg_acumuladose + $kg;

    }else{
        $dias_animal= $corral_vacas;
        $kg_acumulados = $kg;
    }  

    $consumo_animal = $kg/$corral_vacas;
    $consumo_promedio = $kg_acumulados/$dias_animal;
    $costo_total = $kg * $costo_form;
    $costo_vaca = $costo_total / $corral_vacas;

    // Agregamos la aplicacion a la tabla de consumo pastura
    $insertar = "INSERT INTO control_pastura(corral, formula, num_animales, dias_animal, kg_ofrecidos, kg_acumulados, consumo_animal, consumo_promedio, costo_kg, costo_total,fecha) VALUES ('$corral','$formula','$corral_vacas','$dias_animal','$kg','$kg_acumulados','$consumo_animal','$consumo_promedio','$costo_form','$costo_total','$hoy')";
    $resultado = mysqli_query($conexion,$insertar);

    // Actualizamos existencia de formulas
    $existencia_new = ($existencia_form - $kg);
    $actualizar = "UPDATE formulas SET existencia ='$existencia_new' WHERE id='$formula'"; 
    $resultado = mysqli_query($conexion,$actualizar); 
    
    //Agregamos gasto a las vacas del corral
    $consulta="SELECT * FROM vacas WHERE numero_corral='$corral' and status='1'";
    $resultado = mysqli_query($conexion, $consulta);
    $filas=mysqli_num_rows($resultado);
    while ($row = mysqli_fetch_array($resultado)) {
        $vaca_arete =  $row['arete'];
        $gasto_vacaold = $row['gasto'];
        if(is_null($gasto_vacaold)){
            $gasto_new = $costo_vaca;
        }else{
            $gasto_new = ($costo_vaca + $gasto_vacaold);
        }
        $actua = "UPDATE vacas SET gasto ='$gasto_new' WHERE arete='$vaca_arete'"; 
        $resul = mysqli_query($conexion,$actua); 
    }  
                    $data['status'] = 'OK';
                    $data['result'] = 'CORRAL ALIMENTADO EXITOSAMENTE';

    }else{ 
        //No hay existencia suficiente
        $data['status'] = 'ERROR';
        $data['result'] = 'NO HAY EXISTENCIA SUFICIENTE';

    }
        
            }
else {
     //No existe la formula 
    $data['status'] = 'ERROR';
    $data['result'] = 'LA FORMULA NO EXISTE O ESTA INACTIVA';
    }

            }

    //No existe el corral
else {
        $data['status'] = 'ERROR';
        $data['result'] = 'EL CORRAL NO EXISTE EN LA ENGORDA';    
    }

    //END

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