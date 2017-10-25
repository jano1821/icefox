<?php
date_default_timezone_set('America/Lima');
?>

<style>
    #footer {
        position:fixed;
        left:0px;
        bottom:0px;
        height:50px;
        width:100%;
        background:#999;
        color: black;
    }
</style>

<script language="JavaScript">
    window.setTimeout('mostrar()', 100);
    function mostrar() {
        
        var meses = new Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        
        var diasSemana = new Array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
        
        var f = new Date();
        
        var etiqueta = "Fecha: " + diasSemana[f.getDay()] + ", " + f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear() + " Hora: "+f.getHours()+":"+f.getMinutes()+":"+f.getSeconds();

        document.getElementById('hora').innerHTML = etiqueta;
        window.setTimeout("mostrar()", 1000);
    }
</script>
<div id="footer">
    <div align = "center">
        <p><label id="hora"></label></p>
    </div>
</div>