<?php

include('../../utility/AbstractSession.php');

class EspeciesValoradasEntity extends AbstractSession {

    private $conexion;

    public function EspeciesValoradasEntity($conexion) {
        $this->conexion = $conexion;
    }

    public function obtenerListaEspecieValoradaTabla($numeroCertificado,
            $lote,
            $tipo,
            $proveedor,
            $estadoRegistro,
            $limite,
            $cantidad) {
        $modulo = "EspeciesValoradasEntity.obtenerListaEspecieValoradaTabla";

        $consulta = "select producto, ";
        $consulta .= "certificado, ";
        $consulta .= "tipo, ";
        $consulta .= "lote, ";
        $consulta .= "nombreProveedor, ";
        $consulta .= "punto_venta, ";
        $consulta .= "descEstadoRegistro, ";
        $consulta .= "estado, ";
        $consulta .= "proveedor ";
        $consulta .= "from v_listaespeciesvaloradastabla ";
        $consulta .= "where certificado like '%" . $numeroCertificado . "%' ";
        $consulta .= "and tipo like '%" . $tipo . "%' ";
        $consulta .= "and estado like '%" . $estadoRegistro . "%' ";
        $consulta .= "and lote like '%" . $lote . "%' ";
        $consulta .= "and proveedor like '%" . $proveedor . "%' ";
        $consulta .= "order by producto desc ";
        $consulta .= "limit " . $limite . "," . $cantidad . ";";

        return parent::finalyTransaction($modulo,
                        $this->conexion,
                        $consulta);
    }

    public function insertarEspecieValorada($numero,
            $lote,
            $tipo,
            $proveedor,
            $poliza,
            $clase) {
        $modulo = "EspeciesValoradasEntity.insertarEspecieValorada";

        $consulta = "insert into producto( ";
        $consulta .= "numeroCertificado, ";
        $consulta .= "tipo, ";
        $consulta .= "codLote, ";
        $consulta .= "codPersona, ";
        $consulta .= "numeroPoliza, ";
        $consulta .= "codClaseProducto, ";
        $consulta .= "estadoRegistro, ";
        $consulta .= "fechaInsercion, ";
        $consulta .= "usuarioInsercion) ";
        $consulta .= "values( ";
        $consulta .= "'" . $numero . "', ";
        $consulta .= "'" . $tipo . "', ";
        $consulta .= "'" . $lote . "', ";
        $consulta .= "'" . $proveedor . "', ";
        $consulta .= "'" . $poliza . "', ";
        $consulta .= "'" . $clase . "', ";
        $consulta .= "'S', ";
        $consulta .= "CURDATE(), ";
        $consulta .= "'" . $_SESSION['usuario'] . "');";

        return parent::finalyTransaction($modulo,
                        $this->conexion,
                        $consulta);
    }

    public function modificarEspecieValorada($codigo,
            $numero,
            $lote,
            $tipo,
            $proveedor,
            $poliza,
            $clase) {
        $modulo = "EspeciesValoradasEntity.modificarEspecieValorada";

        $consulta = "call prc_actualizarproducto( ";
        $consulta .= $codigo . ", ";
        $consulta .= "'" . $numero . "', ";
        $consulta .= $lote . ", ";
        $consulta .= "'" . $tipo . "', ";
        $consulta .= $proveedor . ", ";
        $consulta .= "'" . $poliza . "', ";
        $consulta .= $clase . ", ";
        $consulta .= "'" . $_SESSION['usuario'] . "'); ";

        return parent::finalyTransaction($modulo,
                        $this->conexion,
                        $consulta);
    }

