<?php
Route::any('otros/backup', 'OtrosController@actionBackup');

Route::any('/', 'UsuarioController@actionLogin');

Route::any('otros/alerta', 'OtrosController@actionAlerta');

//Ruteo OficinaController
Route::any('oficina/insertar', 'OficinaController@actionInsertar');
Route::any('oficina/ver', 'OficinaController@actionVer');
Route::post('oficina/verdetalle', 'OficinaController@actionVerDetalle');
Route::post('oficina/editar', 'OficinaController@actionEditar');
Route::post('oficina/buscaroficina', 'OficinaController@actionBuscarOficina');
Route::post('oficina/buscaroficinados', 'OficinaController@actionBuscarOficinaDos');
Route::any('oficina/administrarpersonal/{codigoOficina}', 'OficinaController@actionAdministrarPersonal');

//Ruteo AlmacenController
Route::any('almacen/insertar', 'AlmacenController@actionInsertar');
Route::any('almacen/ver', 'AlmacenController@actionVer');
Route::post('almacen/verdetalle', 'AlmacenController@actionVerDetalle');
Route::post('almacen/editar', 'AlmacenController@actionEditar');
Route::post('almacen/buscaralmacen', 'AlmacenController@actionBuscarAlmacen');
Route::any('almacen/administrarpersonal/{codigoAlmacen}', 'AlmacenController@actionAdministrarPersonal');

//Ruteo PersonalController
Route::any('personal/insertar', 'PersonalController@actionInsertar');
Route::any('personal/ver', 'PersonalController@actionVer');
Route::post('personal/verdetalle', 'PersonalController@actionVerDetalle');
Route::post('personal/editar', 'PersonalController@actionEditar');
Route::post('personal/buscarpersonal', 'PersonalController@actionBuscarPersonal');

//Ruteo UsuarioController
Route::any('/', 'UsuarioController@actionLogin');
Route::any('usuario/cerrarsesion', 'UsuarioController@actionCerrarSesion');
Route::any('usuario/insertar', 'UsuarioController@actionInsertar');
Route::any('usuario/ver', 'UsuarioController@actionVer');
Route::post('usuario/editar', 'UsuarioController@actionEditar');
Route::post('usuario/comprobarcontrasenia', 'UsuarioController@actionComprobarContrasenia');
Route::post('usuario/gestionarroles', 'UsuarioController@actionGestionarRoles');
Route::get('usuario/enviarcontraseniacorreo/{codigoPersonal}', 'UsuarioController@actionEnviarContraseniaCorreo');

//Ruteo ProveedorController
Route::any('proveedor/insertar', 'ProveedorController@actionInsertar');
Route::any('proveedor/ver', 'ProveedorController@actionVer');
Route::post('proveedor/editar', 'ProveedorController@actionEditar');
Route::post('proveedor/buscarproveedor', 'ProveedorController@actionBuscarProveedor');

//Ruteo ProveedorPuntoVentaController
Route::any('proveedorpuntoventa/insertar', 'ProveedorPuntoVentaController@actionInsertar');
Route::post('proveedorpuntoventa/verporcodigoproveedor', 'ProveedorPuntoVentaController@actionVerPorCodigoProveedor');
Route::post('proveedorpuntoventa/verdetalle', 'ProveedorPuntoVentaController@actionVerDetalle');
Route::post('proveedorpuntoventa/editar', 'ProveedorPuntoVentaController@actionEditar');

//Ruteo ProveedorProductoController
Route::any('proveedorproducto/insertar', 'ProveedorProductoController@actionInsertar');
Route::post('proveedorproducto/verporcodigoproveedor', 'ProveedorProductoController@actionVerPorCodigoProveedor');
Route::post('proveedorproducto/editar', 'ProveedorProductoController@actionEditar');

//Ruteo ClienteNaturalController
Route::any('clientenatural/insertar', 'ClienteNaturalController@actionInsertar');
Route::any('clientenatural/ver', 'ClienteNaturalController@actionVer');
Route::post('clientenatural/verdetalle', 'ClienteNaturalController@actionVerDetalle');
Route::post('clientenatural/editar', 'ClienteNaturalController@actionEditar');
Route::post('clientenatural/listabuscarclientenaturalpordninombreapellidopaternoapellidomaterno', 'ClienteNaturalController@actionListaBuscarClienteNaturalPorDniNombreApellidoPaternoApellidoMaterno');

//Ruteo ClienteJuridicoController
Route::any('clientejuridico/insertar', 'ClienteJuridicoController@actionInsertar');
Route::any('clientejuridico/ver', 'ClienteJuridicoController@actionVer');
Route::post('clientejuridico/verdetalle', 'ClienteJuridicoController@actionVerDetalle');
Route::post('clientejuridico/editar', 'ClienteJuridicoController@actionEditar');
Route::post('clientejuridico/listabuscarclientejuridicoporrucrazonsociallarga', 'ClienteJuridicoController@actionListaBuscarClienteJuridicoPorRucRazonSocialLarga');

