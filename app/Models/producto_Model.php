<?php

namespace App\Models;

use CodeIgniter\Model;

class producto_Model extends Model
{
    protected $table      = 'productos';
    protected $primaryKey = 'id_producto';

    protected $allowedFields = ['nombre_prod','imagen','categoria_id','precio','precio_vta', 'stock','stock_min', 'eliminado'];
    protected $returnType    = 'array';

    // Opcional: validaciones
    protected $validationRules = [
        'nombre_prod' => 'required|min_length[3]',
        'precio_vta' => 'required|decimal',
    ];
}
