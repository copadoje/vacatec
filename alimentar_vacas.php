<?php 

include "config.php";
include "utils.php";

$corral = ($_POST['corral']);
$kg = ($_POST['cantidad']);
$formula = ($_POST['formula']);

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

    if($existencia_form)
    //Fecha de hoy
    $hoy =strftime( "%Y-%m-%d", time() );
    
                //Si hay existencia
                $total_new = ($qty * $costo);
                if($existencia>=$qty){
                    // Agregamos la aplicacion a la tabla de medicamentos
                    $insertar = "INSERT INTO medicamentos(producto, nombre, costo, cantidad, arete, corral, total, fecha) VALUES ('$vacuna','$nombre_vac','$costo','$qty','$vaca','$corral','$total_new','$hoy')";
                    $resultado = mysqli_query($conexion,$insertar);
                    // Actualizamos existencia de vacunas
                    $existencia_new = ($existencia - $qty);
                    $total_stock = ($existencia_new * $costo);
                    $actualizar = "UPDATE vacunas SET existencia ='$existencia_new', total ='$total_stock' WHERE id='$vacuna'"; 
                    $resultado = mysqli_query($conexion,$actualizar); 
                    //Agregar gasto a vaca
                    if(is_null($gasto)){
                        $gasto_vaca = $total_new;
                    }else{
                        $gasto_vaca = $gasto + $total_new;
                    }
                    
                    $actualizar = "UPDATE vacas SET gasto ='$gasto_vaca' WHERE arete='$vaca'"; 
                    $resultado = mysqli_query($conexion,$actualizar); 

                    $data['status'] = 'OK';
                    $data['result'] = 'VACUNA APLICADA SATISFACTORIAMENTE';


                }else{
                    $data['status'] = 'ERROR';
                    $data['result'] = 'NO HAY EXISTENCIA SUFICIENTE';
                }
               //No hay existencia
            }
else {
    $data['status'] = 'ERROR';
    $data['result'] = 'LA FORMULA NO EXISTE O ESTA INACTIVA';
    }

    //No existe la formula 




            }

    //No existe el corral
else {
        $data['status'] = 'ERROR';
        $data['result'] = 'EL CORRAL NO EXISTE EN LA ENGORDA';    
    }


echo json_encode($data);

?>