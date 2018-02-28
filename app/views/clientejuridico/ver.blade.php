@extends('layout.layout')

@section('contenidoCuerpo')
    <h2 class="textAlignRight bordeAbajo tituloCabecera">CLIENTE JURÍDICO</h2>
    <section class="anchoCompleto textAlignLeft backGroundColorGrisClaro">
        <label class="contenidoMiddle">Buscar</label>
        <input type="text" class="contenidoMiddle text" size="50" onkeyup="filtrarHtml('tableClienteJuridico', this.value, false, 200, event);">
    </section>
    <section id="tableClienteJuridico" class="labelMediano textAlignLeft anchoCompleto">
        @foreach($listaTClienteJuridico as $item) 
            <div id="fila{{{$item->codigoClienteJuridico}}}" class="elementoBuscar bordeAbajo listaDatos">
                <div class="fila"><label>Ruc: </label>{{{$item->ruc}}}</div>
                <div class="fila"><label>Razón Social: </label>{{{$item->razonSocialLarga}}}</div>
                <div class="fila"><label>País: </label>{{{$item->pais}}}</div>
                <div class="backGroundColorBlancoOscuro fondoRayasBlancas textAlignRight">
                    <button class="button" id="botonRepresentantesJuridicos{{{$item->codigoClienteJuridico}}}" onclick="borrarElemento('filaDetalle'); agregarHtmlAlFinal('fila{{{$item->codigoClienteJuridico}}}', '<div id=filaDetalle class=bordeArriba></div>'); paginaAjax('filaDetalle', {codigo : '{{{$item->codigoClienteJuridico}}}'}, '/APPSIVAK/public/clientejuridicorepresentante/verporcodigoclientejuridico', 'POST', null, animacionScrollMovimientoY('botonRepresentantesJuridicos{{{$item->codigoClienteJuridico}}}', -170), false, true);">Representantes Jurídicos</button>
                    <button class="button" id="{{{$item->codigoClienteJuridico}}}" onclick="paginaAjax('divVerDetalle', {codigo : this.id}, '/APPSIVAK/public/clientejuridico/verdetalle', 'POST', function(){$('#divVerDetalle').css({'display' : 'inline-block'});}, null, false, true);">Ver Detalles</button>
                    <button class="button" id="{{{$item->codigoClienteJuridico}}}" onclick="dialogoAjax('dialogo', 800, true, 'Datos para editar Cliente', 'top', {codigo : this.id}, '/APPSIVAK/public/clientejuridico/editar', 'POST', null, null, false, true);">Editar</button>
                </div>
            </div>            
        @endforeach
    </section>
@stop