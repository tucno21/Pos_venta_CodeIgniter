<?php

namespace App\Models;

use CodeIgniter\Model;

class TemporalComprasModel extends Model
{
    protected $table      = 'temporal_compras';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';
    //eliminacion de filas
    protected $useSoftDeletes = false;

    protected $allowedFields = ['folio', 'id_producto', 'codigo', 'name', 'cantidad', 'precio', 'subtotal'];

    protected $useTimestamps = false;
    protected $createdField  = 'null';
    protected $updatedField  = null;
    protected $deletedField  = null;

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
