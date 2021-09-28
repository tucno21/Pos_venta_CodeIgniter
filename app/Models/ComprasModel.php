<?php

namespace App\Models;

use CodeIgniter\Model;

class ComprasModel extends Model
{
    protected $table      = 'compras';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';
    //eliminacion de filas
    protected $useSoftDeletes = false;

    protected $allowedFields = ['folio', 'total', 'id_usuario', 'estado'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = null;
    protected $deletedField  = null;

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
