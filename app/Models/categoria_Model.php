<?php

namespace App\Models;

use CodeIgniter\Model;

class categoria_Model extends Model
{
    protected $table = 'categorias';
    protected $primaryKey = 'id_categoria';
    protected $allowedFields = ['descripcion', 'activo'];
}