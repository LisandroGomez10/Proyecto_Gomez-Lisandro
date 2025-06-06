<?php

namespace App\Models;

use CodeIgniter\Model;

class Ventas_detalle extends Model
{
    protected $table = 'ventas_detalle';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'ventas_id','producto_id','cantidad','precio'
    ];
    protected $returnType = 'array';
}

