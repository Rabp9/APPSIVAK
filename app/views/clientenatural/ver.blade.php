@extends('layout.layout')

@section('contenidoCuerpo')
    <h2 class="textAlignRight bordeAbajo tituloCabecera">CLIENTE NATURAL</h2>
    <section class="anchoCompleto textAlignLeft backGroundColorGrisClaro">
        <label class="contenidoMiddle">Buscar</label>
        <input type="text" class="contenidoMiddle text" size="50" onkeyup="filtrarHtml('tableClienteNatural', this.value, false, 200, event);">
    </section>
    <section>
        <table id="tableClienteNatural" class="table">
            <thead>
                <th>DNI</th>
                <th>NOMBRE COMPLETO</th>
                <th>TELÉFONO</th>
                <th>CORREO</th>
                <th>FECHA DE NACIMIENTO</th>
                <th></th>
                <th></th>
            </thead>
            <tbody>
                @foreach($listaTClienteNatural as $item) 
                    <tr class="elementoBuscar">
                        <td>{{{$item->dni}}}</td>
                        <td>{{{$item->nombre.' '.$item->apellidoPaterno.' '.$item->apellidoMaterno}}}</td>
                        <td>{{{$item->telefono}}}</td>
                        <td>{{{$item->correo}}}</td>
                        <td>{{{$item->fechaNacimiento}}}</td>
                        <td><button onclick="paginaAjax('divVerDetalle', {codigo : '{{{$item->codigoClienteNatural}}}'}, '/APPSIVAK/public/clientenatural/verdetalle', 'POST', function(){$('#divVerDetalle').css({'display' : 'inline-block'});}, null, false, true);">Ver Detalles</button></td>
                        <td><button onclick="dialogoAjax('dialogo', 800, true, 'Datos para editar Cliente', 'top', {codigo : '{{{$item->codigoClienteNatural}}}'}, '/APPSIVAK/public/clientenatural/editar', 'POST', null, null, false, true);">Editar</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
    
@stop