    public function obtenerEspecieValorada($codigo) {
        $modulo = "EspeciesValoradasEntity.obtenerEspecieValorada";

        $consulta = "select codProducto, "; //0
        $consulta .= "numeroCertificado, "; //1
        $consulta .= "tipo, "; //2
        $consulta .= "codLote, "; //3
        $consulta .= "codPersona, "; //4
        $consulta .= "estadoRegistro, "; //5
        $consulta .= "numeroPoliza, "; //6
        $consulta .= "fechaInsercion, "; //7
        $consulta .= "usuarioInsercion, "; //8
        $consulta .= "fechaModificacion, "; //9
        $consulta .= "usuarioModificacion, "; //10
        $consulta .= "codClaseProducto "; //11
        $consulta .= "from producto pro ";
        $consulta .= "where codProducto = '" . $codigo . "';";

        return parent::finalyTransaction($modulo,
                        $this->conexion,
                        $consulta);
    }

    public function obtenerCantidadRegistros($numeroCertificado,
            $lote,
            $tipo,
            $proveedor,
            $estadoRegistro) {
        $modulo = "EspeciesValoradasEntity.obtenerCantidadRegistros";

        $consulta = "select count(pro.codProducto) cant ";
        $consulta .= "from producto pro ";
        $consulta .= "inner join persona per on per.codPersona = pro.codPersona ";
        $consulta .= "inner join loteproductos lot on lot.codLote = pro.codLote ";
        $consulta .= "where pro.numeroCertificado like '%" . $numeroCertificado . "%' ";
        $consulta .= "and pro.tipo like '%" . $tipo . "%' ";
        $consulta .= "and pro.estadoRegistro like '%" . $estadoRegistro . "%' ";
        $consulta .= "and lot.descripcionLote like '%" . $lote . "%' ";
        $consulta .= "and per.codPersona like '%" . $proveedor . "%'; ";

        return parent::finalyTransaction($modulo,
                        $this->conexion,
                        $consulta);
    }

    public function obtenerEspecieValoradaReporte() {
        $modulo = "EspeciesValoradasEntity.obtenerEspecieValoradaReporte";

        $consulta = "select pro.numeroCertificado, ";
        $consulta .= "CASE pro.tipo WHEN 'W' THEN 'Web' WHEN 'M' THEN 'Manual' END tipo, ";
        $consulta .= "lot.descripcionLote, ";
        $consulta .= "per.nombreRazonSocial, ";
        $consulta .= "DATE_FORMAT(lot.fechaRecepcion,'%d/%m/%Y'), ";
        $consulta .= "DATE_FORMAT(lot.fechaVencimiento,'%d/%m/%Y') ";
        $consulta .= "from producto pro ";
        $consulta .= "inner join persona per on per.codPersona = pro.codPersona ";
        $consulta .= "inner join loteproductos lot on lot.codLote = pro.codLote; ";

        return parent::finalyTransaction($modulo,
                        $this->conexion,
                        $consulta);
    }

    public function obtenerListaEspecieValoradaSeleccion($especies,
            $numeroCertificado,
            $limite,
            $cantidad) {
        $modulo = "EspeciesValoradasEntity.obtenerListaEspecieValoradaTabla";

        $cadena = "";

        for ($i = 0; $i < count($especies); $i++) {
            if ($especies[$i] != "") {
                $cadena = $cadena . $especies[$i] . ",";
            }
        }
        $cadena = $cadena . "''";

        $consulta = "select concat(pro.codProducto,'\',\'',pro.numeroCertificado), ";
        $consulta .= "pro.numeroCertificado, ";
        $consulta .= "pro.tipo, ";
        $consulta .= "lot.descripcionLote, ";
        $consulta .= "per.nombreRazonSocial ";
        $consulta .= "from producto pro ";
        $consulta .= "inner join persona per on per.codPersona = pro.codPersona ";
        $consulta .= "inner join loteproductos lot on lot.codLote = pro.codLote ";
        $consulta .= "left join depositoproducto dpr on dpr.codProducto = pro.codProducto ";
        $consulta .= "where pro.numeroCertificado like '%" . $numeroCertificado . "%' ";
        if (count($especies) > 0) {
            $consulta .= "and pro.numeroCertificado not in (" . $cadena . ") ";
        }
        $consulta .= "and (dpr.codProducto IS NULL ";
        $consulta .= "or (dpr.codProducto not in (select d.codProducto from depositoproducto d where d.estadoRegistro = 'S') ";
        $consulta .= "and dpr.estadoRegistro in ('R'))) ";
        $consulta .= "order by pro.codProducto desc ";
        $consulta .= "limit " . $limite . "," . $cantidad . ";";

        return parent::finalyTransaction($modulo,
                        $this->conexion,
                        $consulta);
    }

