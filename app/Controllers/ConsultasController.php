<?php

namespace App\Controllers;

use App\Models\Consulta_model;
use CodeIgniter\Controller;

class ConsultasController extends Controller
{
    protected $consultaModel;

    public function __construct()
    {
        $this->consultaModel = new Consulta_model();
    }

    public function index()
    {
        $data['consultas'] = $this->consultaModel->orderBy('consultas_id', 'DESC')->findAll();
        return view('consultas', $data);
    }

    public function crear()
    {
        return view('contacto');
    }

    public function guardar()
    {
        $request = service('request');
        $data = [
            'consultas_nombre'   => $request->getPost('nombre'),
            'consultas_apellido' => $request->getPost('apellido'),
            'consultas_email'    => $request->getPost('email'),
            'consultas_numero'   => $request->getPost('numero'),
            'consultas_pregunta' => $request->getPost('pregunta'),
            'consultas_visto'    => 0 // por defecto no visto
        ];
        $this->consultaModel->save($data);

        return redirect()->to('/contacto');
    }

    public function marcarComoVisto($id)
    {
        $this->consultaModel->update($id, ['consultas_visto' => 1]);
        return redirect()->to('/consultas');
    }

    public function ventas()
    {
        $ventasModel = new \App\Models\Ventas_cabecera();
        $usuarioModel = new \App\Models\usuario_Model();
        $pager = \Config\Services::pager();

        // Paginación y obtención de ventas
        $ventas = $ventasModel
            ->select('ventas_cabecera.id as venta_id, ventas_cabecera.fecha as venta_fecha, usuarios.nombre as usuario_nombre')
            ->join('usuarios', 'usuarios.id_usuario = ventas_cabecera.usuario_id')
            ->orderBy('ventas_cabecera.fecha', 'DESC')
            ->paginate(10, 'default');

        // Calcular el total de cada venta sumando los subtotales de ventas_detalle
        $ventasArray = $ventasModel->db->table('ventas_cabecera')
            ->select('ventas_cabecera.id as venta_id, ventas_cabecera.fecha as venta_fecha, usuarios.nombre as usuario_nombre, SUM(ventas_detalle.cantidad * ventas_detalle.precio) as venta_total')
            ->join('usuarios', 'usuarios.id_usuario = ventas_cabecera.usuario_id')
            ->join('ventas_detalle', 'ventas_detalle.ventas_id = ventas_cabecera.id')
            ->groupBy('ventas_cabecera.id')
            ->orderBy('ventas_cabecera.fecha', 'DESC')
            ->limit(10)
            ->get()
            ->getResultArray();

        return view('ventas', [
            'ventas' => $ventasArray,
            'pager' => null // No se usa paginación de CodeIgniter, así evitamos el error de plantilla
        ]);
    }
}
