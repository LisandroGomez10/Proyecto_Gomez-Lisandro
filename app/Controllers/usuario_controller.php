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
            // Si no pasa la validación, mostrar formulario SOLO con return view (no echo view)
            return view('registro', [
                'validation' => $this->validator
            ]);
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
                'baja'       => 'NO'  // Usuario activo por defecto
            ]);

            return redirect()->to('/login');
        }
    }

    public function lista()
    {
        $usuarioModel = new usuario_Model();
        $usuarios = $usuarioModel->findAll();
        return view('usuarios', ['usuarios' => $usuarios]);
    }

    public function agregar()
    {
        helper(['form']);
        return view('agregarusuario', ['validation' => null]);
    }

    public function guardar()
    {
        helper(['form']);
        $rules = [
            'nombre'   => 'required|min_length[3]',
            'apellido' => 'required|min_length[3]',
            'usuario'  => 'required|is_unique[usuarios.usuario]',
            'email'    => 'required|valid_email|is_unique[usuarios.email]',
            'pass'     => 'required|min_length[6]',
            'perfil_id'=> 'required|integer|is_not_unique[perfiles.id_perfiles]'
        ];
        if (!$this->validate($rules)) {
            return view('registro', [
                'validation' => $this->validator
            ]);
        }
        $usuarioModel = new usuario_Model();
        $usuarioModel->save([
            'nombre'     => $this->request->getVar('nombre'),
            'apellido'   => $this->request->getVar('apellido'),
            'usuario'    => $this->request->getVar('usuario'),
            'email'      => $this->request->getVar('email'),
            'pass'       => password_hash($this->request->getVar('pass'), PASSWORD_DEFAULT),
            'perfil_id'  => $this->request->getVar('perfil_id'),
            'baja'       => 'NO'
        ]);
        return redirect()->to('/usuarios/lista');
    }

    public function editar($id)
    {
        $usuarioModel = new usuario_Model();
        $usuario = $usuarioModel->find($id);
        if (!$usuario) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Usuario con ID $id no encontrado");
        }
        // Si es admin, no puede editar su propio perfil_id ni darse de baja
        $esAdmin = ($usuario['perfil_id'] == 1);
        return view('usuario_editar', [
            'usuario' => $usuario,
            'validation' => null,
            'esAdmin' => $esAdmin
        ]);
    }

    public function actualizar($id)
    {
        helper(['form']);
        $usuarioModel = new usuario_Model();
        $usuario = $usuarioModel->find($id);
        $esAdmin = ($usuario['perfil_id'] == 1);
        $rules = [
            'nombre'   => 'required|min_length[3]',
            'apellido' => 'required|min_length[3]',
            'usuario'  => 'required|is_unique[usuarios.usuario,id_usuario,'.$id.']',
            'email'    => 'required|valid_email|is_unique[usuarios.email,id_usuario,'.$id.']',
            'pass'     => 'permit_empty|min_length[6]'
        ];
        if (!$esAdmin) {
            $rules['perfil_id'] = 'required|integer|in_list[1,2]|is_not_unique[perfiles.id_perfiles]';
        }
        if (!$this->validate($rules)) {
            return view('usuario_editar', [
                'usuario' => $usuario,
                'validation' => $this->validator,
                'esAdmin' => $esAdmin
            ]);
        }
        $data = [
            'nombre'     => $this->request->getVar('nombre'),
            'apellido'   => $this->request->getVar('apellido'),
            'usuario'    => $this->request->getVar('usuario'),
            'email'      => $this->request->getVar('email'),
        ];
        if (!$esAdmin) {
            $data['perfil_id'] = $this->request->getVar('perfil_id');
            $data['baja'] = $this->request->getVar('baja') ?? 'NO';
        }
        if ($this->request->getVar('pass')) {
            $data['pass'] = password_hash($this->request->getVar('pass'), PASSWORD_DEFAULT);
        }
        $usuarioModel->update($id, $data);
        return redirect()->to('/usuarios/lista');
    }

    public function borrar($id)
    {
        $usuarioModel = new usuario_Model();
        $usuario = $usuarioModel->find($id);
        if (!$usuario) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Usuario con ID $id no encontrado");
        }
        // No permitir dar de baja a admin
        if ($usuario['perfil_id'] == 1) {
            return redirect()->to('/usuarios/lista')->with('error', 'No se puede dar de baja a un usuario administrador.');
        }
        $usuarioModel->update($id, ['baja' => 'SI']);
        return redirect()->to('/usuarios/lista');
    }

    public function activar($id)
    {
        $usuarioModel = new usuario_Model();
        $usuario = $usuarioModel->find($id);
        if (!$usuario) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Usuario con ID $id no encontrado");
        }
        $usuarioModel->update($id, ['baja' => 'NO']);
        return redirect()->to('/usuarios/lista');
    }

    public function perfil()
    {
        $idUsuario = session()->get('id_usuario');
        $usuarioModel = new usuario_Model();
        $usuario = $usuarioModel->find($idUsuario);
        if (!$usuario) {
            return redirect()->to('/')->with('error', 'Usuario no encontrado.');
        }
        return view('perfil', ['usuario' => $usuario]);
    }

    public function actualizarPerfil()
    {
        $idUsuario = session()->get('id_usuario');
        $usuarioModel = new usuario_Model();
        $usuario = $usuarioModel->find($idUsuario);
        if (!$usuario) {
            return redirect()->to('/')->with('error', 'Usuario no encontrado.');
        }
        $rules = [
            'nombre'   => 'required|min_length[3]',
            'apellido' => 'required|min_length[3]',
            'usuario'  => 'required',
            'email'    => 'required|valid_email',
        ];
        if (!$this->validate($rules)) {
            return view('perfil', [
                'usuario' => $usuario,
                'validation' => $this->validator
            ]);
        }
        $data = [
            'nombre'   => $this->request->getPost('nombre'),
            'apellido' => $this->request->getPost('apellido'),
            'usuario'  => $this->request->getPost('usuario'),
            'email'    => $this->request->getPost('email'),
        ];
        $pass = $this->request->getPost('pass');
        if (!empty($pass)) {
            $data['pass'] = password_hash($pass, PASSWORD_DEFAULT);
        }
        $usuarioModel->update($idUsuario, $data);
        // Actualizar datos en sesión si es necesario
        session()->set($data);
        return redirect()->to('perfil')->with('success', 'Perfil actualizado correctamente.');
    }
}
