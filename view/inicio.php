<?php
include "../Config.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Inicio</title>
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="<?php echo $UrlBase;?>Source/css/bootstrap.min.css">
      <link rel="stylesheet" href="<?php echo $UrlBase;?>Source/css/bootstrap.css">
      <link rel="stylesheet" href="<?php echo $UrlBase;?>Source/css/style.css">
    </head>
    <body>
        <div class="container">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h1>Formulario de carga</h1>
                    <div class="row">
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-6">
                            <div class="ibox">
                                <div class="ibox-title">
                                    GEMA SAS
                                </div>
                                <div class="ibox-body">
                                    <div class="row">
                                        <div class="col-md-2">
                                        </div>
                                        <div class="col-md-8">
                                            Formulario de carga de informacion
                                            <form class="form-inline" id="frmDatos" action="<?php echo $UrlBase;?>controler/subir.php" method="post">
                                                <div class="form-group text-centre">
                                                    <label></label>
                                                    <input type="file" name="ArchivoSubir" id="ArchivoSubir">
						</div>
                                                <input type="hidden" name="Valores" id="Valores">
                                                <span class="AlertNotification" id="Alerta" style="display: none;">Archivo no valido</span>
                                                <div class="form-group" align="left">
                                                    <input type="button" class="form-control" name="EnviaForm" value="EnviarFormulario" id="EnviaForm">
						</div>
                                            </form>
                                        </div>
                                    </div>
                                    <div style="display: none;" id="textContent"></div>
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
        <script type="text/javascript">
            var Continua = false;
            $(document).ready(function() {
                $('#ArchivoSubir').filestyle({
                    'placeholder' : "Seleccione un archivo",
                    'text': "Cargar",
                    onChange: function (param) {
                        if($("#ArchivoSubir").val() != ""){
                            var arch = $("#ArchivoSubir").val().split(".");
                            var doc = arch[1];
                            if (doc == "txt"){
                                $('#EnviaForm').attr('disabled', true);
                                var archivo = $("#ArchivoSubir").get(0).files[0];
                                if (!archivo) {
                                    return;
                                }
                                var ContenidoTexto = "";
                                readFile(archivo, function(e) {
                                    $("#textContent").html(e.target.result);
                                });
                                validaFile();
                            }else{
                                $("#Alerta").html("Solo puedes subir archivos txt");
                                $("#Alerta").show();
                                $("#ArchivoSubir").val("");
                                $('#ArchivoSubir').filestyle('clear');
                            }
                        }
                    }
                });
                function readFile(file, onLoadCallback){
                    var reader = new FileReader();
                    reader.onload = onLoadCallback;
                    reader.readAsText(file);
                }
                function validaFile(){
                    var TextValida = "";
                    var Registros = "";
                    Continua = true;
                    setTimeout(function(){
                        TextValida = $('#textContent').html();
                        if(TextValida != ""){
                            Registros = TextValida.replace(/\n/g,";");
                            //Columnas = Columnas.replace(String.fromCharCode(10),";");
                            //var Columnas2 = Columnas.replace(,";");
                            $('#textContent').html(Registros);
                            Registros = Registros.split(";");
                            var validar = "";
                            for(var i=0;i<Registros.length;i++){
                                validar = Registros[i].split(",");
                                if(validar[3] != ""){
                                    $("#Alerta").hide();
                                    $('#EnviaForm').attr('disabled', false);
                                }else{
                                    Continua = false;
                                    $("#Alerta").html("El archivo no tiene el formato correcto");
                                    $("#Alerta").show();
                                    $('#EnviaForm').attr('disabled', true);
                                    break;
                                }
                            }
                            
                        }
                    },1000);
                }
                
            });
            $('#EnviaForm').click(function(){
                if(Continua){
                    $('#Valores').val($('#textContent').html());
                    $('#frmDatos').submit();
                }
            });
        </script>
    </body>
</html>
