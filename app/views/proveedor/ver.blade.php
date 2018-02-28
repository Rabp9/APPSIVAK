@extends('layout.layout')

@section('contenidoCuerpo')
    <h2 class="textAlignRight bordeAbajo tituloCabecera">PROVEEDOR</h2>
    <section class="anchoCompleto textAlignLeft backGroundColorGrisClaro">
        <label class="contenidoMiddle">Buscar</label>
        <input type="text" class="contenidoMiddle text" size="50" onkeyup="filtrarHtml('tableProveedor', this.value, false, 200, event);">
    </section>
    <section id="tableProveedor" class="labelMediano textAlignLeft anchoCompleto">
        @foreach($listaTProveedor as $item) 
            <div id="fila{{{$item->codigoProveedor}}}" class="elementoBuscar bordeAbajo listaDatos">
                <div class="fila"><label>Doc. de Identidad: </label>{{{$item->documentoIdentidad}}}</div>
                <div class="fila"><label>Descripción: </label>{{{$item->nombre}}}</div>
                <div class="backGroundColorBlancoOscuro fondoRayasBlancas textAlignRight">
                    <button id="botonProductos{{{$item->codigoProveedor}}}" class="button" onclick="borrarElemento('filaDetalle'); agregarHtmlAlFinal('fila{{{$item->codigoProveedor}}}', '<div id=filaDetalle class=bordeArriba></div>'); paginaAjax('filaDetalle', {codigo : '{{{$item->codigoProveedor}}}'}, '/APPSIVAK/public/proveedorproducto/verporcodigoproveedor', 'POST', null, animacionScrollMovimientoY('botonProductos{{{$item->codigoProveedor}}}', -170), false, true);">Ver sus Producto</button>
                    <button id="botonPuntosVenta{{{$item->codigoProveedor}}}" class="button" onclick="borrarElemento('filaDetalle'); agregarHtmlAlFinal('fila{{{$item->codigoProveedor}}}', '<div id=filaDetalle class=bordeArriba></div>'); paginaAjax('filaDetalle', {codigo : '{{{$item->codigoProveedor}}}'}, '/APPSIVAK/public/proveedorpuntoventa/verporcodigoproveedor', 'POST', null, animacionScrollMovimientoY('botonPuntosVenta{{{$item->codigoProveedor}}}', -170), false, true);">Ver Puntos de Venta</button>
                    <button class="button" onclick="dialogoAjax('dialogo', 800, true, 'Datos para editar Proveedor', 'top', {codigo : '{{{$item->codigoProveedor}}}'}, '/APPSIVAK/public/proveedor/editar', 'POST', null, null, false, true);">Editar</button>
                </div>
            </div>            
        @endforeach
    </section>
    
@stop