@extends('layout.layout')

@section('contenidoCuerpo')
    <h2 class="textAlignRight bordeAbajo tituloCabecera">CATEGORÍA</h2>
    <section class="anchoCompleto textAlignLeft backGroundColorGrisClaro">
        <label class="contenidoMiddle">Buscar</label>
        <input type="text" class="contenidoMiddle text" size="50" onkeyup="filtrarHtml('tableCategoria', this.value, false, 200, event);">
    </section>
    <section id="tableCategoria" class="labelPequenio textAlignLeft anchoCompleto">
        @foreach($listaTCategoria as $item) 
            <div id="fila{{{$item->codigoCategoria}}}" class="elementoBuscar bordeAbajo listaDatos">
                <div class="fila"><label>Nombre: </label>{{{$item->nombre}}}</div>
                <div class="fila"><label>Descripción: </label>{{{$item->descripcion}}}</div>
                <button class="button" onclick="borrarElemento('filaDetalle'); agregarHtmlAlFinal('fila{{{$item->codigoCategoria}}}', '<div id=filaDetalle class=bordeArriba></div>'); paginaAjax('filaDetalle', {codigo : '{{{$item->codigoCategoria}}}'}, '/APPSIVAK/public/categoria/verporcodigocategoriapadre', 'POST', null, null, false, true);">Ver Sub Categorías</button>
                <button class="button" id="{{{$item->codigoCategoria}}}" onclick="dialogoAjax('dialogo', 450, true, 'Datos para editar Categoría', 'top', {codigo : this.id}, '/APPSIVAK/public/categoria/editar', 'POST', null, null, false, true);">Editar</button>
            </div>            
        @endforeach
    </section>
    
@stop