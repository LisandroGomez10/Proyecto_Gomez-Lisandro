<?php

namespace App\Models;

use CodeIgniter\Model;

class Ventas_cabecera extends Model
{
    protected $table = 'ventas_cabecera';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'fecha','usuario_id', 'total_venta'
    ];
    protected $returnType = 'array';
}
