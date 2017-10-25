<?php
class TablaRegistroEspeciesValoradasLiquidadas {

    public function mostrarTablaRegistroEspeciesValoradasLiquidadas($htmlTabla,
                            $numeroCertificado,
                            $codigoPuntoVenta,
                            $puntoVenta,
                            $pagina,
                            $cantPaginas) {
        ?>
        <!DOCTYPE html>
        <html >

            <head>
                <title>Lista de EV Liquidadas</title>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link rel=icon href='../../images/images.png' sizes="32x32" type="image/png">

                <link href="../../css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">

                <script src="../../js/jquery-3.2.1.min.js" type="text/javascript"></script>
                <link rel="stylesheet" type="text/css" href="../../css/custom.css">
                <script type="text/javascript" src="../../js/envioFormulario.js"></script>
                <script src="../../js/icefoxUtilitarios.js" type="text/javascript"></script>

                <link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css" >
                <script src="../../js/jquery.min.js" type="text/javascript"></script>
                <script src="../../js/bootstrap.min.js" type="text/javascript"></script>

            </head>

            <body>

                <div class="container">
                    <div class="panel panel-info">
                        <div class="panel-body">
                            <label><h3>Especies Valoradas Liquidadas</h3></label>
                            <?php
                            include("../../view/comercial/FormVentas.php");
                            $formVentas = new FormVentas;
                            $formVentas->mostrarFormVentas();

                            include("../../controller/intermedio/IntermedioController.php");
                            $intermedioController = new IntermedioController;
                            $intermedioController->mostrarFormMantenimientoVehiculo(array(),
                                                    'W');
                            ?>

                            <form class="form-horizontal" action="../../view/comercial/GetRegistroEspeciesValoradasLiquidadas.php" method="POST" name="formEnvio" id="formEnvio">

                                <div class="form-group row">

                                    <input type="hidden" name="validatorTable" id="validatorTable">
                                    <input type="hidden" name="direccion" id="direccion">
                                    <input type="hidden" name="producto" id="producto">

                                    <div class="panel-heading">
                                        <div class="btn-group pull-left">
                                            <button type="button" class="btn btn-default" onclick='javascript:volverMenu();'>
                                                <span ></span> Volver al Menu</button>
                                        </div>

                                        <!--<div class="btn-group pull-left">
                                                <button type='button' class="btn btn-info" data-toggle="modal" data-target="#venta"><span class="glyphicon glyphicon-plus" ></span> Registro de Venta</button>
                                        </div>-->
                                    </div>

                                    <br>
                                    <br>

                                    <div class="form-group row">
                                        <label for="q" class="col-md-2 control-label">Número de certificado</label>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" name="numeroCertificado" id="numeroCertificado" placeholder="Número de Certificado" value="<?php echo $numeroCertificado; ?>" onkeypress="pulsar(event);">
                                        </div>
                                        <div class="col-md-3">
                                            <button type="button" class="btn btn-default" onclick='javascript:buscar();'>
                                                <span class="glyphicon glyphicon-search" ></span> Buscar</button>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="q" class="col-md-2 control-label">Punto de Venta</label>
                                        <div class="col-md-5">
                                            <input  class="form-control" name="puntoVenta" id="puntoVenta" placeholder="Punto de Venta" type="text" size="50" value="<?php echo $puntoVenta; ?>">
                                        </div>
                                        <div class="col-md-3">
                                            <a href="#" onClick="abrirBusquedaPuntoVenta();"><img src="../../images/lupa4.png" width="15" height="15" border="0"></a>
                                        </div>
                                        <input class="form-control" name="codigoPuntoVenta" id="codigoPuntoVenta" type="hidden" value="<?php echo $codigoPuntoVenta; ?>">
                                    </div>

                                    <?php
                                    echo $htmlTabla;
                                    ?>

                                    <tr>
                                    <input type="hidden" name="pagina" id="pagina" size="2" maxlength="2" readonly value="<?php echo $pagina; ?>">
                                    <input type="hidden" name="totPagina" id="totPagina" size="2" maxlength="2" readonly value="<?php echo $cantPaginas; ?>">
                                    <td colspan=6><span class="pull-right">
                                            <?php
                                            include('../../utility/Footer.php');
                                            echo paginacion($pagina,
                                                                    $cantPaginas);
                                            ?>

                                        </span></td>
                                    </tr>

                                </div>

                            </form>
                            <form name ="formBusquedaPuntoVenta" id="formBusquedaPuntoVenta" method="post" action="../../view/generales/GetBusqueda.php" target="TheWindowChild">
                                <input  name="action" id="action" type="hidden" value="BUSQUEDA_PUNTO_VENTA_LIQUIDADOS">
                                <input  name="valor" id="valor" type="hidden" >
                            </form>
                            <form name ="formBusquedaVehiculo" id="formBusquedaVehiculo" method="post" action="../../view/mantenimientos/GetEnvioVehiculo.php" target="TheWindowChild">
                                <input  name="action" id="action" type="hidden" value="BUSQUEDA_VEHICULOS">
                                <input  name="valor" id="valor" type="hidden" >
                            </form>
                            <form name ="formBusquedaCliente" id="formBusquedaCliente" method="post" action="../../view/mantenimientos/GetEnvioVehiculo.php" target="TheWindowChild">
                                <input  name="action" id="action" type="hidden" value="BUSQUEDA_CLIENTES">
                                <input  name="valor" id="valor" type="hidden" >
                            </form>
                            <form name ="formNuevoCliente" id="formNuevoCliente" method="post" action="../../view/mantenimientos/GetEnvioMantenimientoPersona.php" target="TheWindowChild">
                                <input  name="validationModal" id="validationModal" type="hidden" value="W">
                            </form>
                        </div>
                    </div>
                </div>

                <script type="text/javascript" src="../../js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
                <script type="text/javascript" src="../../js/locales/bootstrap-datetimepicker.es.js" charset="UTF-8"></script>

            </body>

            <script type="text/javascript">
                                                var popupWindow;

                                                $(document).ready(function ()
                                                {
                                                    $('#nroDocumento').keypress(function (e) {
                                                        if (e.which == 13) {
                                                            abrirBusquedaCliente();
                                                        }
                                                    });

                                                    $('#vehiculo').keypress(function (e) {
                                                        if (e.which == 13) {
                                                            abrirBusquedaVehiculo();
                                                        }
                                                    });
                                                });

                                                $('.form_datetime').datetimepicker({
                                                    weekStart: 1,
                                                    todayBtn: 1,
                                                    autoclose: 1,
                                                    todayHighlight: 1,
                                                    startView: 2,
                                                    forceParse: 0,
                                                    showMeridian: 1
                                                });
                                                $('.form_date').datetimepicker({
                                                    language: 'es',
                                                    weekStart: 1,
                                                    todayBtn: 1,
                                                    autoclose: 1,
                                                    todayHighlight: 1,
                                                    startView: 2,
                                                    minView: 2,
                                                    forceParse: 0
                                                });
                                                $('.form_time').datetimepicker({
                                                    language: 'es',
                                                    weekStart: 1,
                                                    todayBtn: 1,
                                                    autoclose: 1,
                                                    todayHighlight: 1,
                                                    startView: 1,
                                                    minView: 0,
                                                    maxView: 1,
                                                    forceParse: 0
                                                });

                                                function load() {
                                                }

                                                function cargarCodigo(codigoProducto) {
                                                    document.getElementById('producto').value = codigoProducto;
                                                }

                                                function abrirBusquedaPuntoVenta() {
                                                    var f = document.getElementById('formBusquedaPuntoVenta');

                                                    f.valor.value = document.getElementById('puntoVenta').value;

                                                    var window_width = 500;
                                                    var window_height = 350;
                                                    var newfeatures = 'scrollbars=no,resizable=no,menubar=no,location=no';
                                                    var window_top = (screen.height - window_height) / 2;
                                                    var window_left = (screen.width - window_width) / 2;
                                                    popupWindow = window.open("", "TheWindowChild", "_blank, width=" + window_width + ",height=" + window_height + ",top=" + window_top + ",left=" + window_left + ",features=" + newfeatures);
                                                    f.submit();
                                                }

                                                function insertarPuntoVenta(codigo, descripcion) {
                                                    document.getElementById('codigoPuntoVenta').value = codigo;
                                                    document.getElementById('puntoVenta').value = descripcion;

                                                    popupWindow.close();

                                                    //buscar();
                                                }

                                                function abrirBusquedaVehiculo() {
                                                    var formVenta = document.getElementById('guardar_venta');
                                                    var codCliente = formVenta.codigoCliente.value;
                                                    var placa = formVenta.vehiculo.value;
                                                    var xmlhttp

                                                    if (codCliente != "") {
                                                        xmlhttp = new XMLHttpRequest();
                                                        xmlhttp.onreadystatechange = function () {
                                                            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                                                                var myObj = JSON.parse(xmlhttp.responseText);
                                                                if (myObj[0] == '0') {
                                                                    var confirmacion = confirm("Placa no Registrada. ¿Desea Registrar un Nuevo Vehiculo?");
                                                                    if (confirmacion == true) {
                                                                        $('#formNuevoVehiculo').modal('show');
                                                                    }
                                                                } else {
                                                                    alert("Vehiculo encontrado!");
                                                                    document.guardar_venta.vehiculo.value = myObj[1];
                                                                    document.guardar_venta.codigoVehiculo.value = myObj[0];
                                                                }
                                                            }
                                                        };

                                                        xmlhttp.open("GET", "../../view/mantenimientos/GetEnvioVehiculo.php?codCliente=" + codCliente + "&placa=" + placa, false);
                                                        xmlhttp.send();
                                                    } else {
                                                        alert("Debe Seleccionar o Registrar un Cliente para Buscar un Vehiculo.");
                                                    }
                                                }

