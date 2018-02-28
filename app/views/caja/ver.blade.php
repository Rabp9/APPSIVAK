@extends('layout.layout')

@section('contenidoCuerpo')
    <h2 class="textAlignRight bordeAbajo tituloCabecera">CAJA</h2>
    <section class="anchoCompleto textAlignLeft backGroundColorGrisClaro">
        <label for="txtBuscar" class="contenidoMiddle">Buscar</label>
        <input type="text" id="txtBuscar" class="contenidoMiddle text" size="50" onkeyup="filtrarHtml('tableCaja', this.value, false, 200, event);" >
    </section>
    <section id="tableCaja" class="labelMediano textAlignLeft anchoCompleto">
        @foreach($listaTCaja as $item) 
            <div id="fila{{{$item->codigoCaja}}}" class="elementoBuscar bordeAbajo listaDatos">
                <div class="fila"><label>Fecha y hora de apertura: </label>{{{$item->created_at}}}</div>
                <div class="backGroundColorBlancoOscuro fondoRayasBlancas textAlignRight">
                    <button id="botonVerDetalle{{{$item->codigoCaja}}}" class="button" onclick="borrarElemento('filaDetalle'); agregarHtmlAlFinal('fila{{{$item->codigoCaja}}}', '<div id=filaDetalle class=bordeArriba></div>'); paginaAjax('filaDetalle', {codigo : '{{{$item->codigoCaja}}}'}, '/APPSIVAK/public/cajadetalle/verporcodigocaja', 'POST', null, animacionScrollMovimientoY('botonVerDetalle{{{$item->codigoCaja}}}', -170), false, true);">Ver detalle</button>
                </div>
            </div>
        @endforeach
    </section>
@stop