//Ruteo ClienteJuridicoRepresentanteController
Route::any('clientejuridicorepresentante/insertar', 'ClienteJuridicoRepresentanteController@actionInsertar');
Route::post('clientejuridicorepresentante/verporcodigoclientejuridico', 'ClienteJuridicoRepresentanteController@actionVerPorCodigoClienteJuridico');
Route::post('clientejuridicorepresentante/editar', 'ClienteJuridicoRepresentanteController@actionEditar');

//Ruteo CategoriaController
Route::any('categoria/insertar', 'CategoriaController@actionInsertar');
Route::any('categoria/vercategoriapadre', 'CategoriaController@actionVerCategoriaPadre');
Route::post('categoria/verporcodigocategoriapadre', 'CategoriaController@actionVerPorCodigoCategoriaPadre');
Route::post('categoria/editar', 'CategoriaController@actionEditar');
Route::post('categoria/buscarcategoriaporcodigocategoriapadre', 'CategoriaController@actionBuscarCategoriaPorCodigoCategoriaPadre');

//Ruteo PresentacionController
Route::any('presentacion/insertar', 'PresentacionController@actionInsertar');
Route::any('presentacion/ver', 'PresentacionController@actionVer');
Route::post('presentacion/editar', 'PresentacionController@actionEditar');
Route::post('presentacion/insertarconajax', 'PresentacionController@actionInsertarConAjax');

//Ruteo UnidadMedidaController
Route::any('unidadmedida/insertar', 'UnidadMedidaController@actionInsertar');
Route::any('unidadmedida/ver', 'UnidadMedidaController@actionVer');
Route::post('unidadmedida/editar', 'UnidadMedidaController@actionEditar');
Route::post('unidadmedida/insertarconajax', 'UnidadMedidaController@actionInsertarConAjax');

//Ruteo ReciboCompraController
Route::any('recibocompra/insertar', 'ReciboCompraController@actionInsertar');
Route::any('recibocompra/verentrefechas/{fechaInicial}/{fechaFinal}', 'ReciboCompraController@actionVerEntreFechas');
Route::post('recibocompra/anular', 'ReciboCompraController@actionAnular');
Route::any('recibocompra/verportipopago/{tipoPago?}', 'ReciboCompraController@actionVerPorTipoPago');
Route::post('recibocompra/editar', 'ReciboCompraController@actionEditar');

//Ruteo ReciboCompraDetalleController
Route::post('recibocompradetalle/verporcodigorecibocompra', 'ReciboCompraDetalleController@actionVerPorCodigoReciboCompra');

//Ruteo ReciboCompraPagoController
Route::post('recibocomprapago/insertar', 'ReciboCompraPagoController@actionInsertar');
Route::post('recibocomprapago/verporcodigorecibocompra', 'ReciboCompraPagoController@actionVerPorCodigoReciboCompra');

//Ruteo AlmacenProductoController
Route::post('almacenproducto/listabuscaralmacenproductoagrupadopornombre', 'AlmacenProductoController@actionListaBuscarAlmacenProductoAgrupadoPorNombre');
Route::post('almacenproducto/listabuscaralmacenproductoporcodigoalmacennombre', 'AlmacenProductoController@actionListaBuscarAlmacenProductoPorCodigoAlmacenNombre');
Route::post('almacenproducto/listabuscaralmacenproductoporcodigobarras', 'AlmacenProductoController@actionListaBuscarAlmacenProductoPorCodigoBarras');
Route::any('almacenproducto/vertodoagrupado', 'AlmacenProductoController@actionVerTodoAgrupado');
Route::any('almacenproducto/verporcodigoalmacen', 'AlmacenProductoController@actionVerPorCodigoAlmacen');
Route::post('almacenproducto/editartodoslocales', 'AlmacenProductoController@actionEditarTodosLocales');
Route::post('almacenproducto/editar', 'AlmacenProductoController@actionEditar');
Route::any('almacenproducto/administrarcategoria/{codigoAlmacenProducto}', 'AlmacenProductoController@actionAdministrarCategoria');
Route::get('almacenproducto/sincronizarcategorias', 'AlmacenProductoController@actionSincronizarCategorias');

//Ruteo AlmacenProductoRetiro
Route::any('almacenproductoretiro/insertar', 'AlmacenProductoRetiroController@actionInsertar');
Route::get('almacenproductoretiro/verporcodigoalmacen', 'AlmacenProductoRetiroController@actionVerPorCodigoAlmacen');

