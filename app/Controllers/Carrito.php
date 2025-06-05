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

        $total = $cart->getTotal();

        // ID del usuario (fijo 1 si no está logueado)
        $idUsuario = session()->get('id_usuario') ?? 1;

        // Insertar en ventas_cabecera y obtener el ID generado
        $ventaId = $cabeceraModel->insert([
            'fecha'      => date('Y-m-d H:i:s'),
            'usuario_id' => $idUsuario,
            'total_venta'=> $total
        ]);

        // El método insert() devuelve el ID insertado, sino usar insertID()
        if (!$ventaId) {
            $ventaId = $cabeceraModel->getInsertID();
        }

        // Insertar cada ítem en ventas_detalle
        foreach ($items as $item) {
            $detalleModel->insert([
                'ventas_id'   => $ventaId,
                'producto_id' => $item['id'],
                'cantidad'    => $item['qty'],
                'precio'      => $item['price']
            ]);
        }

        // Obtener detalle completo con nombre producto para la vista
        $db = \Config\Database::connect();
        $builder = $db->table('ventas_detalle');
        $detalleVenta = $builder
            ->select('ventas_detalle.*, productos.nombre_prod AS nombre_producto')
            ->join('productos', 'productos.id_producto = ventas_detalle.producto_id')
            ->where('ventas_id', $ventaId)
            ->get()
            ->getResultArray();

        // Vaciar carrito
        $cart->destroy();

        // Pasar datos a la vista de confirmación de compra
        return view('compras', [
            'detalle_venta' => $detalleVenta,
            'total_venta'   => $total
        ]);
    }


    
    public function misCompras()
{
    $idUsuario = session()->get('id_usuario') ?? 1; // Reemplazar por el ID de sesión real si tenés login

    $cabeceraModel = new \App\Models\Ventas_cabecera();

    $ventas = $cabeceraModel
        ->where('usuario_id', $idUsuario)
        ->orderBy('fecha', 'DESC')
        ->findAll();

    return view('compras', [
        'ventas' => $ventas
    ]);
}

    public function detalleCompra($id)
{
    $detalleModel = new \App\Models\Ventas_detalle();

    $db = \Config\Database::connect();
    $builder = $db->table('ventas_detalle');

    $detalles = $builder
        ->select('ventas_detalle.*, productos.nombre_prod AS nombre_producto')
        ->join('productos', 'productos.id_producto = ventas_detalle.producto_id')
        ->where('ventas_id', $id)
        ->get()
        ->getResultArray();

    return view('detalle_compra_', [
        'detalles' => $detalles
    ]);
}


}
