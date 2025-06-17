<?php

namespace App\Models;

use CodeIgniter\Model;

class Consulta_Model extends Model
{
    protected $table      = 'consultas';
    protected $primaryKey = 'consultas_id';

    protected $allowedFields = [
        'consultas_nombre',
        'consultas_apellido',
        'consultas_email',
        'consultas_numero',
        'consultas_pregunta',
        'consultas_visto'
    ];

    protected $useTimestamps = false;
}