//Ruteo ProductoEnviarStockController
Route::any('productoenviarstock/insertar', 'ProductoEnviarStockController@actionInsertar');
Route::post('productoenviarstock/insertarconajax', 'ProductoEnviarStockController@actionInsertarConAjax');
Route::any('productoenviarstock/verentrefechas/{fechaInicial}/{fechaFinal}', 'ProductoEnviarStockController@actionVerEntreFechas');
Route::post('productoenviarstock/anular', 'ProductoEnviarStockController@actionAnular');

//Ruteo ProductoEnviarStockDetalleController
Route::post('productoenviarstockdetalle/verporcodigoproductoenviarstock', 'ProductoEnviarStockDetalleController@actionVerPorCodigoProductoEnviarStock');

//Ruteo ProductoTrasladoOficinaController
Route::any('productotrasladooficina/insertar', 'ProductoTrasladoOficinaController@actionInsertar');
Route::any('productotrasladooficina/verentrefechas/{fechaInicial}/{fechaFinal}', 'ProductoTrasladoOficinaController@actionVerEntreFechas');
Route::post('productotrasladooficina/anular', 'ProductoTrasladoOficinaController@actionAnular');

//Ruteo ProductoTrasladoOficinaDetalleController
Route::post('productotrasladooficinadetalle/verporcodigoproductotrasladooficina', 'ProductoTrasladoOficinaDetalleController@actionVerPorCodigoProductoTrasladoOficina');

//Ruteo OficinaProductoController
Route::post('oficinaproducto/listabuscaroficinaproductoporcodigooficinanombre', 'OficinaProductoController@actionListaBuscarOficinaProductoPorCodigoOficinaNombre');
Route::post('oficinaproducto/listabuscaroficinaproductoporcodigobarras', 'OficinaProductoController@actionListaBuscarOficinaProductoPorCodigoBarras');
Route::any('oficinaproducto/verporcodigooficina', 'OficinaProductoController@actionVerPorCodigoOficina');
Route::post('oficinaproducto/editar', 'OficinaProductoController@actionEditar');

//Ruteo OficinaProductoRetiro
Route::any('oficinaproductoretiro/insertar', 'OficinaProductoRetiroController@actionInsertar');
Route::get('oficinaproductoretiro/verporcodigooficina', 'OficinaProductoRetiroController@actionVerPorCodigoOficina');

//Ruteo ReciboVentaController
Route::any('reciboventa/insertar', 'ReciboVentaController@actionInsertar');
Route::any('reciboventa/verentrefechas/{fechaInicial}/{fechaFinal}', 'ReciboVentaController@actionVerEntreFechas');
Route::post('reciboventa/anular', 'ReciboVentaController@actionAnular');
Route::any('reciboventa/verportipopago/{tipoPago?}', 'ReciboVentaController@actionVerPorTipoPago');
Route::any('reciboventa/editar', 'ReciboVentaController@actionEditar');

//Ruteo ReciboVentaDetalleController
Route::post('reciboventadetalle/verporcodigoreciboventa', 'ReciboVentaDetalleController@actionVerPorCodigoReciboVenta');

//Ruteo ReciboVentaLetraController
Route::post('reciboventaletra/verporcodigoreciboventa', 'ReciboVentaLetraController@actionVerPorCodigoReciboVenta');
Route::post('reciboventaletra/pagarletra', 'ReciboVentaLetraController@actionPagarLetra');

//Ruteo ReciboVentaPagoController
Route::post('reciboventapago/insertar', 'ReciboVentaPagoController@actionInsertar');
Route::post('reciboventapago/verporcodigoreciboventa', 'ReciboVentaPagoController@actionVerPorCodigoReciboVenta');

//Ruteo CajaController
Route::any('caja/insertar', 'CajaController@actionInsertar');
Route::any('caja/ver', 'CajaController@actionVer');

//Ruteo CajaDetalleController
Route::any('cajadetalle/insertar', 'CajaDetalleController@actionInsertar');
Route::post('cajadetalle/verporcodigocaja', 'CajaDetalleController@actionVerPorCodigoCaja');
Route::post('cajadetalle/incrementarsaldoinicial', 'CajaDetalleController@actionIncrementarSaldoInicial');
Route::post('cajadetalle/cerrar', 'CajaDetalleController@actionCerrar');
Route::get('cajadetalle/reabrir/{codigoCajaDetalle}', 'CajaDetalleController@actionReabrir');

//Ruteo EgresoController
Route::any('egreso/insertar', 'EgresoController@actionInsertar');
Route::get('egreso/verentrefechas/{fechaInicial}/{fechaFinal}', 'EgresoController@actionVerEntreFechas');

