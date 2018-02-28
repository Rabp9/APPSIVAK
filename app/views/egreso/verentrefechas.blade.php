@extends('layout.layout')

@section('contenidoCuerpo')
    <h2 class="textAlignRight bordeAbajo tituloCabecera">GASTOS ENTRE FECHAS</h2>
    <section class="anchoCompleto textAlignLeft backGroundColorGrisClaro">
        <div class="contenidoMiddle">
            <label class="contenidoMiddle">Ver gastos entre:</label>
            <input type="date" id="txtFechaInicial" name="txtFechaInicial" class="contenidoMiddle text" value="{{{$fechaInicial}}}">
            <label class="contenidoMiddle">y</label>
            <input type="date" id="txtFechaFinal" name="txtFechaFinal" class="contenidoMiddle text" value="{{{$fechaFinal}}}">
            <input type="button" value="Cargar gastos" class="button" onclick="enviarVerEgresoFechas();">
        </div>
        <label class="contenidoMiddle">Buscar</label>
        <input type="text" class="contenidoMiddle text" size="50" onkeyup="filtrarHtml('tableEgreso', this.value, false, 200, event);">
        <label class="contenidoMiddle">Venta total: </label>
        S/.<div id="divGastoTotal" class="displayInlineBlock">0.00</div>
    </section>
    <section>
        <table id="tableEgreso" class="table">
            <thead>
                <th>LOCAL</th>
                <th>PERSONAL</th>
                <th>DESCRIPCIÓN</th>
                <th>MONTO</th>
                <th>FECHA REGISTRO</th>
            </thead>
            <tbody>
                @foreach($listaTEgreso as $item) 
                    <tr class="elementoBuscar">
                        <td>{{{$item->codigoOficina !='' ? $item->tOficina->descripcion : $item->tAlmacen->descripcion}}}</td>
                        <td>{{{$item->tPersonal->nombre}}} {{{$item->tPersonal->apellidoPaterno}}} {{{$item->tPersonal->apellidoMaterno}}}</td>
                        <td>{{{$item->descripcion}}}</td>
                        <td>{{{$item->monto}}}</td>
                        <td>{{{$item->created_at}}}</td>
                    </tr>
                    <script>
                        $('#divGastoTotal').text((parseFloat($('#divGastoTotal').text())+parseFloat('{{{$item->monto}}}')).toFixed(2));
                    </script>
                @endforeach
            </tbody>
        </table>
    </section>
    <script>
        function enviarVerEgresoFechas()
        {
            var mensajeGlobal='';
            
            mensajeGlobal=mensajeGlobal+(!valFechaYYYYMMDD($('#txtFechaInicial').val())?'Fecha inicial incorrecto<br>':'');
            mensajeGlobal=mensajeGlobal+(!valFechaYYYYMMDD($('#txtFechaFinal').val())?'Fecha final incorrecto<br>':'');

            if(mensajeGlobal!='')
            {
                animacionAlertaMensajeGeneral(mensajeGlobal, 'red');
                return;
            }

            window.location.href='/APPSIVAK/public/egreso/verentrefechas/'+$('#txtFechaInicial').val()+'/'+$('#txtFechaFinal').val();
        }
    </script>
@stop