    public function obtenerCantidadEspeciesValoradasLiquidaciones($especies,
            $numeroCertificado,
            $puntoVenta) {
        $modulo = "EspeciesValoradasEntity.obtenerCantidadEspeciesValoradasLiquidaciones";

        $cadena = "";

        for ($i = 0; $i < count($especies); $i++) {
            if ($especies[$i] != "") {
                $cadena = $cadena . $especies[$i] . ",";
            }
        }
        $cadena = $cadena . "''";

        $consulta = "select count(pro.codProducto) cant ";
        $consulta .= "from producto pro ";
        $consulta .= "inner join loteproductos lot on lot.codLote = pro.codLote ";
        $consulta .= "inner join depositoproducto dpr on dpr.codProducto = pro.codProducto ";
        $consulta .= "inner join Deposito dep on dpr.codDeposito = dep.codDeposito ";
        $consulta .= "inner join puntoventa pv on dep.puntoVenta = pv.codPersona ";
        $consulta .= "inner join persona per1 on pv.codPersona = per1.codPersona ";
        $consulta .= "inner join persona per2 on pro.codPersona = per2.codPersona ";
        $consulta .= "where pro.numeroCertificado like '%" . $numeroCertificado . "%' ";
        if (count($especies) > 0) {
            $consulta .= "and pro.numeroCertificado not in (" . $cadena . ") ";
        }
        $consulta .= "and per1.nombreRazonSocial like '%" . $puntoVenta . "%' ";
        $consulta .= "and dpr.estadoRegistro = 'S' ";

        return parent::finalyTransaction($modulo,
                        $this->conexion,
                        $consulta);
    }

    public function obtenerListaEspecieValoradaSeleccionLiquidacion($especies,
            $puntoVenta) {
        $modulo = "EspeciesValoradasEntity.obtenerListaEspecieValoradaSeleccionLiquidacion";

        $cadena = "";

        for ($i = 0; $i < count($especies); $i++) {
            if ($especies[$i] != "") {
                $cadena = $cadena . $especies[$i] . ",";
            }
        }
        $cadena = $cadena . "''";

        $consulta = "select concat(pro.codProducto,'\',\'',pro.numeroCertificado),  ";
        $consulta .= "pro.numeroCertificado, ";
        $consulta .= "pro.tipo, ";
        $consulta .= "lot.descripcionLote, ";
        $consulta .= "per2.nombreRazonSocial ";
        $consulta .= "from producto pro ";
        $consulta .= "inner join loteproductos lot on lot.codLote = pro.codLote ";
        $consulta .= "inner join depositoproducto dpr on dpr.codProducto = pro.codProducto ";
        $consulta .= "inner join Deposito dep on dpr.codDeposito = dep.codDeposito ";
        $consulta .= "inner join puntoventa pv on dep.puntoVenta = pv.codPersona ";
        $consulta .= "inner join persona per1 on pv.codPersona = per1.codPersona ";
        $consulta .= "inner join persona per2 on pro.codPersona = per2.codPersona ";
        $consulta .= "where per1.codPersona = '" . $puntoVenta . "' ";
        if (count($especies) > 0) {
            $consulta .= "and pro.numeroCertificado not in (" . $cadena . ") ";
        }
        $consulta .= "and dpr.estadoRegistro = 'S' ";
        $consulta .= "order by pro.codProducto desc; ";

        return parent::finalyTransaction($modulo,
                        $this->conexion,
                        $consulta);
    }

