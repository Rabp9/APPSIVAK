<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	$url=explode('/', Request::url());
    $url=$url[0].'//'.$url[1].$url[2].'/APPSIVAK/public';

	$accesoUrl=false;

	$permisosUrl=
	[
		['Administrador', '', $url.'/otros/backup'],
		['Público,Administrador,Almacenero,Ventas,Reportes', '', $url.''],
		['Administrador,Almacenero,Ventas,Reportes', '', $url.'/otros/alerta'],
		['Administrador', '', $url.'/oficina/insertar'],
		['Administrador', '', $url.'/oficina/ver'],
		['Administrador', '', $url.'/oficina/verdetalle'],
		['Administrador', '', $url.'/oficina/editar'],
		['Administrador,Almacenero,Ventas', '', $url.'/oficina/buscaroficina'],
		['Administrador,Almacenero,Ventas', '', $url.'/oficina/buscaroficinados'],
		['Administrador', 'param', $url.'/oficina/administrarpersonal'],
		['Administrador', '', $url.'/almacen/insertar'],
		['Administrador', '', $url.'/almacen/ver'],
		['Administrador', '', $url.'/almacen/verdetalle'],
		['Administrador', '', $url.'/almacen/editar'],
		['Administrador,Almacenero', '', $url.'/almacen/buscaralmacen'],
		['Administrador', 'param', $url.'/almacen/administrarpersonal'],
		['Administrador', '', $url.'/personal/insertar'],
		['Administrador', '', $url.'/personal/ver'],
		['Administrador', '', $url.'/personal/verdetalle'],
		['Administrador', '', $url.'/personal/editar'],
		['Administrador', '', $url.'/personal/buscarpersonal'],
		['Administrador,Almacenero,Ventas,Reportes', '', $url.'/usuario/cerrarsesion'],
		['Administrador', '', $url.'/usuario/insertar'],
		['Administrador', '', $url.'/usuario/ver'],
		['Administrador', '', $url.'/usuario/editar'],
		['Administrador', '', $url.'/usuario/comprobarcontrasenia'],
		['Administrador', '', $url.'/usuario/gestionarroles'],
		['Administrador', 'param', $url.'/usuario/enviarcontraseniacorreo'],
		['Almacenero', '', $url.'/proveedor/insertar'],
		['Almacenero', '', $url.'/proveedor/ver'],
		['Almacenero', '', $url.'/proveedor/editar'],
		['Almacenero', '', $url.'/proveedor/buscarproveedor'],
		['Almacenero', '', $url.'/proveedorpuntoventa/insertar'],
		['Almacenero', '', $url.'/proveedorpuntoventa/verporcodigoproveedor'],
		['Almacenero', '', $url.'/proveedorpuntoventa/verdetalle'],
		['Almacenero', '', $url.'/proveedorpuntoventa/editar'],
		['Almacenero', '', $url.'/proveedorproducto/insertar'],
		['Almacenero', '', $url.'/proveedorproducto/verporcodigoproveedor'],
		['Almacenero', '', $url.'/proveedorproducto/editar'],
		['Ventas', '', $url.'/clientenatural/insertar'],
		['Ventas', '', $url.'/clientenatural/ver'],
		['Ventas', '', $url.'/clientenatural/verdetalle'],
		['Ventas', '', $url.'/clientenatural/editar'],
		['Ventas', '', $url.'/clientenatural/listabuscarclientenaturalpordninombreapellidopaternoapellidomaterno'],
		['Ventas', '', $url.'/clientejuridico/insertar'],
		['Ventas', '', $url.'/clientejuridico/ver'],
		['Ventas', '', $url.'/clientejuridico/verdetalle'],
		['Ventas', '', $url.'/clientejuridico/editar'],
		['Ventas', '', $url.'/clientejuridico/listabuscarclientejuridicoporrucrazonsociallarga'],
		['Ventas', '', $url.'/clientejuridicorepresentante/insertar'],
		['Ventas', '', $url.'/clientejuridicorepresentante/verporcodigoclientejuridico'],
		['Ventas', '', $url.'/clientejuridicorepresentante/editar'],
		['Almacenero', '', $url.'/categoria/insertar'],
		['Almacenero', '', $url.'/categoria/vercategoriapadre'],
		['Almacenero', '', $url.'/categoria/verporcodigocategoriapadre'],
		['Almacenero', '', $url.'/categoria/editar'],
		['Almacenero', '', $url.'/categoria/buscarcategoriaporcodigocategoriapadre'],
		['Almacenero', '', $url.'/presentacion/insertar'],
		['Almacenero', '', $url.'/presentacion/ver'],
		['Almacenero', '', $url.'/presentacion/editar'],
		['Almacenero', '', $url.'/presentacion/insertarconajax'],
		['Almacenero', '', $url.'/unidadmedida/insertar'],
		['Almacenero', '', $url.'/unidadmedida/ver'],
		['Almacenero', '', $url.'/unidadmedida/editar'],
		['Almacenero', '', $url.'/unidadmedida/insertarconajax'],
		['Almacenero', '', $url.'/recibocompra/insertar'],
		['Almacenero', 'param', $url.'/recibocompra/verentrefechas'],
		['Almacenero', '', $url.'/recibocompra/anular'],
		['Almacenero', 'param', $url.'/recibocompra/verportipopago'],
		['Almacenero', '', $url.'/recibocompra/editar'],
		['Almacenero', '', $url.'/recibocompradetalle/verporcodigorecibocompra'],
		['Almacenero', '', $url.'/recibocomprapago/insertar'],
		['Almacenero', '', $url.'/recibocomprapago/verporcodigorecibocompra'],
		['Almacenero', '', $url.'/almacenproducto/listabuscaralmacenproductoagrupadopornombre'],
		['Almacenero', '', $url.'/almacenproducto/listabuscaralmacenproductoporcodigoalmacennombre'],
		['Almacenero', '', $url.'/almacenproducto/listabuscaralmacenproductoporcodigobarras'],
		['Almacenero', '', $url.'/almacenproducto/vertodoagrupado'],
		['Almacenero', '', $url.'/almacenproducto/verporcodigoalmacen'],
		['Almacenero', '', $url.'/almacenproducto/editartodoslocales'],
		['Almacenero', '', $url.'/almacenproducto/editar'],
		['Almacenero', 'param', $url.'/almacenproducto/administrarcategoria'],
		['Almacenero', '', $url.'/almacenproducto/sincronizarcategorias'],
		['Almacenero', '', $url.'/almacenproductoretiro/insertar'],
		['Almacenero', '', $url.'/almacenproductoretiro/verporcodigoalmacen'],
		['Almacenero', '', $url.'/productoenviarstock/insertar'],
		['Almacenero', '', $url.'/productoenviarstock/insertarconajax'],
		['Almacenero', 'param', $url.'/productoenviarstock/verentrefechas'],
		['Almacenero', '', $url.'/productoenviarstock/anular'],
		['Almacenero', '', $url.'/productoenviarstockdetalle/verporcodigoproductoenviarstock'],
		['Administrador', '', $url.'/productotrasladooficina/insertar'],
		['Administrador', 'param', $url.'/productotrasladooficina/verentrefechas'],
		['Administrador', '', $url.'/productotrasladooficina/anular'],
		['Administrador', '', $url.'/productotrasladooficinadetalle/verporcodigoproductotrasladooficina'],
		['Ventas', '', $url.'/oficinaproducto/verporcodigooficina'],
		['Ventas', '', $url.'/oficinaproducto/listabuscaroficinaproductoporcodigooficinanombre'],
		['Ventas', '', $url.'/oficinaproducto/listabuscaroficinaproductoporcodigobarras'],
		['Ventas', '', $url.'/oficinaproducto/editar'],
		['Ventas', '', $url.'/oficinaproductoretiro/insertar'],
		['Ventas', '', $url.'/oficinaproductoretiro/verporcodigooficina'],
		['Ventas', '', $url.'/reciboventa/insertar'],
		['Ventas', 'param', $url.'/reciboventa/verentrefechas'],
		['Ventas', '', $url.'/reciboventa/anular'],
		['Ventas', 'param', $url.'/reciboventa/verportipopago'],
		['Ventas', '', $url.'/reciboventa/editar'],
		['Ventas', '', $url.'/reciboventadetalle/verporcodigoreciboventa'],
		['Ventas', '', $url.'/reciboventaletra/verporcodigoreciboventa'],
		['Ventas', '', $url.'/reciboventaletra/pagarletra'],
		['Ventas', '', $url.'/reciboventapago/insertar'],
		['Ventas', '', $url.'/reciboventapago/verporcodigoreciboventa'],
		['Administrador', '', $url.'/caja/insertar'],
		['Administrador', '', $url.'/caja/ver'],
		['Administrador', '', $url.'/cajadetalle/insertar'],
		['Administrador', '', $url.'/cajadetalle/verporcodigocaja'],
		['Administrador', '', $url.'/cajadetalle/incrementarsaldoinicial'],
		['Administrador', '', $url.'/cajadetalle/cerrar'],
		['Administrador', 'param', $url.'/cajadetalle/reabrir'],
		['Administrador', '', $url.'/egreso/insertar'],
		['Administrador', 'param', $url.'/egreso/verentrefechas'],
		['Administrador,Reportes', '', $url.'/reporte/index'],
		['Ventas', 'param', $url.'/reporte/ticket'],
		['Ventas', 'param', $url.'/reporte/recibo'],
		['Ventas', 'param', $url.'/reporte/notacredito'],
		['Ventas', 'param', $url.'/reporte/reciboventapago'],
		['Ventas', 'param', $url.'/reporte/boleta'],
		['Ventas', 'param', $url.'/reporte/factura'],
		['Ventas', 'param', $url.'/reporte/guiaremisionventa'],
		['Almacenero', 'param', $url.'/reporte/guiaremisionenvioproductoalmacenoficina'],
		['Administrador', 'param', $url.'/reporte/guiaremisiontrasladoproductooficina'],
		['Ventas', '', $url.'/reporte/proforma'],
		['Administrador,Reportes', '', $url.'/reporte/productosagotadosporagotarsestock'],
		['Administrador,Reportes', '', $url.'/reporte/productosagotadosporagotarsealmacen'],
		['Administrador,Reportes', '', $url.'/reporte/productosporvencersestock'],
		['Administrador,Reportes', '', $url.'/reporte/productosporvencersealmacen'],
		['Administrador,Reportes', '', $url.'/reporte/comprasporpagar'],
		['Administrador,Reportes', '', $url.'/reporte/ventasporcobrarpagos'],
		['Administrador,Reportes', '', $url.'/reporte/ventasporcobrarletras'],
		['Administrador,Reportes', 'param', $url.'/reporte/productosporcodigooficina'],
		['Administrador,Reportes', 'param', $url.'/reporte/productosporcodigoalmacen'],
		['Administrador,Reportes', 'param', $url.'/reporte/compraentrefechas'],
		['Administrador,Reportes', 'param', $url.'/reporte/compraentrefechasporcodigoalmacen'],
		['Administrador,Reportes', 'param', $url.'/reporte/compraporreciboemitidoentrefechas'],
		['Administrador,Reportes', 'param', $url.'/reporte/compraporreciboemitidoentrefechasporcodigoalmacen'],
		['Administrador,Reportes', 'param', $url.'/reporte/ventaentrefechas'],
		['Administrador,Reportes', 'param', $url.'/reporte/ventaentrefechasporcodigooficina'],
		['Administrador,Reportes', 'param', $url.'/reporte/ventaentrefechasportiporecibo'],
		['Administrador,Reportes', 'param', $url.'/reporte/ventaentrefechasporcodigooficinatiporecibo'],
		['Administrador,Reportes', 'param', $url.'/reporte/envioproductosalmacenoficinaentrefechas'],
		['Administrador,Reportes', 'param', $url.'/reporte/productotrasladooficinaentrefechas'],
		['Administrador,Reportes', '', $url.'/reporte/productosretiradosoficina'],
		['Administrador,Reportes', '', $url.'/reporte/productosretiradosalmacen'],
		['Administrador,Reportes', 'param', $url.'/reporte/gastoentrefechas'],
		['Administrador,Reportes', 'param', $url.'/reporte/cajaentrefechas']
	];

	$miRol=Session::get('rol', 'Público');
	$miRol=$miRol=='' ? 'Público' : $miRol;

	foreach($permisosUrl as $key => $value)
	{
		if(Request::url()==$value[2] || ($value[1]=='param' && strlen(strpos(Request::url(), $value[2]))>0))
		{
			$permisos=explode(',', $value[0]);

			foreach($permisos as $key2 => $value2)
			{
				if(strlen(strpos($miRol, $value2))>0)
				{
					$accesoUrl=true;

					break 2;
				}
			}
		}
	}

	if(!$accesoUrl)
	{
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
		{
			echo '<div class="alertaMensajeError">No tiene autorización para realizar esta operación o su "sesión de usuario" ya ha finalizado.</div>';exit;
		}
		else
		{
			return Redirect::to('/');
		}
	}
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('login');
		}
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});
