<?php
namespace App\Controllers;

use App\Models\Ventas_cabecera;
use App\Models\Ventas_detalle;
use App\Models\usuario_Model;
use CodeIgniter\Controller;

class DetalleCompraController extends Controller
{
    public function ver($id)
    {
        $cabeceraModel = new Ventas_cabecera();
        $detalleModel = new Ventas_detalle();
        $usuarioModel = new usuario_Model();

        $venta = $cabeceraModel
            ->select('ventas_cabecera.id, ventas_cabecera.fecha, usuarios.nombre as cliente')
            ->join('usuarios', 'usuarios.id_usuario = ventas_cabecera.usuario_id')
            ->where('ventas_cabecera.id', $id)
            ->first();

        $detalles = $detalleModel
            ->select('ventas_detalle.*, productos.nombre_prod as producto_nombre, productos.imagen as producto_imagen')
            ->join('productos', 'productos.id_producto = ventas_detalle.producto_id')
            ->where('ventas_detalle.ventas_id', $id)
            ->findAll();

        return view('detalle_compra', [
            'venta' => $venta,
            'detalles' => $detalles
        ]);
    }

    public function detalleVenta($id)
    {
        $cabeceraModel = new Ventas_cabecera();
        $detalleModel = new Ventas_detalle();
        $usuarioModel = new usuario_Model();

        $venta = $cabeceraModel
            ->select('ventas_cabecera.id, ventas_cabecera.fecha, usuarios.nombre as cliente')
            ->join('usuarios', 'usuarios.id_usuario = ventas_cabecera.usuario_id')
            ->where('ventas_cabecera.id', $id)
            ->first();

        $detalles = $detalleModel
            ->select('ventas_detalle.*, productos.nombre_prod as producto_nombre, productos.imagen as imagen_producto')
            ->join('productos', 'productos.id_producto = ventas_detalle.producto_id')
            ->where('ventas_detalle.ventas_id', $id)
            ->findAll();

        return view('detalle_venta', [
            'venta' => $venta,
            'detalles' => $detalles
        ]);
    }
}
