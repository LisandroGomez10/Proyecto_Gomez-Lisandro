<?php

namespace App\Controllers;

use App\Models\usuario_Model;

class usuario_controller extends BaseController
{

    public function index()
    {
        helper(['form']);

        // Reglas de validación
        $rules = [
            'nombre'   => 'required|min_length[3]',
            'apellido' => 'required|min_length[3]',
            'usuario'  => 'required|is_unique[usuarios.usuario]',
            'email'    => 'required|valid_email|is_unique[usuarios.email]',
            'pass'     => 'required|min_length[6]'
        ];

        if (!$this->validate($rules)) {
            // Si no pasa la validación, mostrar formulario
            $data['titulo'] = 'Registro';
            $data['validation'] = $this->validator;

            echo view('head', $data);
            echo view('navbar');
            echo view('registro', $data);
            echo view('footer');
        } else {
            // Si pasa validación, guardar usuario
            $usuarioModel = new usuario_Model();
        
            $usuarioModel->save([
                'nombre'     => $this->request->getVar('nombre'),
                'apellido'   => $this->request->getVar('apellido'),
                'usuario'    => $this->request->getVar('usuario'),
                'email'      => $this->request->getVar('email'),
                'pass'       => password_hash($this->request->getVar('pass'), PASSWORD_DEFAULT),
                'perfil_id'  => 2, // Valor por defecto si aplica
                'baja'       => 0  // Usuario activo por defecto
            ]);

            return redirect()->to('/login');
        }
    }
}
