@extends('layout.layout')

@section('contenidoCuerpo')
    <h2 class="textAlignRight bordeAbajo tituloCabecera">USUARIO</h2>
    <section class="anchoCompleto textAlignLeft backGroundColorGrisClaro">
        <label class="contenidoMiddle">Buscar</label>
        <input type="text" class="contenidoMiddle text" size="50" onkeyup="filtrarHtml('tableUsuario', this.value, false, 200, event);">
    </section>
    <section class="contenidoTop">
        <table id="tableUsuario" class="table">
            <thead>
                <th>NOMBRE USUARIO</th>
                <th>NOMBRE PERSONAL</th>
                <th>DNI PERSONAL</th>
                <th></th>
                <th></th>
                <th></th>
            </thead>
            <tbody>
                @foreach($listaTUsuario as $item)
                    @if($item->tPersonal->dni=='XXXXXXXX' && explode(',', Session::get('usuario'))[1]!='Yanapasoft')
                        <?php continue; ?>
                    @endif
                    <tr class="elementoBuscar">
                        <td>{{{$item->nombreUsuario}}}</td>
                        <td>{{{$item->tPersonal->nombre}}} {{{$item->tPersonal->apellidoPaterno}}} {{{$item->tPersonal->apellidoMaterno}}}</td>
                        <td>{{{$item->tPersonal->dni}}}</td>
                        <td><button onclick="dialogoAjax('dialogo', 800, true, 'Roles del usuario', 'top', {codigo : '{{{$item->codigoPersonal}}}'}, '/APPSIVAK/public/usuario/gestionarroles', 'POST', null, null, false, true);">Gestionar roles</button></td>
                        <td><button onclick="dialogoAjax('dialogo', 800, true, 'Datos para editar Usuario', 'top', {codigo : '{{{$item->codigoPersonal}}}'}, '/APPSIVAK/public/usuario/editar', 'POST', null, null, false, true);">Editar</button></td>
                        <td>
                            @if(explode(',', Session::get('usuario'))[1]=='Yanapasoft')
                                <button onclick="window.location.href='/APPSIVAK/public/usuario/enviarcontraseniacorreo/{{{$item->codigoPersonal}}}'">Enviar contraseña al correo</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
    
    <script>
        $(document).ready(function()
        {
            $('#tableUsuario').chromatable(
            {
                width: '1200',
                height: '400',
                scrolling: 'yes'
            });
        });
    </script>
@stop