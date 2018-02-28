<hr>
<input type="button" class="anchoCompleto button" style="margin: 0px;" value="Cerrar detalle" onclick="cerrarDivVerDetalla();">
<hr>
<section class="contenidoTop">
    <div class="formulario labelMediano textAlignLeft">
        <div class="contenidoTop">
            <label><b>Dni</b></label>
            {{{$tPersonal->dni}}}
            <br>
            <label><b>Nombre</b></label>
            {{{$tPersonal->nombre}}}
            <br>
            <label><b>Apellido Paterno</b></label>
            {{{$tPersonal->apellidoPaterno}}}
            <br>
            <label><b>Apellido Materno</b></label>
            {{{$tPersonal->apellidoMaterno}}}
            <br>
            <label><b>Seguridad Social</b></label>
            {{{$tPersonal->seguridadSocial}}}
            <br>
            <label><b>País</b></label>
            {{{$tPersonal->pais}}}
            <br>
            <label><b>Departamento</b></label>
            {{{$tPersonal->departamento}}}
            <br>
            <label><b>Provincia</b></label>
            {{{$tPersonal->provincia}}}
            <br>
            <label><b>Distrito</b></label>
            {{{$tPersonal->distrito}}}
            <br>
            <label><b>Direción</b></label>
            {{{$tPersonal->direccion}}}
            <br>
            <label><b>Manzana</b></label>
            {{{$tPersonal->manzana}}}
            <br>
            <label><b>Lote</b></label>
            {{{$tPersonal->lote}}}
            <br>
            <label><b>Nº Vivienda</b></label>
            {{{$tPersonal->numeroVivienda}}}
            <br>
            <label><b>Nº Interior</b></label>
            {{{$tPersonal->numeroInterior}}}
            <br>
            <label><b>Teléfono</b></label>
            {{{$tPersonal->telefono}}}
            <br>
            <label><b>Estado Civil</b></label>
            {{{$tPersonal->estadoCivil=='S' ? 'Soltero' : 'Casado'}}}
            <br>
            <label><b>Sexo</b></label>
            {{{$tPersonal->sexo==0 ? 'Masculino' : 'Femenino'}}}
            <br>
            <label><b>Fecha de Nacimiento</b></label>
            {{{$tPersonal->fechaNacimiento}}}
            <br>
            <label><b>Correo</b></label>
            {{{$tPersonal->correo}}}
            <br>
            <label><b>Fecha de Registro</b></label>
            {{{$tPersonal->created_at}}}
            <br>
            <label><b>Grupo Sanguíneo</b></label>
            {{{$tPersonal->grupoSanguineo}}}
            <br>
            <label><b>Tipo de Empleado</b></label>
            {{{$tPersonal->tipoEmpleado}}}
            <br>
            <label><b>Cargo</b></label>
            {{{$tPersonal->cargo}}}
        </div>
    </div>
</section>