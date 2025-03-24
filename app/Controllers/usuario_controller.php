<?php
namespace App\Controllers;
Use App\Models\usuario_Model;
use CodeIgniter\Controller;

class usuario_controller extends Controller{

    public function __construct(){
           helper(['form', 'url']);

    }
    public function create() {
        
         $dato['titulo']='Registro'; 
         echo view('head',$dato);
         echo view('navbar');
         echo view('registro');
         echo view('footer');
      }
 
    public function formValidation() {
             
        $input = $this->validate([
            'nombre'   => 'required|min_length[3]',
            'apellido' => 'required|min_length[3]|max_length[25]',
            'usuario'  => 'required|min_length[3]',
            'email'    => 'required|min_length[4]|max_length[100]|valid_email|is_unique[usuarios.email]',
            'pass'     => 'required|min_length[3]|max_length[10]'
        ],
        
       );
        $formModel = new usuario_Model();
     
        if (!$input) {
               $data['titulo']='Registro'; 
                echo view('head',$data);
                echo view('navbar');
                echo view('registro', ['validation' => $this->validator]);
                echo view('footer');

        } else {
            $formModel->save([
                'nombre' => $this->request->getVar('nombre'),
                'apellido'=> $this->request->getVar('apellido'),
                'usuario'=> $this->request->getVar('usuario'),
                'email'=> $this->request->getVar('email'),
                'pass' => password_hash($this->request->getVar('pass'), PASSWORD_DEFAULT)
              //password_hash() crea un nuevo hash de contraseña usando un algoritmo de hash de único sentido.
            ]);  
             
            // Flashdata funciona solo en redirigir la función en el controlador en la vista de carga.
               session()->setFlashdata('success', 'Usuario registrado con exito');
                return redirect()->to('/login');
              // return $this->response->redirect('/registro');
      
        }
    }
}
