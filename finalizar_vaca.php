<?php 

/* Agregar vacas: 
Status 1 = Activa  2= Enferma  3= Finalizada  4= Muerta
Sexo 1 = Macho 2 = Hembra
*/
include "config.php";
include "utils.php";

$arete = ($_POST['arete']);
$peso = ($_POST['peso_fin']);

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

    $hoy =strftime( "%Y-%m-%d", time() );

    while ($row = mysqli_fetch_array($resultado)) {
        $corral = $row['numero_corral'];
        }  

        $actualizar = "UPDATE vacas SET status ='3', fecha_finalizacion ='$hoy', peso_final = '$peso' WHERE arete='$arete'"; 
        $resultado = mysqli_query($conexion,$actualizar); 
        
        $data['status'] = 'OK';
        $data['result'] = 'VACA FINALIZADA';
    
            }
else {

    $data['status'] = 'ERROR';
    $data['result'] = 'EL NUMERO DE ARETE NO EXISTE O SE ENCUENTRA FINALIZADO';

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