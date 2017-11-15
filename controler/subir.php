<?php
include "../Config.php";
if($_POST['Valores'] != ""){
    $conexion = mysqli_connect($MysqlServer,$UserNameDB,$Pass)or die("Problemas al conectar");
    mysqli_select_db($conexion, $DataBaseName)or die("Problemas al conectar la base de datos");
    $Datos = $_POST['Valores'];
    $Registros = explode(";", $Datos);
    for($i = 0; $i<sizeof($Registros);$i++){
        $Individuales = explode(",",$Registros[$i]);
        mysqli_query($conexion,"INSERT INTO clientes(Email, Nombre, Apellido, Codigo) VALUES('$Individuales[0]','$Individuales[1]','$Individuales[2]','$Individuales[3]')");   
    }
    header('Location: '.$UrlBase."view/resultados.php");
}
?>