//Ruteo ReporteController
Route::get('reporte/index', 'ReporteController@actionIndex');
Route::any('reporte/ticket/{codigoReciboVenta}', 'ReporteController@actionTicket');
Route::any('reporte/recibo/{codigoReciboVenta}', 'ReporteController@actionRecibo');
Route::any('reporte/notacredito/{codigoReciboVenta}', 'ReporteController@actionNotaCredito');
Route::any('reporte/reciboventapago/{codigoReciboVentaPago}', 'ReporteController@actionReciboVentaPago');
Route::any('reporte/boleta/{codigoReciboVenta}', 'ReporteController@actionBoleta');
Route::any('reporte/factura/{codigoReciboVenta}', 'ReporteController@actionFactura');
Route::any('reporte/guiaremisionventa/{codigoReciboVenta}', 'ReporteController@actionGuiaRemisionVenta');
Route::any('reporte/guiaremisionenvioproductoalmacenoficina/{codigoProductoEnviarStock}', 'ReporteController@actionGuiaRemisionEnvioProductoAlmacenOficina');
Route::any('reporte/guiaremisiontrasladoproductooficina/{codigoProductoTrasladoOficina}', 'ReporteController@actionGuiaRemisionTrasladoProductoOficina');
Route::any('reporte/proforma', 'ReporteController@actionProforma');
Route::any('reporte/productosagotadosporagotarsestock', 'ReporteController@actionProductosAgotadosPorAgotarseStock');
Route::any('reporte/productosagotadosporagotarsealmacen', 'ReporteController@actionProductosAgotadosPorAgotarseAlmacen');
Route::any('reporte/productosporvencersestock', 'ReporteController@actionProductosPorVencerseStock');
Route::any('reporte/productosporvencersealmacen', 'ReporteController@actionProductosPorVencerseAlmacen');
Route::any('reporte/comprasporpagar', 'ReporteController@actionComprasPorPagar');
Route::any('reporte/ventasporcobrarpagos', 'ReporteController@actionVentasPorCobrarPagos');
Route::any('reporte/ventasporcobrarletras', 'ReporteController@actionVentasPorCobrarLetras');
Route::any('reporte/productosporcodigooficina/{codigoOficina?}', 'ReporteController@actionProductosPorCodigoOficina');
Route::any('reporte/productosporcodigoalmacen/{codigoAlmacen?}', 'ReporteController@actionProductosPorCodigoAlmacen');
Route::any('reporte/compraentrefechas/{fechaInicial?}/{fechaFinal?}', 'ReporteController@actionCompraEntreFechas');
Route::any('reporte/compraentrefechasporcodigoalmacen/{codigoAlmacen?}/{fechaInicial?}/{fechaFinal?}', 'ReporteController@actionCompraEntreFechasPorCodigoAlmacen');
Route::any('reporte/compraporreciboemitidoentrefechas/{fechaInicial?}/{fechaFinal?}/{tipoRecibo?}', 'ReporteController@actionCompraPorReciboEmitidoEntreFechas');
Route::any('reporte/compraporreciboemitidoentrefechasporcodigoalmacen/{codigoAlmacen?}/{fechaInicial?}/{fechaFinal?}/{tipoRecibo?}', 'ReporteController@actionCompraPorReciboEmitidoEntreFechasPorCodigoAlmacen');
Route::any('reporte/ventaentrefechas/{fechaInicial?}/{fechaFinal?}', 'ReporteController@actionVentaEntreFechas');
Route::any('reporte/ventaentrefechasporcodigooficina/{codigoOficina?}/{fechaInicial?}/{fechaFinal?}', 'ReporteController@actionVentaEntreFechasPorCodigoOficina');
Route::any('reporte/ventaentrefechasportiporecibo/{fechaInicial?}/{fechaFinal?}/{tipoRecibo?}', 'ReporteController@actionVentaEntreFechasPorTipoRecibo');
Route::any('reporte/ventaentrefechasporcodigooficinatiporecibo/{codigoOficina?}/{fechaInicial?}/{fechaFinal?}/{tipoRecibo?}', 'ReporteController@actionVentaEntreFechasPorCodigoOficinaTipoRecibo');
Route::any('reporte/envioproductosalmacenoficinaentrefechas/{fechaInicial?}/{fechaFinal?}', 'ReporteController@actionEnvioProductosAlmacenOficinaEntreFechas');
Route::any('reporte/productotrasladooficinaentrefechas/{fechaInicial?}/{fechaFinal?}', 'ReporteController@actionProductoTrasladoOficinaEntreFechas');
Route::any('reporte/productosretiradosoficina', 'ReporteController@actionProductosRetiradosOficina');
Route::any('reporte/productosretiradosalmacen', 'ReporteController@actionProductosRetiradosAlmacen');
Route::any('reporte/gastoentrefechas/{fechaInicial?}/{fechaFinal?}', 'ReporteController@actionGastoEntreFechas');
Route::any('reporte/cajaentrefechas/{fechaInicial?}/{fechaFinal?}', 'ReporteController@actionCajaEntreFechas');