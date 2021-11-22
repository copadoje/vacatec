<?php 

include "config.php";
include "utils.php";

/*
1- CLOSTRI-10
2- SINGLE SHOT
3- PROTECTOR-5
4- REVALOR G
5- MAXIBEEF
6- MASTER L5
7- INMUNOIDI DB
*/

$vacuna = ($_POST['vacuna']);
$qty = ($_POST['cantidad']);
$vaca = ($_POST['arete']);

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

//Primero buscamos la vaca
$consulta="SELECT * FROM vacas WHERE arete='$vaca' and status='1'";
$resultado = mysqli_query($conexion, $consulta);

$filas=mysqli_num_rows($resultado);
if ($filas>0) {
                
while ($row = mysqli_fetch_array($resultado)) {
    $corral = $row['numero_corral'];
    $gasto = $row['gasto'];
}  


//Buscamos existencias de vacuna
$consulta="SELECT * FROM vacunas WHERE id='$vacuna'";
$resultado = mysqli_query($conexion, $consulta);

while ($row = mysqli_fetch_array($resultado)) {
        $nombre_vac =  $row['vacuna'];
        $costo = $row['costo'];
        $existencia = $row['existencia'];
        $total = $row['total'];
    }  

$filas=mysqli_num_rows($resultado);
if ($filas>0) {
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
    $data['result'] = 'LA VACUNA NO EXISTE';
    }

    //No existe la vacuna 




            }

    //No existe la vaca
else {
        $data['status'] = 'ERROR';
        $data['result'] = 'EL ARETE NO EXISTE EN LA ENGORDA';    
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