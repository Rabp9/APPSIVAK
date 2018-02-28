@extends('layout.layout')

@section('contenidoCuerpo')
    <h2 class="textAlignRight bordeAbajo tituloCabecera">UNIDAD DE MEDIDA PARA PRODUCTOS</h2>
    <section class="anchoCompleto textAlignLeft backGroundColorGrisClaro">
        <label class="contenidoMiddle">Buscar</label>
        <input type="text" class="contenidoMiddle text" size="50" onkeyup="filtrarHtml('tableUnidadMedida', this.value, false, 200, event);">
    </section>
    <section class="contenidoTop">
        <table id="tableUnidadMedida" class="table">
            <thead>
                <th>NOMBRE</th>
                <th>DESCRIPCIÓN</th>
                <th></th>
            </thead>
            <tbody>
                @foreach($listaTUnidadMedida as $item) 
                    <tr class="elementoBuscar">
                        <td>{{{$item->nombre}}}</td>
                        <td>{{{$item->descripcion}}}</td>
                        <td><button onclick="dialogoAjax('dialogo', 450, true, 'Datos para editar Presentación', 'top', {codigo : '{{{$item->codigoUnidadMedida}}}'}, '/APPSIVAK/public/unidadmedida/editar', 'POST', null, null, false, true);">Editar</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
    
    <script>
        $(document).ready(function()
        {
            $('#tableUnidadMedida').chromatable(
            {
                width: '1200',
                height: '400',
                scrolling: 'yes'
            });                
        });
    </script>
@stop