                                                function insertarVehiculo(codigo, descripcion) {
                                                    document.getElementById('codigoCliente').value = codigo;
                                                    document.getElementById('cliente').value = descripcion;

                                                    popupWindow.close();

                                                    buscar();
                                                }
                                                function abrirBusquedaCliente() {
                                                    var formVenta = document.getElementById('guardar_venta');
                                                    var valorBusqueda = formVenta.nroDocumento.value;

                                                    if (window.XMLHttpRequest) {
                                                        xmlhttp = new XMLHttpRequest();
                                                    } else {
                                                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                                                    }

                                                    xmlhttp.onreadystatechange = function () {
                                                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {	//4=se recibieron todos los datos de la respuesta del servidor /
                                                            //200=respuesta correcta
                                                            var resp = xmlhttp.responseXML;
                                                            if (resp.getElementsByTagName("existe")[0].firstChild.nodeValue == "TRUE") {
                                                                formVenta.codigoCliente.value = resp.getElementsByTagName("codigo")[0].firstChild.nodeValue;
                                                                formVenta.cliente.value = resp.getElementsByTagName("razon")[0].firstChild.nodeValue;
                                                                formVenta.nroDocumento.value = resp.getElementsByTagName("documento")[0].firstChild.nodeValue;
                                                            } else {
                                                                var nuevoCliente = document.getElementById('formNuevoCliente');

                                                                var window_width = 995;
                                                                var window_height = 650;
                                                                var newfeatures = 'scrollbars=no,resizable=no,menubar=no,location=no';
                                                                var window_top = (screen.height - window_height) / 2;
                                                                var window_left = (screen.width - window_width) / 2;
                                                                popupWindow = window.open("", "TheWindowChild", "_blank, width=" + window_width + ",height=" + window_height + ",top=" + window_top + ",left=" + window_left + ",features=" + newfeatures);
                                                                nuevoCliente.submit();
                                                            }
                                                        }
                                                    }
                                                    xmlhttp.open("GET", "../../view/mantenimientos/GetEnvioMantenimientoPersona.php?valorBusqueda=" + valorBusqueda, false);
                                                    xmlhttp.send();
                                                }

