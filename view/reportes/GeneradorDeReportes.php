<?php
class GeneradorDeReportes {

    public function mostrarGeneradorDeReportes($grupo) {

        $grupoReporteBean;
        ?>    
        <!DOCTYPE html>
        <html >

            <head>
                <title>Reportes</title>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link rel=icon href='../../images/images.png' sizes="32x32" type="image/png">

                <script type="text/javascript" src="../../js/jquery-3.2.1.min.js"></script>

                <link rel="stylesheet" type="text/css" href="../../css/custom.css">
                <script type="text/javascript" src="../../js/envioFormulario.js"></script>
                <script type="text/javascript" src="../../js/icefoxUtilitarios.js"></script>

                <link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css" >
                <script src="../../js/jquery.min.js" type="text/javascript"></script>
                <link rel="stylesheet" type="text/css" href="../../css/bootstrap-datepicker.min.css" >
                <script src="../../js/bootstrap-datepicker.min.js" type="text/javascript"></script>
                <script src="../../js/bootstrap.min.js" type="text/javascript"></script>
            </head>

            <body>
                <div class="container">
                    <div class="panel panel-info">
                        <div class="panel-body">
                            <label><h3>Generador de Reportes</h3></label>

                            <form class="form-horizontal" action="../../view/reportes/GetGeneradorReportes.php" method="POST" name="formEnvio" id="formEnvio">
                                <input type="hidden" name="identificar" id="identificar">
                                <input type="hidden" name="codigoReporte" id="codigoReporte" >
                                <input type="hidden" name="validatorTable" id="validatorTable">
                                
                                <div class="form-group row">
                                    <div class="panel-heading">
                                        <div class="btn-group pull-left">
                                            <button type="button" class="btn btn-default" onclick='javascript:volverMenu();'>
                                                <span ></span> Volver al Menu</button>
                                        </div>

                                        <div class="btn-group pull-left">
                                            <button onclick="javascript:procesarReporte();" type='button' class="btn btn-info"><span class="glyphicon glyphicon-save" ></span> Procesar</button>
                                        </div>
                                    </div>

                                    <br>
                                    <br>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Grupo</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control" id="grupo" name="grupo" required onchange="obtenerSubgrupo(this.value)">
                                                        <option value="">Selecciona Grupo</option>
                                                        <?php
                                                        for ($i = 0; $i < count($grupo); $i++) {
                                                            $grupoReporteBean = $grupo[$i];
                                                            ?>
                                                            <option value="<?php echo $grupoReporteBean->getCodGrupo(); ?>"><?php echo $grupoReporteBean->getDescripcionGrupo(); ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div id="cboSubGrupo">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Sub Grupo</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" id="grupo" name="grupo" required>
                                                            <option value="">Selecciona SubGrupo</option>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div id="tablaReportes">

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div id="tablaParametros">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </body>

            <script type="text/javascript">
                var popupWindow;

                function obtenerSubgrupo(codGrupo) {

                    if (isEmpty(codGrupo)) {
                        return false;
                    }

                    if (window.XMLHttpRequest) {
                        xmlhttp = new XMLHttpRequest();
                    } else {
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }

                    xmlhttp.onreadystatechange = function () {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {	//4=se recibieron todos los datos de la respuesta del servidor /
                            //200=respuesta correcta
                            document.getElementById("cboSubGrupo").innerHTML = xmlhttp.responseText;
                        }
                    }
                    xmlhttp.open("GET", "../../view/reportes/GetGeneradorReportes.php?codGrupo=" + codGrupo, false);
                    xmlhttp.send();
                }

                function obtenerReportes(codSubGrupo) {

                    if (isEmpty(codSubGrupo)) {
                        return false;
                    }

                    if (window.XMLHttpRequest) {
                        xmlhttp = new XMLHttpRequest();
                    } else {
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }

                    xmlhttp.onreadystatechange = function () {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {	//4=se recibieron todos los datos de la respuesta del servidor /
                            //200=respuesta correcta
                            document.getElementById("tablaReportes").innerHTML = xmlhttp.responseText;
                        }
                    }
                    xmlhttp.open("GET", "../../view/reportes/GetGeneradorReportes.php?codSubGrupo=" + codSubGrupo, false);
                    xmlhttp.send();
                }

                function obtenerParametros(codReporte) {
                    if (isEmpty(codReporte + '')) {
                        return false;
                    }

                    document.getElementById('formEnvio').codigoReporte.value = codReporte;

                    if (window.XMLHttpRequest) {
                        xmlhttps = new XMLHttpRequest();
                    } else {
                        xmlhttps = new ActiveXObject("Microsoft.XMLHTTP");
                    }

                    xmlhttps.onreadystatechange = function () {
                        if (xmlhttps.readyState == 4 && xmlhttps.status == 200) {	//4=se recibieron todos los datos de la respuesta del servidor /
                            //200=respuesta correcta
                            document.getElementById("tablaParametros").innerHTML = xmlhttps.responseText;
                            document.getElementById("tablaParametrosEnvio").innerHTML = xmlhttps.responseText;
                        }
                    }
                    xmlhttps.open("GET", "../../view/reportes/GetGeneradorReportes.php?codReporte=" + codReporte, false);
                    xmlhttps.send();


                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function () {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            var myObj = JSON.parse(xmlhttp.responseText);
                            document.getElementById('formEnvio').identificar.value = myObj[0];
                        }
                    };
                    xmlhttp.open("GET", "../../view/reportes/GetGeneradorReportes.php?idReporte=" + codReporte, false);
                    xmlhttp.send();
                }

                function copiaTexto(){
                    
                }

                function procesarReporte() {
                    if (document.getElementById('formEnvio').identificar.value != '') {
                        var f = document.getElementById('formEnvio');

                        var window_width = 50;
                        var window_height = 50;
                        var newfeatures = 'scrollbars=no,resizable=no,menubar=no,location=no';
                        var window_top = (screen.height - window_height) / 2;
                        var window_left = (screen.width - window_width) / 2;
                        popupWindow = window.open("", "TheWindowChild", "_blank, width=" + window_width + ",height=" + window_height + ",top=" + window_top + ",left=" + window_left + ",features=" + newfeatures);
                        f.submit();

                        popupWindow.close();
                    }else{
                        alert("Seleccione un Reporte");
                    }
                }
            </script>
        </html>
        <?php
    }
}
;
?>

