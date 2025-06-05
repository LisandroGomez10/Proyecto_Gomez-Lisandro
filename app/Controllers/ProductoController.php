<?php

namespace App\Controllers;

use App\Models\producto_Model;
use App\Models\ProductoModel;
use CodeIgniter\Controller;

class ProductoController extends BaseController
{
    protected $productoModel;
    protected $cart;

    public function __construct()
    {
        $this->productoModel = new producto_Model();
        $this->cart = \Config\Services::cart();
    }

    // Mostrar catálogo de productos
    public function index()
    {
        $productos = $this->productoModel->findAll();

        return view('productos', [
            'productos' => $productos,
            'cart' => $this->cart
        ]);
    }

    // Agregar al carrito
    public function agregar()
    {
        if ($this->request->getMethod() === 'post') {
            $data = [
                'id'      => $this->request->getPost('id_producto'),
                'qty'     => 1,
                'price'   => $this->request->getPost('precio_vta'),
                'name'    => $this->request->getPost('nombre_prod'),
            ];

            $this->cart->insert($data);
        }

        return redirect()->to(site_url('carrito/ver'));
    }
}
