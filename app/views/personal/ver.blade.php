@extends('layout.layout')

@section('contenidoCuerpo')
    <h2 class="textAlignRight bordeAbajo tituloCabecera">PERSONAL</h2>
    <section class="anchoCompleto textAlignLeft backGroundColorGrisClaro">
        <label class="contenidoMiddle">Buscar</label>
        <input type="text" class="contenidoMiddle text" size="50" onkeyup="filtrarHtml('tablePersonal', this.value, false, 200, event);">
    </section>
    <section class="contenidoTop">
        <table id="tablePersonal" class="table">
            <thead>
                <th>DNI</th>
                <th>NOMBRE COMPLETO</th>
                <th>TELÉFONO</th>
                <th>EMPLEADO</th>
                <th>CARGO</th>
                <th></th>
                <th></th>
            </thead>
            <tbody>
                @foreach($listaTPersonal as $item)
                    @if($item->dni=='XXXXXXXX' && explode(',', Session::get('usuario'))[1]!='Yanapasoft')
                        <?php continue; ?>
                    @endif
                    <tr class="elementoBuscar">
                        <td>{{{$item->dni}}}</td>
                        <td>{{{$item->nombre.' '.$item->apellidoPaterno.' '.$item->apellidoMaterno}}}</td>
                        <td>{{{$item->telefono}}}</td>
                        <td>{{{$item->tipoEmpleado}}}</td>
                        <td>{{{$item->cargo}}}</td>
                        <td><button onclick="paginaAjax('divVerDetalle', {codigo : '{{{$item->codigoPersonal}}}'}, '/APPSIVAK/public/personal/verdetalle', 'POST', function(){$('#divVerDetalle').css({'display' : 'inline-block'});}, null, false, true);">Ver Detalles</button></td>
                        <td><button onclick="dialogoAjax('dialogo', 800, true, 'Datos para editar Personal', 'top', {codigo : '{{{$item->codigoPersonal}}}'}, '/APPSIVAK/public/personal/editar', 'POST', null, null, false, true);">Editar</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
    
    <script>
        $(document).ready(function()
        {
            $('#tablePersonal').chromatable(
            {
                width: '1200',
                height: '400',
                scrolling: 'yes'
            });                
        });
    </script>
@stop