                                                function insertarCliente(codigo, descripcion, documento) {
                                                    var guardar_venta = document.getElementById('guardar_venta');
                                                    guardar_venta.codigoCliente.value = codigo;
                                                    guardar_venta.cliente.value = descripcion;
                                                    guardar_venta.nroDocumento.value = documento;

                                                    popupWindow.close();
                                                }

                                                function registrar(codigoProducto){
                                                    document.guardar_venta.codigoProducto.value = codigoProducto;
                                                    $('#venta').modal('show');
                                                }

                                                function Devolver(codigoProducto) {
                                                    var confirmacion = confirm("¿Está Seguro de Registrar como Devolucion este Registro?");
                                                    if (confirmacion == true) {
                                                        document.getElementById('validatorTable').value = 'O';
                                                        document.getElementById('producto').value = codigoProducto;
                                                        document.formEnvio.submit();
                                                    }
                                                }

                                                function Recoger(codigoProducto) {
                                                    var confirmacion = confirm("¿Está Seguro de Registrar como Recogido este Registro?");
                                                    if (confirmacion == true) {
                                                        document.getElementById('validatorTable').value = 'C';
                                                        document.getElementById('producto').value = codigoProducto;
                                                        document.formEnvio.submit();
                                                    }
                                                }

                                                function Vencido(codigoProducto) {
                                                    var confirmacion = confirm("¿Está Seguro de Registrar como Vencido este Registro?");
                                                    if (confirmacion == true) {
                                                        document.getElementById('validatorTable').value = 'V';
                                                        document.getElementById('producto').value = codigoProducto;
                                                        document.formEnvio.submit();
                                                    }
                                                }

