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
}
