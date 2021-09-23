<?php

namespace App\Models;

use CodeIgniter\Model;

class ConfiguracionesModel extends Model
{
    protected $table      = 'configuracion';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';
    //eliminacion de filas
    protected $useSoftDeletes = false;

    protected $allowedFields = ['name', 'rfc', 'telefono', 'email', 'direccion', 'leyenda'];

    protected $useTimestamps = false;
    protected $createdField  = null;
    protected $updatedField  = null;
    protected $deletedField  = null;

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