                                                function Anular(codigoProducto) {
                                                    var confirmacion = confirm("¿Está Seguro de Registrar como Anulado este Registro?");
                                                    if (confirmacion == true) {
                                                        document.getElementById('validatorTable').value = 'A';
                                                        document.getElementById('producto').value = codigoProducto;
                                                        document.formEnvio.submit();
                                                    }
                                                }

                                                function pulsar(e) {
                                                    tecla = (document.all) ? e.keyCode : e.which;
                                                    if (tecla == 13) {
                                                        buscar();
                                                    }
                                                }

                                                function mostrarReportes(codSubGrupo) {

                                                }

                                                function guardarVehiculo() {
                                                    var formVenta = document.getElementById('guardar_venta');
                                                    var valorBusqueda = formVenta.nroDocumento.value;

                                                    if (window.XMLHttpRequest) {
                                                        xmlhttp = new XMLHttpRequest();
                                                    } else {
                                                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                                                    }

                                                    xmlhttp.onreadystatechange = function () {
                                                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {	//4=se recibieron todos los datos de la respuesta del servidor /
                                                            //200=respuesta correcta
                                                            var resp = xmlhttp.responseXML;
                                                            if (resp.getElementsByTagName("existe")[0].firstChild.nodeValue == "TRUE") {
                                                                formVenta.codigoCliente.value = resp.getElementsByTagName("codigo")[0].firstChild.nodeValue;
                                                                formVenta.cliente.value = resp.getElementsByTagName("razon")[0].firstChild.nodeValue;
                                                                formVenta.nroDocumento.value = resp.getElementsByTagName("documento")[0].firstChild.nodeValue;
                                                            } else {
                                                                var nuevoCliente = document.getElementById('formNuevoCliente');

                                                                var window_width = 995;
                                                                var window_height = 650;
                                                                var newfeatures = 'scrollbars=no,resizable=no,menubar=no,location=no';
                                                                var window_top = (screen.height - window_height) / 2;
                                                                var window_left = (screen.width - window_width) / 2;
                                                                popupWindow = window.open("", "TheWindowChild", "_blank, width=" + window_width + ",height=" + window_height + ",top=" + window_top + ",left=" + window_left + ",features=" + newfeatures);
                                                                nuevoCliente.submit();
                                                            }
                                                        }
                                                    }
                                                    xmlhttp.open("GET", "../../view/mantenimientos/GetEnvioMantenimientoPersona.php?valorBusqueda=" + valorBusqueda, false);
                                                    xmlhttp.send();
                                                }
            </script>

        </html>
        <?php
    }
}
?>