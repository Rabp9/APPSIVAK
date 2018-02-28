@extends('layout.layout')

@section('contenidoCuerpo')
    <h2 class="textAlignRight bordeAbajo tituloCabecera">OFICINA</h2>
    <section class="anchoCompleto textAlignLeft backGroundColorGrisClaro">
        <label class="contenidoMiddle">Buscar</label>
        <input type="text" class="contenidoMiddle text" size="50" onkeyup="filtrarHtml('tableOficina', this.value, false, 200, event);">
    </section>
    <section class="contenidoTop">
        <table id="tableOficina" class="table">
            <thead>
                <th>DESCRIPCIÓN</th>
                <th>PAÍS</th>
                <th>DEPARTAMENTO</th>
                <th>PROVINCIA</th>
                <th>ESTADO</th>
                <th></th>
                <th></th>
                <th></th>
            </thead>
            <tbody>
                @foreach($listaTOficina as $item) 
                    <tr class="elementoBuscar">
                        <td>{{{$item->descripcion}}}</td>
                        <td>{{{$item->pais}}}</td>
                        <td>{{{$item->departamento}}}</td>
                        <td>{{{$item->provincia}}}</td>
                        <td>{{{$item->estado==1?"En Servicio":"Indispuesto"}}}</td>
                        <td><button onclick="irAdministrarPersonal('{{{$item->codigoOficina}}}');">Administrar Personal</button></td>
                        <td><button onclick="paginaAjax('divVerDetalle', {codigo : '{{{$item->codigoOficina}}}'}, '/APPSIVAK/public/oficina/verdetalle', 'POST', function(){$('#divVerDetalle').css({'display' : 'inline-block'});}, null, false, true);">Ver Detalles</button></td>
                        <td><button onclick="dialogoAjax('dialogo', 800, true, 'Datos para editar Oficina', 'top', {codigo : '{{{$item->codigoOficina}}}'}, '/APPSIVAK/public/oficina/editar', 'POST', null, null, false, true);">Editar</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
    
    <script>
        $(document).ready(function()
        {
            $('#tableOficina').chromatable(
            {
                width: '1200',
                height: '400',
                scrolling: 'yes'
            });                
        });

        function irAdministrarPersonal(codigoOficina)
        {
            window.location.href='/APPSIVAK/public/oficina/administrarpersonal/'+codigoOficina;
        }
    </script>
@stop