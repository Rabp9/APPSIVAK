@extends('layout.layout')

@section('contenidoCuerpo')
    <script src="/APPSIVAK/public/js/chart.min.js"></script>
    <h2 class="textAlignRight bordeAbajo tituloCabecera">REPORTES</h2>
    <section>
        <div class="contenidoMiddle">
            <div>
                <h2 class="contenidoMiddle bordeAbajo textAlignCenter">Ventas del {{{date('Y')}}}</h2>
                Ventas<div class="contenidoMiddle" style="background-color: rgba(220, 220, 220, 0.4);height: 20px;width: 20px;"></div>
            </div>
            <canvas id="chartVentas" height="270"></canvas>
            <script>
                var data=
                {
                    labels:
                    [
                        "Enero",
                        "Febrero",
                        "Marzo",
                        "Abril",
                        "Mayo",
                        "Junio",
                        "Julio",
                        "Agosto",
                        "Septiembre",
                        "Octubre",
                        "Noviembre",
                        "Diciembre"
                    ],
                    datasets:
                    [
                        {
                            label: "Ingresos",
                            fillColor: "rgba(220, 220, 220, 0.4)",
                            strokeColor: "rgba(220,220,220,1)",
                            pointColor: "rgba(220,220,220,1)",
                            pointStrokeColor: "#fff",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(220,220,220,1)",
                            data: ['{{{$ventas[0]}}}', '{{{$ventas[1]}}}', '{{{$ventas[2]}}}', '{{{$ventas[3]}}}', '{{{$ventas[4]}}}', '{{{$ventas[5]}}}', '{{{$ventas[6]}}}', '{{{$ventas[7]}}}', '{{{$ventas[8]}}}', '{{{$ventas[9]}}}', '{{{$ventas[10]}}}', '{{{$ventas[11]}}}']
                        }
                    ]
                };

                var canvasChartVentas=document.getElementById("chartVentas");
                canvasChartVentas.width=window.innerWidth-(window.innerWidth/2)-40;
                var ctx=canvasChartVentas.getContext("2d");
                var chartVentas=new Chart(ctx).Line(data, {});
            </script>
        </div>
        <div class="contenidoMiddle">
            <div>
                <h2 class="contenidoMiddle bordeAbajo textAlignCenter">Ingresos vs Egresos del {{{date('Y')}}}</h2>
                Ingresos<div class="contenidoMiddle" style="background-color: rgba(220, 220, 220, 0.4);height: 20px;width: 20px;"></div>
                Egresos<div class="contenidoMiddle" style="background-color: rgba(254, 27, 27, 0.4);height: 20px;width: 20px;"></div>
            </div>
            <canvas id="chartIngresosEgresos" height="270"></canvas>
            <script>
                var data=
                {
                    labels:
                    [
                        "Enero",
                        "Febrero",
                        "Marzo",
                        "Abril",
                        "Mayo",
                        "Junio",
                        "Julio",
                        "Agosto",
                        "Septiembre",
                        "Octubre",
                        "Noviembre",
                        "Diciembre"
                    ],
                    datasets:
                    [
                        {
                            label: "Ingresos",
                            fillColor: "rgba(220, 220, 220, 0.4)",
                            strokeColor: "rgba(220,220,220,1)",
                            pointColor: "rgba(220,220,220,1)",
                            pointStrokeColor: "#fff",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(220,220,220,1)",
                            data: ['{{{$ingresos[0]}}}', '{{{$ingresos[1]}}}', '{{{$ingresos[2]}}}', '{{{$ingresos[3]}}}', '{{{$ingresos[4]}}}', '{{{$ingresos[5]}}}', '{{{$ingresos[6]}}}', '{{{$ingresos[7]}}}', '{{{$ingresos[8]}}}', '{{{$ingresos[9]}}}', '{{{$ingresos[10]}}}', '{{{$ingresos[11]}}}']
                        },
                        {
                            label: "Egresos",
                            fillColor: "rgba(254, 27, 27, 0.4)",
                            strokeColor: "rgba(151,187,205,1)",
                            pointColor: "rgba(151,187,205,1)",
                            pointStrokeColor: "#fff",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(151,187,205,1)",
                            data: ['{{{$egresos[0]}}}', '{{{$egresos[1]}}}', '{{{$egresos[2]}}}', '{{{$egresos[3]}}}', '{{{$egresos[4]}}}', '{{{$egresos[5]}}}', '{{{$egresos[6]}}}', '{{{$egresos[7]}}}', '{{{$egresos[8]}}}', '{{{$egresos[9]}}}', '{{{$egresos[10]}}}', '{{{$egresos[11]}}}']
                        }
                    ]
                };

                var canvasChartIngresosEgresos=document.getElementById("chartIngresosEgresos");
                canvasChartIngresosEgresos.width=window.innerWidth-(window.innerWidth/2)-40;
                var ctx=canvasChartIngresosEgresos.getContext("2d");
                var chartIngresosEgresos=new Chart(ctx).Bar(data, {});
            </script>
        </div>
        <hr>
        <h2 class="bordeAbajo">Reportes en formato Excel</h2>

        <br>
        <h2 class="textAlignLeft bordeArriba bordeAbajo">Reporte de almacén</h2>
        <div class="itemReporte" onclick="window.open('/APPSIVAK/public/reporte/productosagotadosporagotarsealmacen', '_blank');">
            <div class="textoItemReporte">
                <img src="/APPSIVAK/public/img/iconos/reporte/reportesExcel.png">
                <br>
                Productos agotados y por agotarse en almacén
            </div>
        </div>
        <div class="itemReporte" onclick="window.open('/APPSIVAK/public/reporte/productosporvencersealmacen', '_blank');">
            <div class="textoItemReporte">
                <img src="/APPSIVAK/public/img/iconos/reporte/reportesExcel.png">
                <br>
                Productos por vencerse en almacén
            </div>
        </div>
        <div class="itemReporte" onclick="dialogoAjax('dialogo', '900', false, 'Productos por oficina/tienda', 'top', null, '/APPSIVAK/public/reporte/productosporcodigoalmacen', 'POST', null, null, false, true);">
            <div class="textoItemReporte">
                <img src="/APPSIVAK/public/img/iconos/reporte/reportesExcel.png">
                <br>
                Productos por almacén
            </div>
        </div>
        <div class="itemReporte" onclick="dialogoAjax('dialogo', '450', false, 'Rango de fechas', 'top', null, '/APPSIVAK/public/reporte/envioproductosalmacenoficinaentrefechas', 'POST', null, null, false, true);">
            <div class="textoItemReporte">
                <img src="/APPSIVAK/public/img/iconos/reporte/reportesExcel.png">
                <br>
                Productos enviados de almacén a oficina/tienda entre dos fechas
            </div>
        </div>
        <div class="itemReporte" onclick="window.open('/APPSIVAK/public/reporte/productosretiradosalmacen', '_blank');">
            <div class="textoItemReporte">
                <img src="/APPSIVAK/public/img/iconos/reporte/reportesExcel.png">
                <br>
                Productos retirados de almacén
            </div>
        </div>

        <br><br>
        <h2 class="textAlignLeft bordeArriba bordeAbajo">Reporte de compras</h2>
        <div class="itemReporte" onclick="dialogoAjax('dialogo', '450', false, 'Rango de fechas', 'top', null, '/APPSIVAK/public/reporte/compraentrefechas', 'POST', null, null, false, true);">
            <div class="textoItemReporte">
                <img src="/APPSIVAK/public/img/iconos/reporte/reportesExcel.png">
                <br>
                Compras registradas entre dos fechas
            </div>
        </div>
        <div class="itemReporte" onclick="dialogoAjax('dialogo', '900', false, 'Almacén y rango de fechas', 'top', null, '/APPSIVAK/public/reporte/compraentrefechasporcodigoalmacen', 'POST', null, null, false, true);">
            <div class="textoItemReporte">
                <img src="/APPSIVAK/public/img/iconos/reporte/reportesExcel.png">
                <br>
                Compras registradas entre dos fechas por almacén
            </div>
        </div>

        <div class="itemReporte" onclick="dialogoAjax('dialogo', '450', false, 'Rango de fechas y tipo de comprobante', 'top', null, '/APPSIVAK/public/reporte/compraporreciboemitidoentrefechas', 'POST', null, null, false, true);">
            <div class="textoItemReporte">
                <img src="/APPSIVAK/public/img/iconos/reporte/reportesExcel.png">
                <br>
                Compras por comprobante emitido entre dos fechas
            </div>
        </div>
        <div class="itemReporte" onclick="dialogoAjax('dialogo', '900', false, 'Almacén, rango de fechas y tipo de comprobante', 'top', null, '/APPSIVAK/public/reporte/compraporreciboemitidoentrefechasporcodigoalmacen', 'POST', null, null, false, true);">
            <div class="textoItemReporte">
                <img src="/APPSIVAK/public/img/iconos/reporte/reportesExcel.png">
                <br>
                Compras por comprobante emitido entre dos fechas y almacén
            </div>
        </div>

        <div class="itemReporte" onclick="window.open('/APPSIVAK/public/reporte/comprasporpagar', '_blank');">
            <div class="textoItemReporte">
                <img src="/APPSIVAK/public/img/iconos/reporte/reportesExcel.png">
                <br>
                Compras en almacén por pagar
            </div>
        </div>

        <br><br>
        <h2 class="textAlignLeft bordeArriba bordeAbajo">Reporte de oficina/tienda</h2>
        <div class="itemReporte" onclick="window.open('/APPSIVAK/public/reporte/productosagotadosporagotarsestock', '_blank');">
            <div class="textoItemReporte">
                <img src="/APPSIVAK/public/img/iconos/reporte/reportesExcel.png">
                <br>
                Productos agotados y por agotarse en stock
            </div>
        </div>
        <div class="itemReporte" onclick="window.open('/APPSIVAK/public/reporte/productosporvencersestock', '_blank');">
            <div class="textoItemReporte">
                <img src="/APPSIVAK/public/img/iconos/reporte/reportesExcel.png">
                <br>
                Productos por vencerse en stock
            </div>
        </div>
        <div class="itemReporte" onclick="dialogoAjax('dialogo', '900', false, 'Productos por oficina/tienda', 'top', null, '/APPSIVAK/public/reporte/productosporcodigooficina', 'POST', null, null, false, true);">
            <div class="textoItemReporte">
                <img src="/APPSIVAK/public/img/iconos/reporte/reportesExcel.png">
                <br>
                Productos por oficina/tienda
            </div>
        </div>
        <div class="itemReporte" onclick="dialogoAjax('dialogo', '450', false, 'Rango de fechas', 'top', null, '/APPSIVAK/public/reporte/productotrasladooficinaentrefechas', 'POST', null, null, false, true);">
            <div class="textoItemReporte">
                <img src="/APPSIVAK/public/img/iconos/reporte/reportesExcel.png">
                <br>
                Productos trasladados entre oficinas/tiendas entre dos fechas
            </div>
        </div>
        <div class="itemReporte" onclick="window.open('/APPSIVAK/public/reporte/productosretiradosoficina', '_blank');">
            <div class="textoItemReporte">
                <img src="/APPSIVAK/public/img/iconos/reporte/reportesExcel.png">
                <br>
                Productos retirados de oficina
            </div>
        </div>

        <br><br>
        <h2 class="textAlignLeft bordeArriba bordeAbajo">Reporte de ventas</h2>
        <div class="itemReporte" onclick="dialogoAjax('dialogo', '450', false, 'Rango de fechas', 'top', null, '/APPSIVAK/public/reporte/ventaentrefechas', 'POST', null, null, false, true);">
            <div class="textoItemReporte">
                <img src="/APPSIVAK/public/img/iconos/reporte/reportesExcel.png">
                <br>
                Ventas registradas entre dos fechas
            </div>
        </div>
        <div class="itemReporte" onclick="dialogoAjax('dialogo', '900', false, 'Oficina y rango de fechas', 'top', null, '/APPSIVAK/public/reporte/ventaentrefechasporcodigooficina', 'POST', null, null, false, true);">
            <div class="textoItemReporte">
                <img src="/APPSIVAK/public/img/iconos/reporte/reportesExcel.png">
                <br>
                Ventas registradas entre dos fechas por oficina
            </div>
        </div>
        <div class="itemReporte" onclick="dialogoAjax('dialogo', '450', false, 'Comprobante y rango de fechas', 'top', null, '/APPSIVAK/public/reporte/ventaentrefechasportiporecibo', 'POST', null, null, false, true);">
            <div class="textoItemReporte">
                <img src="/APPSIVAK/public/img/iconos/reporte/reportesExcel.png">
                <br>
                Ventas por comprobante emitido entre dos fechas
            </div>
        </div>
        <div class="itemReporte" onclick="dialogoAjax('dialogo', '900', false, 'Oficina, comprobante y rango de fechas', 'top', null, '/APPSIVAK/public/reporte/ventaentrefechasporcodigooficinatiporecibo', 'POST', null, null, false, true);">
            <div class="textoItemReporte">
                <img src="/APPSIVAK/public/img/iconos/reporte/reportesExcel.png">
                <br>
                Ventas por comprobante emitido entre dos fechas y oficina
            </div>
        </div>
        <div class="itemReporte" onclick="window.open('/APPSIVAK/public/reporte/ventasporcobrarpagos', '_blank');">
            <div class="textoItemReporte">
                <img src="/APPSIVAK/public/img/iconos/reporte/reportesExcel.png">
                <br>
                Ventas en oficina/tienda por cobrar (Pagos en general)
            </div>
        </div>
        <div class="itemReporte" onclick="window.open('/APPSIVAK/public/reporte/ventasporcobrarletras', '_blank');">
            <div class="textoItemReporte">
                <img src="/APPSIVAK/public/img/iconos/reporte/reportesExcel.png">
                <br>
                Ventas en oficina/tienda por cobrar (Pagos por letras)
            </div>
        </div>
        
        <br><br>
        <h2 class="textAlignLeft bordeArriba bordeAbajo">Reporte de caja</h2>
        <div class="itemReporte" onclick="dialogoAjax('dialogo', '450', false, 'Rango de fechas', 'top', null, '/APPSIVAK/public/reporte/gastoentrefechas', 'POST', null, null, false, true);">
            <div class="textoItemReporte">
                <img src="/APPSIVAK/public/img/iconos/reporte/reportesExcel.png">
                <br>
                Gastos realizados entre dos fechas (Egresos)
            </div>
        </div>
        <div class="itemReporte" onclick="dialogoAjax('dialogo', '450', false, 'Rango de fechas', 'top', null, '/APPSIVAK/public/reporte/cajaentrefechas', 'POST', null, null, false, true);">
            <div class="textoItemReporte">
                <img src="/APPSIVAK/public/img/iconos/reporte/reportesExcel.png">
                <br>
                Caja entre dos fechas
            </div>
        </div>
    </section>
    <section id="apartadoBuscar" class="apartadoBuscar">
        <div id="divBuscarEnTablaAlmacen">
            <script>
                paginaAjax('divBuscarEnTablaAlmacen', null, '/APPSIVAK/public/almacen/buscaralmacen', 'POST', null, null, false, true);
            </script>
        </div>
        <div id="divBuscarEnTablaOficina">
            <script>
                paginaAjax('divBuscarEnTablaOficina', null, '/APPSIVAK/public/oficina/buscaroficina', 'POST', null, null, false, true);
            </script>
        </div>
    </section>
    <script>
        function ocultarDivsBuscar()
        {
            var css=
            {
                'display': 'none'
            };
            $('#divBuscarEnTablaAlmacen').css(css);
            $('#divBuscarEnTablaOficina').css(css);
        }

        function mostrarDivBuscar(idDivBuscar)
        {
            var css=
            {
                'display': 'inline-block'
            };
            $('#'+idDivBuscar).css(css);
        }
    </script>
    
@stop