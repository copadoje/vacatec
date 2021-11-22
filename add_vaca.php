<?php 

/* Agregar vacas: 
Status 1 = Activa  2= Enferma  3= Finalizada  4= Muerta
Sexo 1 = Macho 2 = Hembra


*/
include "config.php";
include "utils.php";

$arete = ($_POST['arete']);
$sexo =  ($_POST['sexo']);
$peso_inicial = ($_POST['peso_ini']);
$fecha_compra = ($_POST['fecha_compra']);
$edad = ($_POST['edad']);
$numero_corral = ($_POST['numero_corral']);
$origen = ($_POST['origen']);
$costo = ($_POST['costo']);

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

    // Obtener datos del corral
    
	while ($row = mysqli_fetch_array($resultado)) {
	$promedioedad_corral = $row['prom_edad'];
	$fechaini_corral = $row['fecha_inicio'];
	$numvacas_corral = $row['num_vacas'];
	$machos_corral = $row['num_machos'];
    $hembras_corral = $row['num_hembras'];
    }  
        $hoy =strftime( "%Y-%m-%d", time() );

         // Insertar vaca a tabla vacas
         $insertar = "INSERT INTO vacas(arete, sexo, peso_ini, fecha_compra, edad, numero_corral, status, procedencia, fecha_registro, costo_inicial) VALUES ('$arete','$sexo','$peso_inicial','$fecha_compra','$edad','$numero_corral', '1', '$origen', '$hoy','$costo')";
         $resultado = mysqli_query($conexion,$insertar);

        // Insertar vaca a corral

        //Verificar numero de vacas
        if(is_null($numvacas_corral)){
	        $numvacs_new = '1';
	            }else {
                    $numvacs_new = $numvacas_corral + 1;
                }
        //Verificar promedio de edad
        if(is_null($promedioedad_corral)){
	        $promedio_new = $edad;
	            }else {
                    $edad_new = ($promedioedad_corral * $numvacas_corral) + $edad;
                    $promedio_new = $edad_new / $numvacs_new;
                }
        //Verificar fecha de inicio
        if(is_null($fechaini_corral)){
	        $fechaini_new = $hoy;
	            }else {
                    $fechaini_new = $fechaini_corral;
                }
        
        //Verificar Sexo
        if($sexo==1){
            $hembra_new = $hembras_corral;
            //Macho
            if(is_null($machos_corral)){
                $macho_new = '1';
                    }else {
                        $macho_new = $machos_corral + 1;
                    }
        }else{
            $macho_new = $machos_corral;
            //Macho
            if(is_null($hembras_corral)){
                $hembra_new = '1';
                    }else {
                        $hembra_new = $hembras_corral + 1;
                    }

        }

        $actualizar = "UPDATE corrales SET prom_edad ='$promedio_new', fecha_inicio ='$fechaini_new', num_vacas ='$numvacs_new', num_machos ='$macho_new', num_hembras ='$hembra_new' WHERE id='$numero_corral'"; 
        $resultado = mysqli_query($conexion,$actualizar);

        $data['status'] = 'OK';
        $data['result'] = 'VACA REGISTRADA EXITOSAMENTE';    
    } else{
        $data['status'] = 'ERROR';
        $data['result'] = 'EL NUMERO DE CORRAL NO EXISTE O NO ESTA DISPONIBLE';
    }

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