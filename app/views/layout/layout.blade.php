<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>ACEROS PERUANOS</title>
    
    <link rel="stylesheet" href="/APPSIVAK/public/css/normalize.css">
    <link rel="stylesheet" href="/APPSIVAK/public/css/jquery-ui.min.css">
    <link rel="stylesheet" href="/APPSIVAK/public/css/cssLayout.css">
    <link rel="stylesheet" href="/APPSIVAK/public/css/cssContenido.css">
    <link rel="stylesheet" href="/APPSIVAK/public/css/cssMenuPrincipal.css">
    <link rel="stylesheet" href="/APPSIVAK/public/css/cssFormulario.css">
    <link rel="stylesheet" href="/APPSIVAK/public/css/cssComponentes.css">
    <link rel="stylesheet" href="/APPSIVAK/public/css/cssLoading.css">
    <link rel="stylesheet" href="/APPSIVAK/public/css/cssPaginaDragAndDrop.css">

    <script src="/APPSIVAK/public/js/prefixfree.min.js"></script>
    <script src="/APPSIVAK/public/js/jquery-2.0.3.min.js"></script>
    <script src="/APPSIVAK/public/js/jquery-ui.min.js"></script>
    <script src="/APPSIVAK/public/js/jsValidacion.js"></script>
    <script src="/APPSIVAK/public/js/jsAjax.js"></script>
    <script src="/APPSIVAK/public/js/jsAnimaciones.js"></script>
    <script src="/APPSIVAK/public/js/jsBuscar.js"></script>
    <script src="/APPSIVAK/public/js/jsAcciones.js"></script>
    <script src="/APPSIVAK/public/js/jsControles.js"></script>
    <script src="/APPSIVAK/public/js/jsEstiloCheckCircular.js"></script>
    <script src="/APPSIVAK/public/js/jquery.chromatable.js"></script>
