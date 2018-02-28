<form id="frmEditarAlmacenProducto" action="/APPSIVAK/public/almacenproducto/editartodoslocales" method="post" class="formulario labelMediano textAlignCenter">
    <div class="contenidoTop textAlignLeft">
        <input type="hidden" id="txtEditarProducto" name="txtEditarProducto" value="editar">
        <input type="hidden" id="txtCodigoBarrasHidden" name="txtCodigoBarrasHidden" value="{{{$codigoBarras}}}">
        <input type="hidden" id="txtPrimerNombreHidden" name="txtPrimerNombreHidden" value="{{{$primerNombre}}}">
        <input type="hidden" id="txtSegundoNombreHidden" name="txtSegundoNombreHidden" value="{{{$segundoNombre}}}">
        <input type="hidden" id="txtTercerNombreHidden" name="txtTercerNombreHidden" value="{{{$tercerNombre}}}">
        <input type="hidden" id="txtCodigoPresentacionHidden" name="txtCodigoPresentacionHidden" value="{{{$codigoPresentacion}}}">
        <input type="hidden" id="txtNombrePresentacionHidden" name="txtNombrePresentacionHidden" value="{{{$nombrePresentacion}}}">
        <input type="hidden" id="txtCodigoUnidadMedidaHidden" name="txtCodigoUnidadMedidaHidden" value="{{{$codigoUnidadMedida}}}">
        <input type="hidden" id="txtNombreUnidadMedidaHidden" name="txtNombreUnidadMedidaHidden" value="{{{$nombreUnidadMedida}}}">
        <input type="hidden" id="txtTipoHidden" name="txtTipoHidden" value="{{{$tipo}}}">

        <label for="txtCodigoBarras">Codigo de barras</label>
        <input type="text" id="txtCodigoBarras" name="txtCodigoBarras" size="50" value="{{{$codigoBarras}}}">
        <br>
        <label for="txtPrimerNombre">Primer nombre</label>
        <input type="text" id="txtPrimerNombre" name="txtPrimerNombre" size="50" placeholder="Obligatorio" value="{{{$primerNombre}}}">
        <br>
        <label for="txtSegundoNombre">Segundo nombre</label>
        <input type="text" id="txtSegundoNombre" name="txtSegundoNombre" size="50" value="{{{$segundoNombre}}}">
        <br>
        <label for="txtTercerNombre">Tercer nombre</label>
        <input type="text" id="txtTercerNombre" name="txtTercerNombre" size="50" value="{{{$tercerNombre}}}">
        <br>
        <label for="cbxCodigoPresentacion">Presentación</label>
        <select name="cbxCodigoPresentacion" id="cbxCodigoPresentacion">
            @foreach($listaTPresentacion as $item) 
                <option value="{{{$item->codigoPresentacion}}}" {{{(($codigoPresentacion)==($item->codigoPresentacion)) ? 'selected' : ''}}}>{{{$item->nombre}}}</option>
            @endforeach
        </select>
        <br>
        <label for="cbxCodigoUnidadMedida">Unidad de medida</label>
        <select name="cbxCodigoUnidadMedida" id="cbxCodigoUnidadMedida">
            @foreach($listaTUnidadMedida as $item) 
                <option value="{{{$item->codigoUnidadMedida}}}" {{{(($codigoUnidadMedida)==($item->codigoUnidadMedida)) ? 'selected' : ''}}}>{{{$item->nombre}}}</option>
            @endforeach
        </select>
        <br>
        <label for="cbxTipo">Tipo</label>
        <select name="cbxTipo" id="cbxTipo">
            <option value="Genérico" {{{($tipo)=='Genérico' ? "selected" : ''}}}>Genérico</option>
            <option value="Comercial" {{{($tipo)=='Comercial' ? "selected" : ''}}}>Comercial</option>
        </select>
        <br>
        <label>Permitir ventas menor a su unidad</label>
        <div class="contenidoTop">
            <input type="radio" id="radioSi" name="radioVentaMenorUnidadProducto" value="Si" {{{($ventaMenorUnidad) ? "checked='checked'" : ''}}}>
            <label class="noLabel" for="radioSi">Si</label>
            <br>
            <input type="radio" id="radioNo" name="radioVentaMenorUnidadProducto" value="No" {{{!($ventaMenorUnidad) ? "checked='checked'" : ''}}}>
            <label class="noLabel" for="radioNo">No</label>
        </div>
        <br>
        <label for="txtUnidadesBloque">Unidades por bloque</label>
        <input type="text" id="txtUnidadesBloque" name="txtUnidadesBloque" size="50" placeholder="Obligatorio" value="{{{$unidadesBloque}}}">
        <br>
        <label for="txtUnidadMedidaBloque">Unidad de medida por bloque</label>
        <input type="text" id="txtUnidadMedidaBloque" name="txtUnidadMedidaBloque" size="50" value="{{{$unidadMedidaBloque}}}">
        <br>
        <label for="cbxEstado">Estado</label>
        <select name="cbxEstado" id="cbxEstado">
            <option value="Habilitado" {{{$estado ? "selected" : ''}}}>Habilitado</option>
            <option value="Deshabilitado" {{{!$estado ? "selected" : ''}}}>Deshabilitado</option>
        </select>
    </div>
    <div class="seccionBotones bordeArriba">
        <input type="button" value="Guardar cambios" onclick="enviarFrmEditarAlmacenProducto();">
    </div>
</form>
<script>
    function enviarFrmEditarAlmacenProducto()
    {
        var mensajeGlobal='';
            
        mensajeGlobal+=(!valVacio($('#txtPrimerNombre').val())?'Complete el campo Primer nombre<br>':'');
        mensajeGlobal+=(!valVacio($('#txtUnidadesBloque').val())?'Complete el campo Unidades por bloque<br>':'');

        if(mensajeGlobal!='')
        {
            animacionAlertaMensajeGeneral(mensajeGlobal, 'red');
            return;
        }

        if(confirm('Realmente desea editar los datos del Producto'))
        {       
            $('#frmEditarAlmacenProducto').submit();
            return;
        }
        alert('Operación Cancelada');
    }
</script>