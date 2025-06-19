<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index'); /* controlador-->funcion */
$routes->get('/index', 'Home::index');
$routes->get('/quienesSomos', 'Home::quienesSomos');
$routes->get('/terminosdeuso', 'Home::terminosdeuso');
$routes->get('/comercializacion', 'Home::comercializacion');


/* Rutas del registro */
$routes->get('/registro', 'Home::registro');
//$routes->get('/registro','usuario_controller::create');
$routes->post('/enviar-form','usuario_controller::index');

/* Rutas del login */
$routes->get('/login', 'Home::login');
$routes->post('/enviarlogin','login_controller::auth');
$routes->get('/logout', 'login_controller::logout');


// ---------- CATÁLOGO ----------
$routes->get('productos', 'ProductoController::index');          // Muestra los productos

// ---------- TABLA DE PRODUCTOS Y CRUD ----------
$routes->get('productos/tabla', 'ProductoController::tabla'); // Tabla de productos activos
$routes->get('productos/agregar', 'ProductoController::agregar'); // Formulario alta
$routes->post('productos/guardar', 'ProductoController::guardar'); // Guardar producto
$routes->post('producto/guardar', 'ProductoController::guardar'); // Guardar producto (singular)
$routes->get('productos/editar/(:num)', 'ProductoController::editar/$1'); // Formulario edición
$routes->post('productos/actualizar/(:num)', 'ProductoController::actualizar/$1'); // Actualizar producto
$routes->get('productos/borrar/(:num)', 'ProductoController::borrar/$1'); // Borrado lógico
$routes->get('productos/eliminados', 'ProductoController::eliminados'); // Listar eliminados
$routes->get('productos/activar/(:num)', 'ProductoController::activar/$1'); // Activar producto eliminado
$routes->get('tabla_productos', 'ProductoController::tabla'); // Mostrar tabla_productos.php

// ---------- CARRITO ----------
$routes->get('carrito/ver', 'Carrito::ver');                 // Ver carrito
$routes->post('carrito/agregar', 'Carrito::agregar');        // Agregar producto al carrito
$routes->post('carrito/actualizar', 'Carrito::actualizar');  // Actualizar cantidad
$routes->post('carrito/eliminar', 'Carrito::eliminar');      // Eliminar producto del carrito
$routes->post('carrito/comprar', 'Carrito::comprar');        // Finalizar compra

// ---------- HISTORIAL DE COMPRAS ----------
$routes->get('compras', 'Carrito::misCompras');  // Mostrar historial de compras
$routes->get('carrito/detalle-compra/(:num)', 'Carrito::detalleCompra/$1');  // Ver detalle de una compra


$routes->get('/contacto', 'ConsultasController::index');
$routes->get('/consultas/crear', 'ConsultasController::crear');
$routes->post('/consultas/guardar', 'ConsultasController::guardar');
$routes->post('consultas/visto/(:num)', 'ConsultasController::marcarComoVisto/$1');


// ---------- RUTAS DE USUARIOS ----------
$routes->get('usuarios/lista', 'usuario_controller::lista');
$routes->get('usuarios/agregar', 'usuario_controller::agregar');
$routes->post('usuarios/guardar', 'usuario_controller::guardar');
$routes->get('usuarios/editar/(:num)', 'usuario_controller::editar/$1');
$routes->post('usuarios/actualizar/(:num)', 'usuario_controller::actualizar/$1');
$routes->get('usuarios/borrar/(:num)', 'usuario_controller::borrar/$1');
$routes->get('usuarios/activar/(:num)', 'usuario_controller::activar/$1');

// Rutas para productos (admin)
$routes->get('productos/tabla', 'ProductoController::tabla');
$routes->get('productos/agregar', 'ProductoController::agregar');
$routes->post('productos/guardar', 'ProductoController::guardar');
$routes->get('productos/editar/(:num)', 'ProductoController::editar/$1');
$routes->post('productos/actualizar/(:num)', 'ProductoController::actualizar/$1');
$routes->get('productos/borrar/(:num)', 'ProductoController::borrar/$1');
$routes->get('productos/eliminados', 'ProductoController::eliminados');

// Rutas para ventas
$routes->get('ventas', 'ConsultasController::ventas');
$routes->get('ventas/factura/(:num)', 'ConsultasController::factura/$1');
$routes->get('ventas/descargarPDF/(:num)', 'ConsultasController::descargarPDF/$1');

// Rutas para consultas
$routes->get('consultas', 'ConsultasController::index');

// Detalle de compra y PDF
$routes->get('detalle_compra/(:num)', 'DetalleCompraController::ver/$1');
$routes->get('detalle_compra/pdf/(:num)', 'DetalleCompraController::pdf/$1');

// Detalle de venta para listado de ventas
$routes->get('detalle_venta/(:num)', 'DetalleCompraController::detalleVenta/$1');
$routes->get('detalle_venta/pdf/(:num)', 'DetalleCompraController::pdf/$1');


// ---------- RUTA POR DEFECTO (opcional) ----------
//$routes->get('/', 'ProductoController::index'); // Home redirige al catálogo

$routes->get('perfil', 'usuario_controller::perfil');
$routes->post('perfil/actualizar', 'usuario_controller::actualizarPerfil');




/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
