<?php

namespace App\Models;

use CodeIgniter\Model;

class LogsModel extends Model
{
    protected $table      = 'logs';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';
    //eliminacion de filas
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_usuario', 'evento', 'ip', 'detalles'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = null;
    protected $deletedField  = null;

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function logsRegister()
    {
        $this->select('logs.*, U.username AS user');
        $this->join('usuarios AS U', 'logs.id_usuario = U.id');
        $this->orderBy('logs.created_at', 'DESC');
        $logs = $this->findAll();
        return $logs;
    }
}