    public function obtenerCantidadRegistrosParaBusqueda($numeroCertificado) {
        $modulo = "EspeciesValoradasEntity.obtenerCantidadRegistrosParaBusqueda";

        $consulta = "select count(pro.codProducto) cant ";
        $consulta .= "from producto pro ";
        $consulta .= "where pro.numeroCertificado like '%" . $numeroCertificado . "%'; ";

        return parent::finalyTransaction($modulo,
                        $this->conexion,
                        $consulta);
    }

    public function reporteStockEnOficina(){
        $modulo = "EspeciesValoradasEntity.reporteStockEnOficina";

        $consulta = "select pro.certificado, ";
        $consulta .= "pro.poliza, ";
        $consulta .= "pro.proveedor ";
        $consulta .= "from v_reporte_stock_oficina pro ";

        return parent::finalyTransaction($modulo,
                        $this->conexion,
                        $consulta);
    }
    
    public function reporteDeCampo(){
        $modulo = "EspeciesValoradasEntity.reporteDeCampo";

        $consulta = "select pro.certificado, ";
        $consulta .= "pro.proveedor, ";
        $consulta .= "pro.puntoVenta, ";
        $consulta .= "pro.fechaDeposito, ";
        $consulta .= "pro.fechaVencimiento, ";
        $consulta .= "pro.diasRestantes, ";
        $consulta .= "pro.condicion ";
        $consulta .= "from v_reporte_trazabilidad pro ";

        return parent::finalyTransaction($modulo,
                        $this->conexion,
                        $consulta);
    }
    
    public function reporteLiquidacionesPorFecha($fechaInicial,$fechaFinal){
        $modulo = "EspeciesValoradasEntity.reporteLiquidacionesPorFecha";

        if ($fechaInicial != '' && $fechaFinal != ''){
            $fechaInicial = str_replace('/', '-', $fechaInicial);
            $fechaInicial = date('Y-m-d', strtotime($fechaInicial));
            $fechaFinal = str_replace('/', '-', $fechaFinal);
            $fechaFinal = date('Y-m-d', strtotime($fechaFinal));
        }
        
        $consulta = "select pro.certificado, ";
        $consulta .= "pro.proveedor, ";
        $consulta .= "pro.puntoVenta, ";
        $consulta .= "pro.fechaCadena ";
        $consulta .= "from v_reporte_liquidaciones_por_fecha pro ";
        if ($fechaInicial != '' && $fechaFinal != ''){
            $consulta .= "where pro.fechaLiquidacion >= '".$fechaInicial."' ";
            $consulta .= "and pro.fechaLiquidacion <= '".$fechaFinal."' ";
        }
        $consulta .= "order by pro.fechaLiquidacion desc ";

        return parent::finalyTransaction($modulo,
                        $this->conexion,
                        $consulta);
    }
    
    public function reporteDepositosPorFecha($fechaInicial,$fechaFinal){
        $modulo = "EspeciesValoradasEntity.reporteDepositosPorFecha";

        if ($fechaInicial != '' && $fechaFinal != ''){
            $fechaInicial = str_replace('/', '-', $fechaInicial);
            $fechaInicial = date('Y-m-d', strtotime($fechaInicial));
            $fechaFinal = str_replace('/', '-', $fechaFinal);
            $fechaFinal = date('Y-m-d', strtotime($fechaFinal));
        }
        
        $consulta = "select pro.certificado, ";
        $consulta .= "pro.proveedor, ";
        $consulta .= "pro.puntoVenta, ";
        $consulta .= "pro.fechaCadena ";
        $consulta .= "from v_reporte_deposito_por_fecha pro ";
        if ($fechaInicial != '' && $fechaFinal != ''){
            $consulta .= "where pro.fechaDeposito >= '".$fechaInicial."' ";
            $consulta .= "and pro.fechaDeposito <= '".$fechaFinal."' ";
        }
        $consulta .= "order by pro.fechaDeposito desc ";

        return parent::finalyTransaction($modulo,
                        $this->conexion,
                        $consulta);
    }
    
    public function cerrarConexion() {
        mysqli_close($this->conexion);
    }

}

?>