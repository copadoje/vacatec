<?php 

include "config.php";
include "utils.php";

$nombre =  ($_POST['nombre']);
$maiz = ($_POST['maiz']);
$soya = ($_POST['soya']);
$silo = ($_POST['silo']);
$rastrojo = ($_POST['rastrojo']);
$algodon = ($_POST['algodon']);
$ddg = ($_POST['ddg']);
$avena = ($_POST['avena']);
$melaza = ($_POST['melaza']);
$costo = ($_POST['costoxkg']);

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

$consulta="SELECT * FROM formulas WHERE nombre='$nombre'";
$resultado = mysqli_query($conexion, $consulta);

$filas=mysqli_num_rows($resultado);
//Verificamos si existe la formula
if ($filas>0) {
                $data['status'] = 'ERROR';
                $data['result'] = 'LA FORMULA YA EXISTE';
            }
else {
        $porcenta = $maiz + $soya + $silo + $rastrojo + $algodon + $ddg + $avena + $melaza;

        // Verificamos si da el 100% de ingredientes
        if($porcenta == 100){

            $insertar = "INSERT INTO formulas(nombre, maiz, soya, silo, rastrojo, algodon, ddg, avena, melaza, costo, status) VALUES ('$nombre','$maiz','$soya','$silo','$rastrojo','$algodon','$ddg','$avena','$melaza','$costo','1')";
            $resultado = mysqli_query($conexion,$insertar);
            $data['status'] = 'OK';
            $data['result'] = 'FORMULA REGISTRADA EXITOSAMENTE';  

        //Si no es el 100%    
        }else{

            $data['status'] = 'ERROR';
            $data['result'] = 'LA SUMA DE INGREDIENTES NO DA EL 100%';

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