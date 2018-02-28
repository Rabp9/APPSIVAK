@extends('layout.layout')

@section('contenidoCuerpo')
    <h2 class="textAlignRight bordeAbajo tituloCabecera">PRESENTACIÓN PARA PRODUCTOS</h2>
    <section class="anchoCompleto textAlignLeft backGroundColorGrisClaro">
        <label class="contenidoMiddle">Buscar</label>
        <input type="text" class="contenidoMiddle text" size="50" onkeyup="filtrarHtml('tablePresentacion', this.value, false, 200, event);">
    </section>
    <section class="contenidoTop">
        <table id="tablePresentacion" class="table">
            <thead>
                <th>NOMBRE</th>
                <th>DESCRIPCIÓN</th>
                <th></th>
            </thead>
            <tbody>
                @foreach($listaTPresentacion as $item) 
                    <tr class="elementoBuscar">
                        <td>{{{$item->nombre}}}</td>
                        <td>{{{$item->descripcion}}}</td>
                        <td><button onclick="dialogoAjax('dialogo', 450, true, 'Datos para editar Presentación', 'top', {codigo : '{{{$item->codigoPresentacion}}}'}, '/APPSIVAK/public/presentacion/editar', 'POST', null, null, false, true);">Editar</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
    
    <script>
        $(document).ready(function()
        {
            $('#tablePresentacion').chromatable(
            {
                width: '1200',
                height: '400',
                scrolling: 'yes'
            });                
        });
    </script>
@stop