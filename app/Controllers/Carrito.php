<?php

namespace App\Controllers;

use App\Models\producto_Model;
use App\Models\Ventas_cabecera;
use App\Models\Ventas_detalle;

class Carrito extends BaseController
{
    protected $cart;
    protected $productoModel;

    public function __construct()
    {
        $this->cart = \Config\Services::cart();
        $this->productoModel = new producto_Model();
    }

    // Mostrar el contenido del carrito
    public function ver()
    {
        return view('carrito', [
            'cart' => $this->cart
        ]);
    }

    // Agregar un producto al carrito (se llama desde Producto::agregar)
    public function agregar()
    {
        if ($this->request->getMethod() === 'post') {
            $data = [
                'id'    => $this->request->getPost('id_producto'),       // id_producto
                'qty'   => $this->request->getPost('qty') ?? 1,
                'price' => $this->request->getPost('precio_vta'),    // precio_vta
                'name'  => $this->request->getPost('nombre_prod'),     // nombre_prod
            ];

            $this->cart->insert($data);
        }

        return redirect()->to(site_url('carrito/ver'));
    }

    // Actualizar cantidad de un ítem
    public function actualizar()
    {
        if ($this->request->getMethod() === 'post') {
            $data = [
                'rowid' => $this->request->getPost('rowid'),
                'qty'   => $this->request->getPost('qty')
            ];

            $this->cart->update($data);
        }

        return redirect()->to(site_url('carrito/ver'));
    }

    // Eliminar un ítem del carrito
    public function eliminar()
    {
        if ($this->request->getMethod() === 'post') {
            $rowid = $this->request->getPost('rowid');
            $this->cart->remove($rowid);
        }

        return redirect()->to(site_url('carrito/ver'));
    }

public function comprar()
{
    $cart = \Config\Services::cart();
    $items = $cart->contents();

    if (empty($items)) {
        return redirect()->to(site_url('productos'));
    }

    $cabeceraModel = new Ventas_cabecera();
    $detalleModel  = new Ventas_detalle();

    $total = $cart->total();

    $idUsuario = session()->get('id_usuario') ?? 1;

    $ventaId = $cabeceraModel->insert([
        'fecha'       => date('Y-m-d H:i:s'),
        'usuario_id'  => $idUsuario,
        'total_venta' => $total
    ]);

    if (!$ventaId) {
        $ventaId = $cabeceraModel->getInsertID();
    }

    // Validar stock antes de procesar la compra
    foreach ($items as $item) {
        $producto = $this->productoModel->find($item['id']);
        $cantidad = isset($item['qty']) ? (int)$item['qty'] : 1;
        if (!$producto || !isset($producto['stock']) || $producto['stock'] < $cantidad || $producto['stock'] <= 0) {
            // Si no hay stock suficiente, redirigir con mensaje de error
            // Eliminar la venta creada si existe
            if (isset($ventaId) && $ventaId) {
                $cabeceraModel->delete($ventaId);
            }
            return redirect()->to(site_url('carrito/ver'))
                ->with('error', 'No hay stock suficiente para el producto: ' . ($producto['nombre_prod'] ?? 'Desconocido'));
        }
    }

    foreach ($items as $item) {
        // Registrar detalle de venta
        $detalle = [
            'ventas_id'   => $ventaId,
            'producto_id' => $item['id'],
            'cantidad'    => $item['qty'],
            'precio'      => $item['price']
        ];
        $detalleModel->insert($detalle);

        // Obtener producto actual
        $producto = $this->productoModel->find($item['id']);

        // Actualizar stock si el producto existe
        if ($producto && isset($producto['stock'])) {
            $nuevoStock = $producto['stock'] - $item['qty'];
            $this->productoModel->update($item['id'], ['stock' => $nuevoStock]);
        }
    }

    // Vaciar el carrito
    $cart->destroy();

    // Traer detalle compra nueva
    $db = \Config\Database::connect();
    $builder = $db->table('ventas_detalle');
    $detalleCompraNueva = $builder
        ->select('ventas_detalle.*, productos.nombre_prod AS nombre_producto, productos.imagen AS imagen_producto')
        ->join('productos', 'productos.id_producto = ventas_detalle.producto_id')
        ->where('ventas_id', $ventaId)
        ->get()
        ->getResultArray();

    // Calcular total compra nueva (por seguridad)
    $total_compra_nueva = 0;
    foreach ($detalleCompraNueva as $item) {
        $total_compra_nueva += $item['precio'] * $item['cantidad'];
    }

    // Traer todas las compras anteriores (excepto la nueva, si querés)
    $ventasAnteriores = $cabeceraModel
        ->where('usuario_id', $idUsuario)
        ->where('id !=', $ventaId)  // opcional: para no repetir la nueva
        ->orderBy('fecha', 'DESC')
        ->findAll();

    return view('compras', [
        'detalle_venta'    => $detalleCompraNueva,
        'total_venta'      => $total_compra_nueva,
        'ventas_anteriores' => $ventasAnteriores,
        'venta_nueva_id'   => $ventaId
    ]);
}
public function detalleCompra($id)
{
    $ventaModel = new \App\Models\Ventas_cabecera();
    $detalleModel = new \App\Models\Ventas_detalle();

    // Traer datos de la venta (cabecera)
    $venta = $ventaModel
        ->select('ventas_cabecera.*, CONCAT(usuarios.nombre, " ", usuarios.apellido) as cliente')
        ->join('usuarios', 'usuarios.id_usuario = ventas_cabecera.usuario_id', 'left')
        ->where('ventas_cabecera.id', $id)
        ->first();

    // Traer detalles con nombre e imagen del producto
    $detalles = $detalleModel
        ->select('ventas_detalle.*, productos.nombre_prod AS producto_nombre, productos.imagen AS producto_imagen')
        ->join('productos', 'productos.id_producto = ventas_detalle.producto_id', 'left')
        ->where('ventas_id', $id)
        ->findAll();

    return view('detalle_compra', [
        'venta' => $venta,
        'detalles' => $detalles
    ]);
}


public function misCompras()
{
    $idUsuario = session()->get('id_usuario') ?? 1;
    $cabeceraModel = new Ventas_cabecera();

    $ventas = $cabeceraModel
        ->where('usuario_id', $idUsuario)
        ->orderBy('fecha', 'DESC')
        ->findAll();

    return view('misCompras', [
        'ventas' => $ventas
    ]);
}


}
