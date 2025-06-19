<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        echo view('head');       
        echo view('titulo');
        echo view('navbar');
        echo view('carousel');
        echo view('footer');
    }

    public function quienesSomos()
    {
        echo view('head');
        echo view('titulo');
        echo view('navbar');
        echo view('quienesSomos');
        echo view('footer');
    }

    public function contacto()
    {
        echo view('head');
        echo view('titulo');
        echo view('navbar');
        echo view('contacto');
        echo view('footer');
    }

    public function productos()
    {
        echo view('head');
        echo view('titulo');
        echo view('navbar');
        echo view('productos');
        echo view('footer');
    }

    public function comercializacion()
    {
        echo view('head');
        echo view('titulo');
        echo view('navbar');
        echo view('comercializacion');
        echo view('footer');
    }

    public function terminosdeuso()
    {
        echo view('head');
        echo view('titulo');
        echo view('navbar');
        echo view('terminosdeuso');
        echo view('footer');
    }

    public function registro()
    {
        return view('registro');
    }

    public function login()
    {
        echo view('head');
        echo view('titulo');
        echo view('navbar');
        echo view('login');
        echo view('footer');
    }
}
