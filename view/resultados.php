<?php
include "../Config.php";
$conexion = mysqli_connect($MysqlServer,$UserNameDB,$Pass)or die("Problemas al conectar");
mysqli_select_db($conexion, $DataBaseName)or die("Problemas al conectar la base de datos");
$Query = mysqli_query($conexion, "SELECT * FROM clientes");
if (!$Query) {
    die('No se pudo consultar:' . mysqli_error());
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Resultados</title>
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="<?php echo $UrlBase;?>Source/css/style.css">
      <link rel="stylesheet" href="<?php echo $UrlBase;?>Source/css/bootstrap.min.css">
      <link rel="stylesheet" href="<?php echo $UrlBase;?>Source/css/bootstrap.css">
    </head>
    <body>
        <div class="container">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h1>Visualización de resultados</h1>
                    <div class="row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-8">
                            <div class="ibox">
                                <div class="ibox-title">
                                    GEMA SAS
                                </div>
                                <div class="ibox-body">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <a href="<?php echo $UrlBase;?>"> << Volver</a>
                                        </div>
                                    </div>
                                    <?php
                                        if($Query->num_rows > 0){
                                            $UsuariosActivos = 0;
                                            $UsuariosInactivos = 0;
                                            $UsuariosEspera = 0;
                                            while ($Registro = mysqli_fetch_row($Query)) {
                                                
                                                if($Registro[4] == 1){
                                                    $UsuariosActivos = $UsuariosActivos + 1;
                                                }
                                                if($Registro[4] == 2){
                                                    $UsuariosInactivos = $UsuariosInactivos + 1;
                                                }
                                                if($Registro[4] == 3){
                                                    $UsuariosEspera = $UsuariosEspera + 1;
                                                }
                                                $DataUsuarios[] = array(
                                                    'Email' => $Registro[1],
                                                    'Nombre' => $Registro[2],
                                                    'Apellido' => $Registro[3],
                                                    'Codigo' => $Registro[4],
                                                );
                                            }
                                    ?>
                                    <div class="row">
                                        <div class="col-md-2">
                                        </div>
                                        <div class="col-md-8">
                                            <h2>Usuarios Activos</h2>
                                            <?php
                                                if($UsuariosActivos>0){
                                            ?>
                                            <table class="table table-hover table-bordered tb-gray">
                                                <tr>
                                                    <th>Email</th>
                                                    <th>Nombre</th>
                                                    <th>Apellido</th>
                                                </tr>
                                                <?php
                                                    for($i=0;$i<sizeof($DataUsuarios);$i++){
                                                        if($DataUsuarios[$i]['Codigo'] == 1){
                                                ?>
                                                <tr>
                                                    <td><?php echo $DataUsuarios[$i]['Email']; ?></td>
                                                    <td><?php echo $DataUsuarios[$i]['Nombre']; ?></td>
                                                    <td><?php echo $DataUsuarios[$i]['Apellido']; ?></td>
                                                </tr>
                                                    <?php }}?>
                                            </table>
                                            <?php
                                                }else{
                                                   echo "<h2 style='color: lightgray;'>No hay datos que mostrar</h2>"; 
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                        </div>
                                        <div class="col-md-8">
                                            <h2>Usuarios Inactivos</h2>
                                            <?php
                                                if($UsuariosInactivos>0){
                                            ?>
                                            <table class="table table-hover table-bordered tb-gray">
                                                <tr>
                                                    <th>Email</th>
                                                    <th>Nombre</th>
                                                    <th>Apellido</th>
                                                </tr>
                                                <?php
                                                    for($i=0;$i<sizeof($DataUsuarios);$i++){
                                                        if($DataUsuarios[$i]['Codigo'] == 2){
                                                ?>
                                                <tr>
                                                    <td><?php echo $DataUsuarios[$i]['Email']; ?></td>
                                                    <td><?php echo $DataUsuarios[$i]['Nombre']; ?></td>
                                                    <td><?php echo $DataUsuarios[$i]['Apellido']; ?></td>
                                                </tr>
                                                <?php }}?>
                                            </table>
                                            <?php
                                                }else{
                                                   echo "<h2 style='color: lightgray;'>No hay datos que mostrar</h2>"; 
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                        </div>
                                        <div class="col-md-8">
                                            <h2>Usuarios Espera</h2>
                                            <?php
                                                if($UsuariosEspera>0){
                                            ?>
                                            <table class="table table-hover table-bordered tb-gray">
                                                <tr>
                                                    <th>Email</th>
                                                    <th>Nombre</th>
                                                    <th>Apellido</th>
                                                </tr>
                                                <?php
                                                    for($i=0;$i<sizeof($DataUsuarios);$i++){
                                                        if($DataUsuarios[$i]['Codigo'] == 3){
                                                ?>
                                                <tr>
                                                    <td><?php echo $DataUsuarios[$i]['Email']; ?></td>
                                                    <td><?php echo $DataUsuarios[$i]['Nombre']; ?></td>
                                                    <td><?php echo $DataUsuarios[$i]['Apellido']; ?></td>
                                                </tr>
                                                <?php }}?>

                                            </table>
                                            <?php
                                                }else{
                                                   echo "<h2 style='color: lightgray;'>No hay datos que mostrar</h2>"; 
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <div style="display: none;" id="textContent"></div>
                                    <?php
                                        }else{
                                            echo "<h1>No existen datos para mostrar</h1>";
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="<?php echo $UrlBase;?>Source/js/jquery-3.2.1.js" ></script>
        <script src="<?php echo $UrlBase;?>Source/js/popper.min.js"></script>
        <script src="<?php echo $UrlBase;?>Source/js/tether.min.js" ></script>
        <script src="<?php echo $UrlBase;?>Source/js/bootstrap.js" ></script>
        <script src="<?php echo $UrlBase;?>Source/js/bootstrap.min.js" ></script>
        <script src="<?php echo $UrlBase;?>Source/js/bootstrap-filestyle.min.js"></script>
    </body>
</html>

