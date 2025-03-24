<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\usuario_Model;
  
class login_controller extends BaseController
{
    public function index()
    {
        helper(['form','url']);
      
        $dato['titulo']='login'; 
        echo view('head',$dato);
         echo view('navbar');
         echo view('login');
         echo view('footer');
    } 
  
    public function auth()
    {
        $session = session(); //el objeto de sesión se asigna a la variable $session
        $model = new usuario_Model(); //instanciamos el modelo

        //traemos los datos del formulario
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('pass');
        
        $data = $model->where('email', $email)->first(); //consulta sql 
        if($data){
            $pass = $data['pass'];
               $ba= $data['baja'];
                if ($ba == 'SI'){
                     $session->setFlashdata('msg', 'usuario dado de baja');
                     return redirect()->to('/login_controller');
                 }
                    //Se verifican los datos ingresados para iniciar, si cumple la verificaciòn inicia la sesion
               $verify_pass = password_verify($password, $pass);
                   //password_verify determina los requisitos de configuracion de la contraseña
                   if($verify_pass){
                     $ses_data = [
                    'id_usuario' => $data['id_usuario'],
                    'nombre' => $data['nombre'],
                    'apellido'=> $data['apellido'],
                    'email' =>  $data['email'],
                    'usuario' => $data['usuario'],
                    'perfil_id'=> $data['perfil_id'],
                    'logged_in'  => TRUE
                ];
                  //Si se cumple la verificacion inicia la sesiòn  
                  $session->set($ses_data);

                  session()->setFlashdata('msg', 'Bienvenido!!');
                  return redirect()->to('/index');
                  // return redirect()->to('/prueba');//pagina principal
            }else{  
                 //no paso la validaciòn de la password
               $session->setFlashdata('msg', 'Password Incorrecta');
                return redirect()->to('/login');
         }   
        }else{
             //no paso la validaciòn del correo
            $session->setFlashdata('msg', 'No Existe el Email o es Incorrecto');
            return redirect()->to('/login');
      } 
    
  }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
} 