</head>
<body>
    <header id="cabeceraLayout">
        <div id="divTituloLayout" class="contenidoTop">
                <img src="/APPSIVAK/public/img/logoaceros.png" class="contenidoMiddle">
                <h1 class="contenidoMiddle" style="font-size: 20px;">
                    <a href="/APPSIVAK/public/otros/alerta" style="color: black;text-decoration: none;">
                        CORPORACIÓN ACEROS PERUANOS SAC
                    </a>
                </h1>
                <span style="font-wight: normal;font-size: 17px;text-shadow: 0px 0px 2px rgba(0, 0, 0, 0.3);vertical-align: middle;">| LOCAL: {{{mb_strtoupper(explode(',', Session::get('local'))[1], 'utf-8')}}}</span>
        </div>
        <div id="divAppLogin">
            <label>Usuario: </label>
            <input type="hidden" id="sesionCodigoPersonal" name="sesionCodigoPersonal" value="{{{substr(Session::get('usuario'), 0, 15)}}}">
            {{{substr(Session::get('usuario'), 16)}}}
            |
            <a href="/APPSIVAK/public/usuario/cerrarsesion">Cerrar sesión</a>
            <br>
            <label>Rol: </label>
            {{{Session::get('rol')}}}
            <br>
            <label>Local: </label>
            <input type="hidden" id="sesionCodigoLocal" name="sesionCodigoLocal" value="{{{substr(Session::get('local'), 0, 15)}}}">
            {{{substr(Session::get('local'), 16)}}}
            <br>
            <label>Fecha actual: </label>
            {{{date('d-m-Y')}}}
        </div>
        <section id="contenedorMenuPrincipal">
            <nav id="menuPrincipal">
                <ul>
                    @if(strlen(strpos(Session::get('rol'), 'Administrador'))>0)
                    <li><a href="#">
                            <div class="contenidoMiddle iconoMenuPrincipal" style="background-image: url('/APPSIVAK/public/img/iconos/menuprincipal/sucursales.png');background-size: 22px 22px;height: 22px;width: 22px;"></div>
                            <div class="contenidoMiddle textAlignLeft" style="margin: 0px;width: 84px;">Gestionar sucursales</div>
                        </a>
                        <ul>
                            <li>
                                <a href="#">Oficina (Tienda)</a>
                                <ul>
                                    @if(explode(',', Session::get('usuario'))[0]=='PERSONAL0000001' && strlen(strpos(Session::get('rol'), 'Administrador'))>0)
                                    <li>
                                        <a href="/APPSIVAK/public/oficina/insertar">Registrar oficina</a>
                                    </li>
                                    @endif
                                    <li>
                                        <a href="/APPSIVAK/public/oficina/ver">Listar oficinas (Operaciones)</a>
                                    </li>
                                </ul>
                            </li><li>
                                <a href="#">Almacén</a>
                                <ul>
                                    @if(explode(',', Session::get('usuario'))[0]=='PERSONAL0000001' && strlen(strpos(Session::get('rol'), 'Administrador'))>0)
                                    <li>
                                        <a href="/APPSIVAK/public/almacen/insertar">Registrar almacén</a>
                                    </li>
                                    @endif
                                    <li>
                                        <a href="/APPSIVAK/public/almacen/ver">Listar almacén (Operaciones)</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    @endif
                    @if(strlen(strpos(Session::get('rol'), 'Administrador'))>0)
                    <li><a href="#">
                                <div class="contenidoMiddle iconoMenuPrincipal" style="background-image: url('/APPSIVAK/public/img/iconos/menuprincipal/personal.png');background-size: 22px 22px;height: 22px;width: 22px;"></div>
                                <div class="contenidoMiddle textAlignLeft" style="margin: 0px;width: 84px;">Gestionar personal</div>
                            </a>
                        <ul>
                            <li>
                                <a href="/APPSIVAK/public/personal/insertar">Registrar personal</a>
                            </li><li>
                                <a href="/APPSIVAK/public/personal/ver">Listar personal (Operaciones)</a>
                            </li><li>
                                <a href="/APPSIVAK/public/usuario/insertar">Asignar usuario a personal</a>
                            </li><li>
                                <a href="/APPSIVAK/public/usuario/ver">Listar usuarios asignados (Operaciones)</a>
                            </li>
                        </ul>
                    </li>
                    @endif
                    @if(Session::get('localAcceso')=='Almacén')
                    @if(strlen(strpos(Session::get('rol'), 'Almacenero'))>0)
                    <li><a href="#">
                                <div class="contenidoMiddle iconoMenuPrincipal" style="background-image: url('/APPSIVAK/public/img/iconos/menuprincipal/proveedores.png');background-size: 22px 22px;height: 22px;width: 22px;"></div>
                                <div class="contenidoMiddle textAlignLeft" style="margin: 0px;width: 84px;">Gestionar proveedores</div>
                            </a>
                        <ul>
                            <li>
                                <a href="/APPSIVAK/public/proveedor/insertar">Registrar proveedor</a>
                            </li><li>
                                <a href="/APPSIVAK/public/proveedorproducto/insertar">Registrar productos que ofrece un proveedor</a>
                            </li><li>
                                <a href="/APPSIVAK/public/proveedorpuntoventa/insertar">Registrar puntos de venta de un proveedor</a>
                            </li><li>
                                <a href="/APPSIVAK/public/proveedor/ver">Listar proveedores (Operaciones)</a>
                            </li>
                        </ul>
                    </li>
                    @endif
                    @endif
                    @if(Session::get('localAcceso')=='Oficina')
                    @if(strlen(strpos(Session::get('rol'), 'Ventas'))>0)
                    <li><a href="#">
                                <div class="contenidoMiddle iconoMenuPrincipal" style="background-image: url('/APPSIVAK/public/img/iconos/menuprincipal/clientes.png');background-size: 22px 22px;height: 22px;width: 22px;"></div>
                                <div class="contenidoMiddle textAlignLeft" style="margin: 0px;width: 84px;">Gestionar clientes</div>
                            </a>
                        <ul>
                            <li>
                                <a href="#">Cliente natural</a>
                                <ul>
                                    <li>
                                        <a href="/APPSIVAK/public/clientenatural/insertar">Registrar cliente natural</a>
                                    </li><li>
                                        <a href="/APPSIVAK/public/clientenatural/ver">Listar clientes naturales (Operaciones)</a>
                                    </li>
                                </ul>
                            </li><li>
                                <a href="#">Cliente Jurídico</a>
                                <ul>
                                    <li>
                                        <a href="/APPSIVAK/public/clientejuridico/insertar">Registrar cliente jurídico</a>
                                    </li><li>
                                        <a href="/APPSIVAK/public/clientejuridicorepresentante/insertar">Registrar representantes jurídico</a>
                                    </li><li>
                                        <a href="/APPSIVAK/public/clientejuridico/ver">Listar clientes jurídicos (Operaciones)</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    @endif
                    @endif
                    @if(Session::get('localAcceso')=='Almacén')
                    @if(strlen(strpos(Session::get('rol'), 'Almacenero'))>0)
                    <li><a href="#">
                                <div class="contenidoMiddle iconoMenuPrincipal" style="background-image: url('/APPSIVAK/public/img/iconos/menuprincipal/productos.png');background-size: 22px 22px;height: 22px;width: 22px;"></div>
                                <div class="contenidoMiddle textAlignLeft" style="margin: 0px;width: 84px;">Gestionar productos de almacén</div>
                            </a>
                        <ul>
                            <li>
                                <a href="#">Categoría para productos</a>
                                <ul>
                                    <li>
                                        <a href="/APPSIVAK/public/categoria/insertar">Registrar categoría</a>
                                    </li><li>
                                        <a href="/APPSIVAK/public/categoria/vercategoriapadre">Listar categorías (Operaciones)</a>
                                    </li>
                                </ul>
                            </li><li>
                                <a href="#">Presentación para productos</a>
                                <ul>
                                    <li>
                                        <a href="/APPSIVAK/public/presentacion/insertar">Registrar presentación</a>
                                    </li><li>
                                        <a href="/APPSIVAK/public/presentacion/ver">Listar presentación (Operaciones)</a>
                                    </li>
                                </ul>
                            </li><li>
                                <a href="#">Unidad de medida para productos</a>
                                <ul>
                                    <li>
                                        <a href="/APPSIVAK/public/unidadmedida/insertar">Registrar unidad de medida</a>
                                    </li><li>
                                        <a href="/APPSIVAK/public/unidadmedida/ver">Listar unidad de medida (Operaciones)</a>
                                    </li>
                                </ul>
                            </li><li>
                                <a href="#">OPERACIONES PARA PRODUCTOS</a>
                                <ul>
                                    <li>
                                        <a href="/APPSIVAK/public/recibocompra/insertar">COMPRAR PRODUCTOS PARA ALMACÉN</a>
                                    </li>
                                    <li>
                                        <a href="/APPSIVAK/public/almacenproductoretiro/insertar">Retirar productos de almacén</a>
                                    </li>
                                    <li>
                                        <a href="/APPSIVAK/public/almacenproductoretiro/verporcodigoalmacen">Listar productos retirados de este almacén</a>
                                    </li>
                                    <li>
                                        <a href="/APPSIVAK/public/almacenproducto/vertodoagrupado">Listar todos los productos (Operaciones)</a>
                                    </li>
                                    <li>
                                        <a href="/APPSIVAK/public/almacenproducto/verporcodigoalmacen">Listar productos de este almacén (Operaciones)</a>
                                    </li>
                                </ul>
                            </li><li>
                                <a href="/APPSIVAK/public/recibocompra/verentrefechas/{{{date('Y-m-d')}}}/{{{date('Y-m-d', strtotime(date('Y-m-d').' +1 day'))}}}">Listar compra de productos entre dos fechas (Operaciones)</a>
                            </li><li>
                                <a href="/APPSIVAK/public/recibocompra/verportipopago">Listar compras al crédito (Operaciones)</a>
                            </li>
                        </ul>
                    </li>
                    @endif
                    @endif
                    @if(Session::get('localAcceso')=='Oficina')
                    @if(strlen(strpos(Session::get('rol'), 'Ventas'))>0)
                    <li><a href="#">
                                <div class="contenidoMiddle iconoMenuPrincipal" style="background-image: url('/APPSIVAK/public/img/iconos/menuprincipal/productos.png');background-size: 22px 22px;height: 22px;width: 22px;"></div>
                                <div class="contenidoMiddle textAlignLeft" style="margin: 0px;width: 84px;">Gestionar productos de oficina/tienda</div>
                            </a>
                        <ul>
                            <li>
                                <a href="/APPSIVAK/public/oficinaproductoretiro/insertar">Retirar productos de oficina/tienda</a>
                            </li>
                            <li>
                                <a href="/APPSIVAK/public/oficinaproductoretiro/verporcodigooficina">Listar productos retirados de esta oficina/tienda</a>
                            </li>
                            <li>
                                <a href="/APPSIVAK/public/oficinaproducto/verporcodigooficina">Listar productos de esta oficina/tienda (Operaciones)</a>
                            </li>
                        </ul>
                    </li>
                    @endif
                    @endif
                    @if(strlen(strpos(Session::get('rol'), 'Administrador'))>0 || strlen(strpos(Session::get('rol'), 'Almacenero'))>0)
                    <li><a href="#">
                                <div class="contenidoMiddle iconoMenuPrincipal" style="background-image: url('/APPSIVAK/public/img/iconos/menuprincipal/envioproductos.png');background-size: 22px 22px;height: 22px;width: 22px;"></div>
                                <div class="contenidoMiddle textAlignLeft" style="margin: 0px;width: 84px;">Gestionar traslado de productos</div>
                            </a>
                        <ul>
                            @if(strlen(strpos(Session::get('rol'), 'Almacenero'))>0)
                            <li>
                                <a href="/APPSIVAK/public/productoenviarstock/insertar">Enviar productos de almacén a oficina/tienda</a>
                            </li>
                            <li>
                                <a href="/APPSIVAK/public/productoenviarstock/verentrefechas/{{{date('Y-m-d')}}}/{{{date('Y-m-d', strtotime(date('Y-m-d').' +1 day'))}}}">Listar productos enviados de almacén a oficina/tienda entre dos fechas (Operaciones)</a>
                            </li>
                            @endif
                            @if(strlen(strpos(Session::get('rol'), 'Administrador'))>0)
                            <li>
                                <a href="/APPSIVAK/public/productotrasladooficina/insertar">Trasladar productos entre oficinas/tiendas</a>
                            </li>
                            <li>
                                <a href="/APPSIVAK/public/productotrasladooficina/verentrefechas/{{{date('Y-m-d')}}}/{{{date('Y-m-d', strtotime(date('Y-m-d').' +1 day'))}}}">Listar productos trasladados de oficinas/tiendas entre dos fechas (Operaciones)</a>
                            </li>
                            @endif
                        </ul>
                    </li>
                    @endif
                    @if(Session::get('localAcceso')=='Oficina')
                    @if(strlen(strpos(Session::get('rol'), 'Ventas'))>0)
                    <li><a href="#">
                                <div class="contenidoMiddle iconoMenuPrincipal" style="background-image: url('/APPSIVAK/public/img/iconos/menuprincipal/ventas.png');background-size: 22px 22px;height: 22px;width: 22px;"></div>
                                <div class="contenidoMiddle textAlignLeft" style="margin: 0px;width: 84px;">Gestionar ventas</div>
                            </a>
                        <ul>
                            <li>
                                <a href="/APPSIVAK/public/reciboventa/insertar">REALIZAR VENTAS</a>
                            </li><li>
                                <a href="/APPSIVAK/public/reciboventa/verentrefechas/{{{date('Y-m-d')}}}/{{{date('Y-m-d', strtotime(date('Y-m-d').' +1 day'))}}}">Listar ventas entre dos fechas (Operaciones)</a>
                            </li><li>
                                <a href="/APPSIVAK/public/reciboventa/verportipopago">Listar ventas al crédito (Operaciones)</a>
                            </li>
                        </ul>
                    </li>
                    @endif
                    @endif
                    @if(strlen(strpos(Session::get('rol'), 'Administrador'))>0)
                    <li><a href="#">
                                <div class="contenidoMiddle iconoMenuPrincipal" style="background-image: url('/APPSIVAK/public/img/iconos/menuprincipal/caja.png');background-size: 22px 22px;height: 22px;width: 22px;"></div>
                            <div class="contenidoMiddle textAlignLeft" style="margin: 0px;width: 84px;">Gestionar caja</div>
                            </a>
                        <ul>
                            <li>
                                <a href="/APPSIVAK/public/caja/insertar">Abrir caja</a>
                            </li><li>
                                <a href="/APPSIVAK/public/caja/ver">Listar cajas (Operaciones)</a>
                            </li><li>
                                <a href="/APPSIVAK/public/egreso/insertar">Registrar gasto</a>
                            </li><li>
                                <a href="/APPSIVAK/public/egreso/verentrefechas/{{{date('Y-m-d')}}}/{{{date('Y-m-d', strtotime(date('Y-m-d').' +1 day'))}}}">Listar gastos entre dos fechas</a>
                            </li>
                        </ul>
                    </li>
                    @endif
                    @if(strlen(strpos(Session::get('rol'), 'Administrador'))>0 || strlen(strpos(Session::get('rol'), 'Reportes'))>0)
                    <li><a href="/APPSIVAK/public/reporte/index">
                                <div class="contenidoMiddle iconoMenuPrincipal" style="background-image: url('/APPSIVAK/public/img/iconos/menuprincipal/reportes.png');background-size: 22px 22px;height: 22px;width: 22px;"></div>
                                <div class="contenidoMiddle textAlignLeft" style="margin: 0px;width: 84px;">Reportes</div>
                            </a>
                    </li>
                    @endif

                    @if(explode(',', Session::get('usuario'))[0]=='PERSONAL0000001' && strlen(strpos(Session::get('rol'), 'Administrador'))>0)
                    <li><a href="/APPSIVAK/public/otros/backup">
                                <div class="contenidoMiddle iconoMenuPrincipal" style="background-image: url('/APPSIVAK/public/img/iconos/menuprincipal/backup.png');background-size: 22px 22px;height: 22px;width: 22px;"></div>
                                <div class="contenidoMiddle textAlignLeft" style="margin: 0px;width: 84px;">Generar backup</div>
                            </a>
                    </li>
                    @endif
                </ul>
            </nav>
        </section>
    </header>

    <section id="cuerpoGeneralLayout">
        <div class="alertaMensajeGlobal"></div>
        <div id="divVerDetalle"></div>
        <div id="dialogo"></div>
        @if(isset($mensajeGlobal) && $mensajeGlobal!='')
            <script>animacionAlertaMensajeGeneral('{{$mensajeGlobal}}', '{{$color}}');</script>
        @endif
        @yield("contenidoCuerpo")
    </section>

    <footer id="pieLayout">
        <div class="textAlignRight">
            <strong>&copy; 2017 CORPORACIÓN ACEROS PERUANOS SAC</strong>
            |
            Teléfono: 043 423287
            |
            johncg24@gmail.com
        </div>
    </footer>
</body>
</html>